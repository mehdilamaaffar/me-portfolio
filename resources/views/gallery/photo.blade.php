@extends('layouts/app') @section('content') @include('layouts.header')

<div class="container">
	<!-- gallery name -->
	<div class="row">
		<div class="col-md-12">
			<div class="gallery-name">{{ $photo->gallery->name }}</div>
		</div>
	</div>

	<!-- Gallery images list -->
	<div class="row">
		<div class="gallery-images">
			<div class="col-md-10 col-md-offset-1 col-xs-12">
                <img src="{{ url('repository/photos/' . $photo->file_name) }}" class="img-full">
			</div>
		</div>
	</div>
</div>
@endsection
