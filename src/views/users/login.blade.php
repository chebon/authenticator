@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::users.login') }}
@stop

@section('content')

	<div class="col-sm-12">

		<h2 class="page-header">{{ Lang::get('authenticator::partials.users.login') }}</h2>

		{{ Authenticator::displayLoginForm() }}
	</div>

@stop