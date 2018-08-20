@extends('layouts.app')
	@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Tambah/Ubah Item Gudang</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah/Ubah Item</h2>
				</div>
					<div class="panel-body">
						@if($method == 'create')
                        	<form class="form-horizontal tasi-form" method="post" action="{{ url('produk/') }}" enctype="multipart/form-data">
                        @else
                			{!! Form::model($data,['url' => url('produk/'.$data->id),'method' => 'Put','class' => 'form-horizontal form-label-left']) !!}
						@endif
						{{ csrf_field() }}
                        @include('produk._form')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    <script>
		$(function(){
			check({{ $data->produk ?? 0 }});
		});
        function check(params){
            if(params == 1){
                $('#jenis_produk').show(500);
                $('#lokasi_beli').hide(500);
            }else{
                $('#jenis_produk').hide(500);
                $('#lokasi_beli').show(500);
            }
        }
    </script>
@endsection