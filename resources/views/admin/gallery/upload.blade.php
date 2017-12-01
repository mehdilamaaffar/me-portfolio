@extends('layouts/app')

@section('content')
<div class="container">
    <!-- flash message -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('partials.flash')
        </div>
    </div>

    <!-- gallery name breadcrumb -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('gallery.index') }}">Dashboard</a></li>
                <li class="active breadcrumb__gallery-name">{{ $gallery->name }}</li>
            </ol>
        </div>
    </div>

    <!-- Gallery images list -->
    <div class="row">
        <div class="gallery-images">
            @foreach($gallery->photos as $photo)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" id="photoBox">
                    <div class="photo-delete">
                        <a href="{{ route('photo.delete', [$photo->id]) }}" id="deletePhoto">
                            <span class="glyphicon glyphicon-remove photo-delete__glyphicon"></span>
                        </a>
                    </div>
                    <a class="thumbnail" href="{{ url($photo->file_path) }}" data-lightbox="image">
                        <img class="img-responsive"
                            src="{{ url('repository/photos/thumbnails/' . $photo->file_name) }}"
                            alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

  <div class="row"> <!-- Upload form -->
       <div class="col-md-12">
            <form action="{{ route('photo.upload') }}" class="dropzone" id="addImages" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
            </form>
       </div>
  </div>
</div>

<script> <!-- set base path for dropZone -->
  var baseUrl = "{{ asset('') }}";
</script>
@endsection

{{--  @push('scripts')
<script>
    $('a#deletePhoto').on('click', function (e) {
        e.preventDefault();

        var that = $(this);

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this photo",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $.get(that.attr('href'), function(data) {
                that.parents('#photoBox').remove();
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });
    });
</script>
@endpush  --}}

