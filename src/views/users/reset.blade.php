@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::users.reset') }}
@stop

@section('content')

	<div class="col-sm-12">

		<h2 class="page-header">{{ Lang::get('authenticator::partials.users.reset') }}</h2>

		{{ Authenticator::displayResetForm($password_reset_code) }}
	</div>

@stop