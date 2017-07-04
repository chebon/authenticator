@if (Session::has('authenticator_danger_alert'))
	<div class="row authenticator_alert">
		<div class="col-sm-12">
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{{ Session::get('authenticator_danger_alert') }}}
			</div>
		</div>
	</div>
@endif

@if (Session::has('authenticator_warning_alert'))
	<div class="row authenticator_alert">
		<div class="col-sm-12">
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{{ Session::get('authenticator_warning_alert') }}}
			</div>
		</div>
	</div>
@endif

@if (Session::has('authenticator_info_alert'))
	<div class="row authenticator_alert">
		<div class="col-sm-12">
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{{ Session::get('authenticator_info_alert') }}}
			</div>
		</div>
	</div>
@endif

@if (Session::has('authenticator_success_alert'))
	<div class="row authenticator_alert">
		<div class="col-sm-12">
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{{ Session::get('authenticator_success_alert') }}}
			</div>
		</div>
	</div>
@endif