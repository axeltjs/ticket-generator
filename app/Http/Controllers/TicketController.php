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
        $file = $request->file('file');
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
                'extention'     => $extension,
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
        //
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
        //
    }
}
