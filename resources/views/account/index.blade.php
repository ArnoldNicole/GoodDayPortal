@extends('layouts.index')

@section('content')
<div class="row">
	<div class="col-md-11">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
				      <li class="nav-item">
				        <a class="nav-link active" id="nav-info" data-toggle="tab" href="#info"><h class="card-subtitle">my account Info</h></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" id="nav-stats" data-toggle="tab" href="#stats"><h class="card-subtitle">Statistics</h></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" id="nav-social" data-toggle="tab" href="#social"><h class="card-subtitle">Social</h></a>
				      </li>
				       @if(auth()->user()->is_verified_teacher)
				       <li class="nav-item">
				        <a class="nav-link" id="nav-teacher" data-toggle="tab" href="#teacher_tab"><h class="card-subtitle">Teacher {{auth()->user()->name}}</h></a>
				      </li>
				       @endif

				    </ul>
				
			</div>
			<div class="card-body tab-content">
				<div id="info" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-info">
					<div class="row justify-content-center">
						<div class="col-md-8">
							
							<div class="card">
								<div class="card-body">
									<p>Name <span class="text-info font-weight-bold">{{auth()->user()->name}}</span></p>
									<p>Username <span class="text-info font-weight-bold">{{auth()->user()->profile->username}}</span></p>
									<p>Email <a href="#"><span class="text-info font-weight-bold">{{auth()->user()->email}}</span></a></p>
									<p>Active since <span class="text-info font-weight-bold">{{auth()->user()->created_at->diffForHumans()}}</span></p>	
									<p>Description <span class="text-info font-weight-bold">{{auth()->user()->profile->bio}}</span></p>
								</div>
							</div>											


							<div class="modal fade show" id="EditProfileModal" tabindex="-1" role="dialog" aria-labelledby="EditProfileModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg" role="document">
							    <div class="modal-content">
							      <div class="modal-header alert-success">
							        <h5 class="modal-title" id="EditProfileModalLabel">Hello <span class="text-dark">{{auth()->user()->name}}</span> Edit your profile details below</h5>
							        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">×</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="row justify-content-between">
							      		<div class="col-md-12">
							      			<form method="post" action="{{route('save_account_changes', auth()->user()->id)}}">
							      				@csrf
							      				@method('PATCH')
							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Name
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name ?? @old('name')}}" readonly required>
							      						@error('name')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Username
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{auth()->user()->profile->username ?? @old('username')}}" required>
							      						@error('username')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Date of Birth
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{auth()->user()->profile->date_of_birth ?? @old('date_of_birth')}}">
							      						<input type="hidden" name="today" value="@php echo date('d.m.Y')  @endphp">
							      						@error('date_of_birth')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      			<div class="row form-group">
							      				<label class="col-md-4 col-form-label text-md-right">
							      					Recovery Email
							      				</label>
							      				<div class="col-md-8 input-group">
							      					<input type="email" name="recovery_email" class="form-control @error('recovery_email') is-invalid @enderror" value="{{auth()->user()->profile->recovery_email ?? @old('recovery_email')}}" required>
							      					@error('recovery_email')
							      				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      					@enderror
							      				</div>
							      			</div>

							      			<div class="row form-group">
							      				<label class="col-md-4 col-form-label text-md-right">
							      					Bio or description
							      				</label>
							      				<div class="col-md-8 input-group">
							      					<input type="text" name="bio" class="form-control @error('bio') is-invalid @enderror" value="{{ auth()->user()->profile->bio ?? @old('bio')}}" placeholder="Enter your profile description here" required>
							      					@error('bio')
							      				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      					@enderror
							      				</div>
							      			</div>
							      			<button class="btn btn-block btn-success" type="submit">Save Changes</button>
							      			</form>
							      		</div>
							      	</div>
							      </div>
							      <div class="modal-footer">
							        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>         
							        
							      </div>
							    </div>
							  </div>
							</div>


						</div>
						<div class="col-md-4">
							<button  class="btn btn-primary" data-toggle="modal" data-target="#EditProfileModal"><i class="fas fa-pen-nib"></i> Edit Profile </button>
							@if(auth()->user()->profile->is_teacher)
							<a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#teacherProfileModal">Teacher Profile</a>


							<div class="modal fade show" id="teacherProfileModal" tabindex="-1" role="dialog" aria-labelledby="TeacherModal" aria-hidden="true">
							  <div class="modal-dialog modal-lg" role="document">
							    <div class="modal-content">
							      <div class="modal-header alert-dark">
							        <h5 class="modal-title" id="TeacherModal">Complete the following details to prove you are a teacher</h5>
							        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">×</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="row justify-content-between">
							      		<div class="col-md-12">
							      			<form method="post" action="{{route('teacher_account_upgrade', auth()->user()->profile->id)}}">
							      				@csrf
							      				@method('PATCH')
							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Authorizing Certificate Name<br> <small class="text-info">May iclude TSC, P1, Diploma, etc</small>
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="text" name="certificate_name" class="form-control @error('certificate_name') is-invalid @enderror" value="{{auth()->user()->certificate_name ?? @old('certificate_name')}}" required>
							      						@error('certificate_name')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Authorizing Certificate Serial Number
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="text" name="certificate_number" class="form-control @error('certificate_number') is-invalid @enderror" value="{{auth()->user()->certificate_name ?? @old('certificate_number')}}" required>
							      						@error('certificate_number')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Subject
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<select name="favourite_subject" class="form-control @error('favourite_subject') is-invalid @enderror">
							      							<option value="">Select below</option>
							      							<option value="Mathematics">Maths</option>
							      							<option value="English">English</option>
							      							<option value="Kiswahili">Kiswahili</option>
							      							<option value="Science">Science</option>
							      							<option value="Social Studies">Social Studies</option>
							      							<option value="RE">RE</option>
							      							<option value="Computer Studies">Computer Studies</option>
							      						</select>
							      						
							      						@error('favourite_subject')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						National Id number
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="number" name="national_id_number" class="form-control @error('national_id_number') is-invalid @enderror" value="{{auth()->user()->profile->national_id_number ?? @old('national_id_number')}}">
							      						<input type="hidden" name="today" value="@php echo date('d.m.Y')  @endphp">
							      						@error('national_id_number')
							      					<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      						@enderror
							      					</div>
							      				</div>

							      			<div class="row form-group">
							      				<label class="col-md-4 col-form-label text-md-right">
							      					Staff Number
							      				</label>
							      				<div class="col-md-8 input-group">
							      					<input type="text" name="staff_number" class="form-control @error('staff_number') is-invalid @enderror" value="{{auth()->user()->profile->staff_number ?? @old('staff_number')}}" required>
							      					@error('staff_number')
							      				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      					@enderror
							      				</div>
							      			</div>

							      			<small><sup class="text-danger">*</sup>upon validation your account will be upgraded automatically</small>
							      			<button class="btn btn-block btn-success" type="submit">Validate</button>
							      			<small class="font-weight-bold"><sup class="text-info">*</sup>By clicking validate you agree to our terms and allow us to pull your data from third party sources to prove the above</small>
							      			</form>
							      		</div>
							      	</div>
							      </div>
							      <div class="modal-footer">
							        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>         
							        
							      </div>
							    </div>
							  </div>
							</div>
							@else
							@if(auth()->user()->teacher)
							<br><big class="text-info font-italic">Your teacher profile is {{auth()->user()->teacher->status}} </big>
							@endif
							@endif
						</div>
					</div>
				</div>
				<div id="stats" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-stats">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<p>Completed Assignments <span class="text-info font-weight-bold">90</span></p>
							<p>Groups <span class="text-info font-weight-bold"></span></p>
							<p>Notes <span class="text-info font-weight-bold"></span>0</p>
							<p>Fees Balances <span class="text-info font-weight-bold">KES 100</span></p>
							<p>Completed Group Tasks <span class="text-info font-weight-bold">12</span></p>
							<p>Badges <span class="text-info font-weight-bold">0</span></p>
						</div>
					</div>	
				</div>
				<div id="social" class="tab-pane fade " role="tabpanel" aria-labelledby="nav-social">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<p>Friends<span class="text-info font-weight-bold">90</span></p>
							<p>Challenges posted <span class="text-info font-weight-bold">0</span></p>
							<p>Challenges involved <span class="text-info font-weight-bold">0</span></p>
							<p>Challenges Completed <span class="text-info font-weight-bold">0</span></p>
							<hr>
							<p>Nice Teachers <span class="text-info font-weight-bold">10</span></p>
							<p>Penalties <span class="text-info font-weight-bold">40</span></p>
							
						</div>
					</div>
				</div>

				@if(auth()->user()->is_verified_teacher)
				<div id="teacher_tab" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-teacher">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<p>Classes<span class="text-info font-weight-bold"> 90</span></p>
							<p>Pupils <span class="text-info font-weight-bold">0</span></p>
							 
							 <a href="#" class="card-link">Update Teaching Profile</a>
							
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
