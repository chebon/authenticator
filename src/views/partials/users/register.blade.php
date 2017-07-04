<div class="row" id="register-form">
    
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

    {{ Form::open(array('action' => 'Ejimba\Authenticator\Controllers\AuthController@do_register', 'class'=>'form-horizontal')) }}

    <div class="col-sm-12 form-group @if ($errors->has('first_name')) has-error @endif">
        {{ Form::label('first_name', Lang::get('authenticator::partials.users.first_name').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::text('first_name', Session::get('first_name'), array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.first_name'))) }}</div>
        @if ($errors->has('first_name')) <span class="help-block col-sm-offset-3">{{ $errors->first('first_name') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group @if ($errors->has('last_name')) has-error @endif">
        {{ Form::label('last_name', Lang::get('authenticator::partials.users.last_name').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::text('last_name', Session::get('last_name'), array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.last_name'))) }}</div>
        @if ($errors->has('last_name')) <span class="help-block col-sm-offset-3">{{ $errors->first('last_name') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group @if ($errors->has('username')) has-error @endif">
        {{ Form::label('username', Lang::get('authenticator::partials.users.username').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::text('username', Session::get('username'), array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.username'))) }}</div>
        @if ($errors->has('username')) <span class="help-block col-sm-offset-3">{{ $errors->first('username') }}</span> @endif
    </div>

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

    <div class="col-sm-12 form-group @if ($errors->has('password_confirmation')) has-error @endif">
        {{ Form::label('password_confirmation', Lang::get('authenticator::partials.users.password_confirmation').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.password_confirmation'))) }}</div>
        @if ($errors->has('password_confirmation')) <span class="help-block col-sm-offset-3">{{ $errors->first('password_confirmation') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get('authenticator::partials.users.register'), array('class' => 'btn btn-primary')) }}
        </div>
    </div>

    {{ Form::close() }}

</div>