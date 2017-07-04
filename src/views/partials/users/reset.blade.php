<div class="row" id="reset-form">
	
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

	{{ Form::open(array('action' => 'Ejimba\Authenticator\Controllers\AuthController@do_reset', 'class'=>'form-horizontal')) }}
    
    {{ Form::hidden('password_reset_code', $password_reset_code) }}

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
            {{ Form::submit(Lang::get('authenticator::partials.users.reset'), array('class' => 'btn btn-primary')) }}
        </div>

    </div>

    {{ Form::close() }}

</div>