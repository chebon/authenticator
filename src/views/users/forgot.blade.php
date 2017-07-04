@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::users.forgot') }}
@stop

@section('content')

	<div class="col-sm-12">
		<h2 class="page-header">{{ Lang::get('authenticator::partials.users.forgot') }}</h2>
		{{ Authenticator::displayForgotForm() }}
	</div>

@stop