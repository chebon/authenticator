<div class="row" id="user-settings-form">
	
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

    <h2 class="page-header">
        <i class="fa fa-users"></i>
        {{ Lang::get('authenticator::partials.settings.user_settings') }}
    </h2>
	
    @include('authenticator::partials.alerts')

    @if ($users->count())
    	<table id="users-table" class="table">
            <thead>
                <tr>
                    <th>Email Address</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Active</th>
                    <th>Groups</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{{ $user->email }}}</td>
                    <td>{{{ $user->first_name }}} {{{ $user->last_name }}}</td>
                    <td>{{{ $user->mobile }}}</td>
                    <td>{{{ $user->activated ? 'Yes' : 'No' }}}</td>
                    <td>
                        @foreach($user->getGroups() as $group)
                        {{{ '['.ucwords($group->name).']' }}}
                        @endforeach
                    </td>
                    <td>{{ link_to_action('Ejimba\Authenticator\Controllers\UserController@edit', 'Edit', array($user->user_id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        @if($user->activated==1)
                        {{ Form::open(array('method' => 'PATCH', 'action' => array('Ejimba\Authenticator\Controllers\UserController@deactivate', $user->user_id))) }}
                        {{ Form::submit('Deactivate', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                        @else
                        {{ Form::open(array('method' => 'PATCH', 'action' => array('Ejimba\Authenticator\Controllers\UserController@activate', $user->user_id))) }}
                        {{ Form::submit('Activate', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>There are no users in the system</p>
    @endif

</div>
