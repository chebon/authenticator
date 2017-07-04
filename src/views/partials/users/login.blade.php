<div class="row" id="login-form">
	
    <style type="text/css">
        span{
            padding-left: 1em;
            
        }
        .form-group {
            margin-bottom: 0.6em;
        }
        .help-block{
            margin-bottom: 0;
        }
    </style>
	
    @include('authenticator::partials.alerts')

	{{ Form::open(array('action' => 'Ejimba\Authenticator\Controllers\AuthController@do_login', 'class'=>'form-horizontal')) }}

    <div class="col-sm-12 form-group @if ($errors->has('email')) has-error @endif">
        {{ Form::label('email', Lang::get('authenticator::partials.users.email').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::text('email', Session::get('email'), array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.email'))) }}</div>
        @if ($errors->has('email')) <span class="help-block col-sm-offset-3">{{ $errors->first('email') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', Lang::get('authenticator::partials.users.password').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::password('password', array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.password'))) }}</div>
        @if ($errors->has('password')) <span class="help-block col-sm-offset-3">{{ $errors->first('password') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get('authenticator::partials.users.login'), array('class' => 'btn btn-primary')) }}
            {{ Config::get('authenticator::users.password_reset_allowed') ? link_to_action('Ejimba\Authenticator\Controllers\AuthController@forgot', Lang::get('authenticator::partials.users.forgot'), array(), array('class' => 'btn')) :'' }}
        </div>
        <div class="col-sm-offset-3 col-sm-9">
            {{ Config::get('authenticator::users.registration_allowed') ? Lang::get('authenticator::partials.users.register_extended') : '' }}
            {{ Config::get('authenticator::users.registration_allowed') ? link_to_action('Ejimba\Authenticator\Controllers\AuthController@register', Lang::get('authenticator::partials.users.register'), array(), array('class' => 'btn')) :'' }}
        </div>

    </div>

    {{ Form::close() }}

</div>