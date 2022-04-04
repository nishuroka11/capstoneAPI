@if($isEdit)
    {!! Form::model($user, ['route' => ['backend.users.update', $user],'id' => 'user-create-form', 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => ['backend.users.store'], 'id' => 'user-edit-form']) !!}
@endif
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card">
            @if($isEdit)
                {{Breadcrumbs::render('backend.users.edit')}}
            @else
                {{Breadcrumbs::render('backend.users.create')}}
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name <span
                                    class="required-field"></span></label>
                            {!! Form::text('name', null, ['class' => getFormControlClass('name', $errors), 'placeholder' => 'Enter a name', 'required', 'id' => 'name']) !!}
                            {!! getFormInputErrorMessage('name', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md-12"></div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email <span
                                    class="required-field"></span></label>
                            {!! Form::email('email', null, ['class' => getFormControlClass('email', $errors), 'placeholder' => 'Enter a Email', 'required', 'id' => 'email']) !!}
                            {!! getFormInputErrorMessage('email', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md-12"></div>

                    @if(canUpdatePassword(!empty($user) ? $user->user_id : null))
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password
                                    @if(!$isEdit)
                                        <span
                                            class="required-field"></span>
                                    @else
                                        (Enter blank if you do not wish to update password)
                                    @endif</label>
                                {!! Form::password('password', ['class' => getFormControlClass('password', $errors), 'placeholder' => 'Password',$isEdit ?:'required', 'id' => 'password']) !!}
                                {!! getFormInputErrorMessage('password', $errors) !!}
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                    @endif

                    @if(\App\Library\AppConfig::permission()->canReadRole())
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Role</label>
                                {!! Form::select('roles',  $roles, $selectedRoleId, ['class' => 'custom-select '. getFormControlClass('roles', $errors), 'id' => 'roles']) !!}
                                {!! getFormInputErrorMessage('roles', $errors) !!}
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                    @endif

                </div>

                <div class="text-left">
                    {!! Form::submit($isEdit ? 'Update' : 'Create', ['class' => 'btn btn-success submit-button']) !!}
                    <a href="{{route('backend.users.index')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

@push('extra-scripts')
    <script>
        $('#roles').select2();
    </script>
@endpush
