@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Item Gudang</li>
            </ul>
            <form method="get" class="form-horizontal tasi-form" action="{{ url('produk') }}" >
                <div class="col-sm-10">
                    {{ csrf_field() }}
                    {!! Form::hidden('produk', Request::get('produk') ?? 1) !!}
                    {!! Form::text('q', old('q'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::submit('Cari', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
            <br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Produk</h2>
				</div>
				<div class="panel-body">
					<p><a href="{{ route('produk.create') }}" class="btn btn-primary"> Tambah </a></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                @if(Request::get('produk') == 0)
                                    <th>Lokasi</th>
                                @else
                                    <th>Jenis</th>
                                @endif
                                <th>Harga</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->qty }}</td>
                                @if(Request::get('produk') == 0)
                                    <td> {{ $item->lokasi_beli }} </td>
                                @else
                                    <td> {{ $item->jenis_produk }} </td>
                                @endif
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <a href="{{ url('produk/'.$item->id.'/edit') }}" class="btn btn-warning"> Edit</a>
                                    <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('produk/'.$item->id) }}" class="btn btn-danger"> Delete</a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->appends(Request::only('q','produk'))->links() }}
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
