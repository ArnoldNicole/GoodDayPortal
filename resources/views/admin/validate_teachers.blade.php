@extends('layouts.index')
@section('css')
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css
" rel="stylesheet">
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered" style="width:100%">
			        <thead class="alert-info">
			            <tr>
			                <th>Name</th>
			                <th>Cert No</th>
			                <th>Subject</th>
			                <th>Id Number</th>
			                <th>Qualification</th>
			                <th>Email</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($teachers as $teacher)
			            <tr>
			                <td>{{$teacher->user->name}}</td>
			                <td>{{$teacher->certificate_number}}</td>
			                <td>{{$teacher->favourite_subject}}</td>
			                <td>{{$teacher->national_id_number}}</td>
			                <td>{{$teacher->certificate_name}}</td>
			                <td>{{$teacher->user->email}}</td>
			                <td>
			                	@if($teacher->status=="Pending Validation")
			                		<a href="{{route('teacher.approve', $teacher->id)}}" class="btn btn-outline-success fa fa-check">Approve</a>
			                	@else
			                	<div class="dropdown">
			                	  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton_{{$teacher->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                	    Actions
			                	  </button>			                	  
			                	    @if(auth()->user()->admin)
			                	    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{$teacher->id}}">
			                	    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modal_{{$teacher->national_id_number}}">
			                	      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			                	     Edit
			                	    </a>
			                	    <a class="dropdown-item" href="#"> <i class="fas fa-trash-o"></i> Suspend</a>
			                	    <a class="dropdown-item" href="#">Dismiss</a>
			                	    @endif
			                	  </div>
			                	</div>
			                	@endif
			                </td>
			            </tr>


			            {{-- EditModal --}}
			            @if(auth()->user()->admin)
			            <div class="modal fade" id="Modal_{{$teacher->national_id_number}}" tabindex="-1" role="dialog" aria-labelledby="trModal_{{$teacher->id}}" aria-hidden="true">
			              <div class="modal-dialog modal-lg" role="document">
			                <div class="modal-content">
			                  <div class="modal-header">
			                    <h5 class="modal-title" id="trModal_{{$teacher->id}}">Edit and update <span class="text-success">{{$teacher->user->name}}</span> records</h5>
			                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
			                      <span aria-hidden="true">×</span>
			                    </button>
			                  </div>
			                  <div class="modal-body">
			                  	<div class="col-md-12">
							      			<form method="post" action="{{route('teacher_account_update', $teacher->id)}}">
							      				@csrf
							      				@method('PATCH')
							      				<div class="row form-group">
							      					<label class="col-md-4 col-form-label text-md-right">
							      						Authorizing Certificate Name<br> <small class="text-info">May iclude TSC, P1, Diploma, etc</small>
							      					</label>
							      					<div class="col-md-8 input-group">
							      						<input type="text" name="certificate_name" class="form-control @error('certificate_name') is-invalid @enderror" value="{{$teacher->certificate_name ?? @old('certificate_name')}}" required>
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
							      						<input type="text" name="certificate_number" class="form-control @error('certificate_number') is-invalid @enderror" value="{{$teacher->certificate_number ?? @old('certificate_number')}}" required>
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
							      						<input type="number" name="national_id_number" class="form-control @error('national_id_number') is-invalid @enderror" value="{{$teacher->national_id_number ?? @old('national_id_number')}}">
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
							      					<input type="text" name="staff_number" class="form-control @error('staff_number') is-invalid @enderror" value="{{$teacher->staff_number ?? @old('staff_number')}}" required>
							      					@error('staff_number')
							      				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                    			</span>
							      					@enderror
							      				</div>
							      			</div>

							      			<small><sup class="text-danger">*</sup>You are liable for any false alterations whatsoever</small>
							      			<button class="btn btn-block btn-success" type="submit">Update and save changes</button>	
							      			</form>
							      		</div>
							      	</div>
			                  </div>
			                 
			                </div>
			              </div>
			              @endif
			            </div>



			            @endforeach
			        </tbody>
			    </table>
			    
		</div>
	</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection







