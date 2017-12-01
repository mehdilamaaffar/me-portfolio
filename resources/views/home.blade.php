@extends('layouts.app')

@section('content')

@include('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-md-12 cb-xs-screen">
            <div class="row">
                @foreach ($photos as $photo)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="thumb thumb--fade">
                        <a shref="{{ route('photo.show', ['id' => $photo->id]) }}" href="{{ url($photo->file_path) }}" data-lightbox="image">
                            <img src="{{ $photo->thumbnail_path }}" class="img-responsive" alt="">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
