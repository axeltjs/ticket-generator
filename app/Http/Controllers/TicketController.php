<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
Use Auth;
use App\Http\Requests\TicketRequest;
use DB;
use Session;
use Storage;
use Image;
use PDF;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ticket::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(10);
        $view = [
            'items' => $data
        ];
        return view('ticket.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * $img = Image::make(public_path($value)); //your image I assume you have in public directory
     * $img->insert(public_path('watermark.png'), 'bottom-right', 10, 10); //insert watermark in (also from public_directory)
     * $img->save(public_path($value));

     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $this->checkStoredData($request);
        $file = $request->file('file');

        $image_sz = getimagesize($file);
        $width = $image_sz[0];
        $height = $image_sz[1];

        $extension = $file->getClientOriginalExtension();
        $filename = Auth::user()->id.'-'.md5($request->title);
        # Simpan
        $i = $request->start_num ?? 1;
        $end = $request->end_num;
        $destination_path = base_path() . '/public/uploads/user/';
        $request->file('file')->move($destination_path, $filename."-".$i.".".$extension);
        
        Ticket::create([
                'user_id'       => Auth::user()->id,
                'title'         => $request->title,
                'picture'       => $filename,
                'extension'     => $extension,
                'start_num'     => $request->start_num ?? 1,
                'end_num'       => $request->end_num,
                'model_layout'  => $request->model_layout,
            ]);

        for ($a = $i + 1; $a <= $end; $a++) {
            $b = $a - 1;
            $finished_filename = $filename."-".$a.".".$extension;
            $past_filename = $filename."-".$b.".".$extension;
            Storage::disk('upload_path')->copy($past_filename, $finished_filename);
        }

        for ($a = $i; $a <= $end; $a++) {
            $finished_filename = $filename."-".$a.".".$extension;
            $img = Image::make(public_path('uploads/user/'.$finished_filename)); //your image I assume you have in public directory
         
            $number = str_split($a);
            $image_number = [];
            foreach($number as $num){
                array_push($image_number, public_path('uploads/number/'.$num.'.png'));
            }

            $this->manageLayout($img, $image_number, $finished_filename, $width, $height, $request);
         
        }
        
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Ticket has successfuly created!"
                    ]);

        return redirect('ticket');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ticket::findOrFail($id);
        $filename = Auth::user()->id.'-'.md5($data->title);

        $pdf = \PDF::loadView('ticket.pdf', compact('data','filename'))->setPaper('a4', 'portrait')
            ->setWarnings(false);
        return @$pdf->stream(date('d-m-Y') . '-ticket-genrator.pdf');
        // return view('ticket.pdf',compact('data','filename'));
    }

    public function nonPDF($id)
    {
        $data = Ticket::findOrFail($id);
        $filename = Auth::user()->id.'-'.md5($data->title);
        return view('ticket.show',compact('data','filename'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::findOrFail($id)->delete();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Ticket has successfuly deleted!"
                    ]);

        return redirect('ticket');

    }

    public function manageLayout($img, $image_number, $finished_filename, $width, $height, $request)
    {
        $sisa_bagi_tinggi = ($height / 2) / 2;
        $sisa_bagi_lebar  = ($width / 2) / 2;

        if($request->model_layout == 1){
            $x = $sisa_bagi_lebar;
            $y = $sisa_bagi_tinggi;
        }elseif($request->model_layout == 2){
            $x = $sisa_bagi_lebar;
            $y = ($height / 2);
        }elseif($request->model_layout == 3){
            $x = $sisa_bagi_lebar;
            $y = $height - $sisa_bagi_tinggi;
        }elseif($request->model_layout == 4){
            $x = $width / 2;
            $y = $sisa_bagi_tinggi;
        }elseif($request->model_layout == 5){
            $x = $width / 2;
            $y = ($height / 2);            
        }elseif($request->model_layout == 6){
            $x = $width / 2;
            $y = $height - $sisa_bagi_tinggi;
        }elseif($request->model_layout == 7){
            $x = $width - $sisa_bagi_lebar;
            $y = $sisa_bagi_tinggi;
        }elseif($request->model_layout == 8){
            $x = $width - $sisa_bagi_lebar;
            $y = ($height / 2);            
        }elseif($request->model_layout == 9){
            $x = $width - $sisa_bagi_lebar;
            $y = $height - $sisa_bagi_tinggi;
        }
        
        $x = (int)$x;
        $y = (int)$y;
        
        foreach ($image_number as $in) {
            $img->insert($in, 'top-left', $x, $y); //insert watermark in (also from public_directory) // (x, y)
            $img->save(public_path('uploads/user/'.$finished_filename));
            $x += 20;
        }
    }

    public function checkStoredData($request)
    {
        $data = Ticket::where(['user_id' => Auth::user()->id, 'title' => $request->title])->get();
        if(count($data) > 0){
            Session::flash("flash_notification", [
                    "level"=>"danger",
                    "message"=>"Ticket title already exist!"
                ]);
            return redirect()->back();
        }
        
    }
}
