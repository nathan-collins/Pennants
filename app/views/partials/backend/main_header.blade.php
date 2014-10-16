<div class="main-header">
	@section('header_title')
	@show
	<div class="alert error-message fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		<h4>An Error has occured</h4>
		<p><% error.message %></p>
	</div>
</div>