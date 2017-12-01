@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="portfolio-box">
                        <a href="{{ route('gallery.photos', [$category->name_slug]) }}">
                            <img src="{{ $category->latestPhoto->thumbnail_path }}" class="img-responsive" alt="">
                            <div class="portfolio-box__caption">
                                    {{ $category->name }}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
