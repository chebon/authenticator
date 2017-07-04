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

	<div class="col-sm-12">
        <p>{{ Lang::get('authenticator::partials.users.contact_system_admin_msg') }}</p>
    </div>

</div>