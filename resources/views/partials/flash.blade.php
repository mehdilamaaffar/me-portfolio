@if(session()->has('flash_message'))
	<div class="alert alert-{{ session('flash_message_level') }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ session('flash_message') }}</strong>
	</div>
@endif
