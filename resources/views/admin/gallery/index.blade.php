@extends('layouts/app')

@section('content')
	<div class="container">
        <!-- flash message -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.errors')
                @include('partials.flash')
            </div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<h1>My galleries</h1>
			</div>
		</div>

		<div class="row">
        <!-- gallery table -->
			<div class="col-md-8">
				@if($galleries->count() > 0 )
					<table class='table table-striped table-bordered table-hover table-condensed'>
						<thead>
							<tr>
								<th>gallery name</th>
                                <th colspan="3">action</th>
                            </tr>
						</thead>

						<tbody>
							@foreach ($galleries as $gallery)
								<tr>
									<td>{{ $gallery->name }} ({{ $gallery->photos->count() }})</td>
									<td><a href="{{ route('gallery.show', [$gallery->id]) }}">View</a></td>
									<td><a href="{{ route('gallery.delete', [$gallery->id]) }}" id="deleteGallery">delete</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<h1 class="gallery__no-items">theres no Galley yet !</h1>
				@endif
			</div>

			<div class="col-md-4">
				<form action="{{ route('gallery.store') }}" method="POST" class="form-horizontal" role="form">
					{{ csrf_field() }}

					<fieldset>
						<legend>Add new photo to the gallery</legend>

						<div class="form-group">
							<label for="gallery-name" class="control-label">Gallery name</label>
							<input type="text" class="form-control" id="gallery_name"
								   name="gallery_name" value="{{ old('gallery_name') }}" placeholder="Name of the gallery">
						</div>

						<button type="submit" class="btn btn-raised btn-primary">Save</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
    <script>
        document.querySelector("#deleteGallery").addEventListener("click", function(e) {
            if (! confirm('Are you sure to delete This gallery permanently!')) {
                e.preventDefault();
            }
        }, false);
    </script>
@endpush
