@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::settings.settings') }}
@stop

@section('content')

	<div class="col-sm-6">
		
		@if( Authenticator::user()->hasAccess('users'))
			{{ Authenticator::displayUsersSettings() }}
		@endif

		@if( Authenticator::user()->hasAccess('groups'))
			{{ Authenticator::displayGroupsSettings() }}
		@endif

	</div>

@stop