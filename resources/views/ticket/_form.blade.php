<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	{!! Form::label('title', 'Title', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('method', 'Counting Method', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('method', ['0' => 'Single','1' => 'Interval'], null, ['class' => 'form-control select2 method', 'onchange' => 'checkMethod(this.value)']) !!}
	</div>
</div>

<div id="start_num" class="form-group{{ $errors->has('start_num') ? ' has-error' : '' }}">
	{!! Form::label('start_num', 'Start Number', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('start_num', null, ['class'=>'form-control']) !!}
		{!! $errors->first('start_num', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div id="end_num" class="form-group{{ $errors->has('end_num') ? ' has-error' : '' }}">
	{!! Form::label('end_num', 'End Number', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('end_num', null, ['class'=>'form-control']) !!}
		{!! $errors->first('end_num', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('model_layout_header', 'Model Layout', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '1', true, []) !!}
			<img src="{{ asset('uploads/template/1.png') }}" alt="Pilihan 1">	
		</label>	
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '2', false, []) !!}
			<img src="{{ asset('uploads/template/2.png') }}" alt="Pilihan 2">		
		</label>	
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '3', false, []) !!}
			<img src="{{ asset('uploads/template/3.png') }}" alt="Pilihan 3">		
		</label>	
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '4', false, []) !!}
			<img src="{{ asset('uploads/template/4.png') }}" alt="Pilihan 4">		
		</label>	
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '5', false, []) !!}
			<img src="{{ asset('uploads/template/5.png') }}" alt="Pilihan 5">		
		</label>	
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '6', false, []) !!}
			<img src="{{ asset('uploads/template/6.png') }}" alt="Pilihan 6">		
		</label>	
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '7', false, []) !!}
			<img src="{{ asset('uploads/template/7.png') }}" alt="Pilihan 7">		
		</label>	
		<br>
		<small>* Red spot means the spot of the number</small>
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '8', false, []) !!}
			<img src="{{ asset('uploads/template/8.png') }}" alt="Pilihan 8">		
		</label>	
	</div>
	<div class="col-md-3">
		<label class="radio-inline">
			{!! Form::radio('model_layout', '9', false, []) !!}
			<img src="{{ asset('uploads/template/9.png') }}" alt="Pilihan 9">		
		</label>	
	</div>
</div>

<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
	{!! Form::label('file', 'Photo', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('file',array('class' => 'form-control')) !!}
		{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
	</div>
</div>



<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>