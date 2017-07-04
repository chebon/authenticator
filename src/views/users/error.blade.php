@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::users.error') }}
@stop

@section('content')

	<div class="col-sm-12">

		<h2 class="page-header">{{ Lang::get('authenticator::partials.users.error') }}</h2>

		{{ Authenticator::displayContactSystemAdminForm() }}
	</div>

@stop