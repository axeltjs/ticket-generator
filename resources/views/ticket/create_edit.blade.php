@extends('layouts.app')
	@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Create Ticket</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Create Ticket</h2>
				</div>
					<div class="panel-body">
						<form class="form-horizontal tasi-form" method="post" action="{{ url('ticket/') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
                        @include('ticket._form')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    
@endsection