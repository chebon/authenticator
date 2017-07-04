@extends('authenticator::layout')

@section('title')
	{{ Lang::get('authenticator::users.register') }}
@stop

@section('content')

	<div class="col-sm-12">
	
		<h2 class="page-header">{{ Lang::get('authenticator::partials.users.register') }}</h2>

		{{ Authenticator::displayRegisterForm() }}
	
	</div>

@stop