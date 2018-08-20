<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
	{!! Form::label('qty', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('qty', null, ['class'=>'form-control','min'=>'1']) !!}
		{!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
	{!! Form::label('harga', 'Harga', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga', null, ['class'=>'form-control']) !!}
		{!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div id="produk" class="form-group{{ $errors->has('produk') ? ' has-error' : '' }}">
	{!! Form::label('produk', 'Jenis Item', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('produk', ['0' => 'Bahan', '1' => 'Produk'], null, ['class'=>'form-control','onchange' => 'check(this.value)']) !!}
		{!! $errors->first('produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div id="jenis_produk" class="form-group{{ $errors->has('jenis_produk') ? ' has-error' : '' }}">
	{!! Form::label('jenis_produk', 'Jenis Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jenis_produk', null, ['class'=>'form-control']) !!}
		{!! $errors->first('jenis_produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div id="lokasi_beli" class="form-group{{ $errors->has('lokasi_beli') ? ' has-error' : '' }}">
	{!! Form::label('lokasi_beli', 'Lokasi Beli', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('lokasi_beli', null, ['class'=>'form-control']) !!}
		{!! $errors->first('lokasi_beli', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>