@extends('layouts/app')

@section('content')

@include('layouts.header')

<div class="container">
    <!-- gallery name -->
    <div class="row">
        <div class="col-md-12">
            <div class="gallery-name">{{ $gallery->name }}</div>
        </div>
    </div>

    <!-- Gallery images list -->
    <div class="row">
        <div class="gallery-images">
            @foreach($gallery->photos as $photo)
                <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                    <a class="thumb" href="{{ url($photo->file_path) }}" data-lightbox="image">
                        <img class="img-responsive" src="{{ url('repository/photos/thumbnails/' . $photo->file_name) }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
