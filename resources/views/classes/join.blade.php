@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<app-index classData="{{json_encode($clas)}}">
				
			</app-index>
		</div>
	</div>
</div>
@endsection