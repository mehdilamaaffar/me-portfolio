@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row"><!-- gallery name breadcrumb -->
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ '/g/' . $photo->gallery->name_slug }}">{{ $photo->gallery->name }}</a></li>
                  <li class="active">photo</li>
                </ol>
            </div>
        </div>

        <div class="row"> <!-- Gallery images list -->
            <div class="col-md-8 col-md-offset-2 full-image">
                <img src="/{{ $photo->file_path }}" class="img-responsive" alt="">
            </div>
        </div>
    </div>
@endsection
