@extends('layouts.index')
@section('content')

<div class="container">
	
<div class="row justify-content-center">
	<div class="col-md-8 alert-dark">
		<h4 class="h4 text-justify text-uppercase">{{$teacher->name}} create a new Class. </h4>
		<p class="text-dark font-weight-bold-bold text-center">Please fill the form below accurately <span><i class="fa fa-question-circle"></i></span></p>
	</div>
	<div class="col-md-4">
		<p>Creating class {{$teacher->teacher->clases->count()+1}} of 2</p>
		<a href="#" class="btn btn-outline-info">Remove Two Class limit</a>
	</div>
</div>

<div class="row mt-2 justify-content-center">
	<div class="col-md-10">
		<form action="{{route('save_class')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row form-group">
				<label class="col-md-4 col-form-label text-md-right">Choose a class name</label>
					<div class="col-md-8 input-group">
						<input type="text" name="class_name" class="form-control @error('class_name') is-invalid @enderror" value="{{ @old('class_name')}}" required autocomplete="off">
						
						@error('class_name')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
			</div>

			<div class="row form-group">
				<label class="col-md-4 col-form-label text-md-right">Describe your class in a few words</label>
					<div class="col-md-8 input-group">
						<input type="text" name="decription" class="form-control @error('decription') is-invalid @enderror" value="{{ @old('decription')}}" required autocomplete="off">
						
						@error('decription')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
			</div>

			<div class="row form-group">
				<label class="col-md-4 col-form-label text-md-right">How many pupils do you want in your class? </label>
					<div class="col-md-8 input-group">
						<input type="number" name="max_pupils" min="0" max="900" class="form-control @error('max_pupils') is-invalid @enderror" value="{{ @old('max_pupils')}}" required autocomplete="off">
						
						@error('max_pupils')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
			</div>

			<div class="row form-group">
				<label class="col-md-4 col-form-label text-md-right">Create a class security key </label>
					<div class="col-md-8 input-group">
						<input type="password" name="class_key" maxlength="10" minlength="8" class="form-control @error('class_key') is-invalid @enderror" value="{{ @old('class_key')}}" required autocomplete="off">
						
						@error('class_key')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
			</div>

			<div class="row form-group">
				<label class="col-md-4 col-form-label text-md-right">Confirm Security Key</label>
					<div class="col-md-8 input-group">
						<input type="password" name="class_key_confirmation" maxlength="10" minlength="8" class="form-control @error('class_key') is-invalid @enderror" value="{{ @old('class_key')}}" required autocomplete="off">
						
						
					</div>
			</div>


			<div class="form-group row justify-content-end">
				<div class="col-md-6">
					<button class="btn btn-outline-success btn-block" type="submit">Complete </button>
				</div>
			</div>
		</form>
	</div>
</div>


</div>

@endsection