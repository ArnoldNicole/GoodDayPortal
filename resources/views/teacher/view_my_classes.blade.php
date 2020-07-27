@extends('layouts.index')
@section('content')
<div class="container-fluid">	
	<h4>My Classes <i class="fa fa-book"></i></h4>
<div class="row">	
		<div class="col-md-9">
			@foreach($classes as $class)
			<div class="card mt-2">	
				<div class="card-header">
					{{$class->class_name}}
				</div>
				<div class="card-body">	
					<div class="row justify-content-center">
						<div class="col-md-4">
							<img src="{{$class->icon}}" alt="{{$class->class_name}}" class="rounded-circle img-thumbnail w-100">
						</div>
						<div class="col-md-8">
							<p>Class Name: <span>{{$class->class_name}}</span></p>
							<p>Description <span>{{$class->decription}}</span></p>
							<p>Allowed members: <span>{{$class->max_pupils}}</span></p>
							<br>
							<div class="row">
								<div class="col-md-6">
									<div class="badge badge-secondary text-capitalize text-lg-center">{{75}} <h4>Current Members</h4></div>
								</div>
								<div class="col-md-6">									
										<div class="btn-group-vertical">
											<button class="btn btn-info" data-toggle="modal" data-target="#modal{{$class->id}}_editModal">Edit</button>
											<div class="dropdown">
												<button class="btn btn-primary dropdown-toggle" id="class_{{$class->id}}ToggleButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												    <a class="dropdown-item font-weight-bold text-dark" href="#">Publish Assignment</a>
												    <a class="dropdown-item font-weight-bold text-dark" href="#">Manage members</a>
												    <a class="dropdown-item font-weight-bold text-dark" href="#">Chat in class</a>
												    <a class="dropdown-item font-weight-bold text-dark" href="#">Edit class key</a>

												  </div>
											</div>
											<button class="btn btn-danger">Delete</button>
										</div>

											<div class="modal fade show" id="modal{{$class->id}}_editModal"  role="dialog" aria-labelledby="{{$class->id}}_editModalLabel" aria-hidden="true">
											  <div class="modal-dialog modal-lg" role="document">
											    <div class="modal-content">
											      <div class="modal-header alert-primary">
											        <h5 class="modal-title" id="{{$class->id}}_editModalLabel">Hello <span class="text-dark">{{auth()->user()->name}}</span> Edit {{$class->class_name}} Details</h5>
											        <button class="close bg-danger" type="button" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
											      <div class="modal-body">
											      	<div class="row justify-content-between">
											      		<div class="col-md-12">
											      		 <form action="{{route('updateClass', $class->id)}}" method="POST" enctype="multipart/form-data">
											      		 	@csrf
											      		 	@method('PATCH')
											      		 	<div class="row form-group">
											      		 		<label class="col-md-4 col-form-label text-md-right">Amend Class description</label>
											      		 			<div class="col-md-8 input-group">
											      		 				<input type="text" name="decription" class="form-control @error('decription') is-invalid @enderror" value="{{ $class->decription ?? @old('decription')}}" required autocomplete="off">
											      		 				
											      		 				@error('decription')
											      		 					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
											      		 				@enderror
											      		 			</div>
											      		 	</div>

											      		 	<div class="row form-group">
											      		 		<label class="col-md-4 col-form-label text-md-right">How many pupils do you want in your class? </label>
											      		 			<div class="col-md-8 input-group">
											      		 				<input type="number" name="max_pupils" min="{{$class->max_pupils}}" max="900" class="form-control @error('max_pupils') is-invalid @enderror" value="{{ @old('max_pupils')}}" required autocomplete="off">
											      		 				
											      		 				@error('max_pupils')
											      		 					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
											      		 				@enderror
											      		 			</div>
											      		 	</div>
											      		 	<hr>
											      		 	<div class="row form-group">
											      		 		<label class="col-md-4 col-form-label text-md-right">Enter Class Key to make changes</label>
											      		 			<div class="col-md-8 input-group">
											      		 				<input type="password" name="existing_class_key" maxlength="10" minlength="8" class="form-control @error('existing_class_key') is-invalid @enderror" value="{{ @old('class_key')}}" required autocomplete="off">
											      		 				
											      		 				
											      		 			</div>
											      		 	</div>


											      		 	<div class="form-group row justify-content-end">
											      		 		<div class="col-md-6">
											      		 			<button class="btn btn-outline-success btn-block" type="submit">Save changes </button>
											      		 		</div>
											      		 		<small class="text-info">Changing the security key only affects the new members who need to join</small>
											      		 	</div>
											      		 </form>											
											      		</div>
											      	</div>
											      </div>											      
											    </div>
											  </div>
											</div>					
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="col-md-3">
			{{$classes->links()}}
		</div>	
</div>
</div>
@endsection