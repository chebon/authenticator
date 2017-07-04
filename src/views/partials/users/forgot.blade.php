<div class="row" id="forgot-form">
	
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

	{{ Form::open(array('action' => 'Ejimba\Authenticator\Controllers\AuthController@do_forgot', 'class'=>'form-horizontal')) }}

	<div class="col-sm-12 form-group @if ($errors->has('email')) has-error @endif">
        {{ Form::label('email', Lang::get('authenticator::partials.users.email').':', array('class' => 'col-sm-3 control-label')) }}
        <div class="col-sm-9">{{ Form::text('email', Session::get('email'), array('class' => 'form-control', 'placeholder' => Lang::get('authenticator::partials.users.email'))) }}</div>
        @if ($errors->has('email')) <span class="help-block col-sm-offset-3">{{ $errors->first('email') }}</span> @endif
    </div>

    <div class="col-sm-12 form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get('authenticator::partials.users.reset_password'), array('class' => 'btn btn-primary')) }}
            {{ link_to_action('Ejimba\Authenticator\Controllers\AuthController@login', Lang::get('authenticator::partials.users.login'), array(), array('class' => 'btn')) }}
        </div>
    </div>

    {{ Form::close() }}

</div>