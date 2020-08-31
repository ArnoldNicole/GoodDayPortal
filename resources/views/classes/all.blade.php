@extends('layouts.index')

@section('content')
<div class="container-fluid">
	@foreach($classes as $class)
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4 text-center">
					<img src="{{$class->icon}}" alt="{{$class->class_name}}" class="rounded-circle w-25">
					<hr>
					
						<a class="btn btn-info btn-block" href="{{route('join_class',$class->id)}}">Details</a>
					
				</div>
				<div class="col-md-6">
					<p>{{$class->class_name}}</p>
					<p>{{ucfirst($class->decription)}}</p>

					<p><span class="text-sm-left">34 Learners</span> | <span class="text-sm-left">45 More till full</span></p>
				</div>
			</div>
		</div>
	</div>
	@endforeach

</div>
@endsection