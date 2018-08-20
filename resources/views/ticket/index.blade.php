@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Ticket Lists</li>
            </ul>
            <form method="get" class="form-horizontal tasi-form" action="{{ url('ticket') }}" >
                <div class="col-sm-10">
                    {{ csrf_field() }}
                    {!! Form::hidden('ticket', Request::get('ticket') ?? 1) !!}
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
					<h2 class="panel-title">Ticket</h2>
				</div>
				<div class="panel-body">
					<p><a href="{{ route('ticket.create') }}" class="btn btn-primary"> Tambah </a></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Jumlah</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->total }}</td>
                                <td>
                                    <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('ticket/'.$item->id) }}" class="btn btn-danger"> Delete</a>
                                    <a href="#">Print</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->appends(Request::only('q','ticket'))->links() }}
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
