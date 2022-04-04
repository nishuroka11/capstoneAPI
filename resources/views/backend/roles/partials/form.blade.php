@if($isEdit)
    {!! Form::model($role, ['route' => ['backend.roles.update', $role],'id' => 'role-create-form', 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => ['backend.roles.store'], 'id' => 'role-edit-form']) !!}
@endif
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card">
            @if($isEdit)
                {{Breadcrumbs::render('backend.roles.edit')}}
            @else
                {{Breadcrumbs::render('backend.roles.create')}}
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
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Can Access Web <span
                                    class="required-field"></span></label>
                            {!! Form::select('can_access_web', getBooleanLists(), null, ['class' => 'custom-select '. getFormControlClass('can_access_web', $errors), 'required', 'id' => 'can_access_web']) !!}
                            {!! getFormInputErrorMessage('can_access_web', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="name">Permission <span
                                class="required-field"></span></label>
                        @foreach($permissions as $key => $permission)
                            @if(is_array($permission))
                                <div class="form-group" id="div-{{$key}}">
                                    <input type="checkbox" name="checkbox-{{ $key }}"
                                           onclick="setPermissions('{{ $key }}',this)"
                                           id="{{$key}}">
                                    <label for="{{$key}}" class="e-label e-label--margin-y">
                                        <span class="u-checkbox-icon"></span>
                                        <span class="u-inline">{{'Manage '. ucfirst($key)}}</span>
                                    </label>
                                    <br>
                                    @foreach($permission as $key_one => $value)
                                        {!! Form::checkbox('permissions['.$key_one.']', $key_one , isset($role) && in_array($key_one, $permissionArray) ? true : false, ['id' => 'permissions['.$value.']'] ) !!}
                                        <label for="{{'permissions['.$value.']'}}" class="e-label e-label--margin-y">
                                            <span class="u-checkbox-icon"></span>
                                            <span class="u-inline mr-2">
                            {{ucfirst( str_replace($key.'-', '', $value))}}
                        </span>
                                        </label>
                                        {!! $errors->first('permissions['.$value.']', '<div class="text-danger">:message</div>') !!}
                                    @endforeach
                                </div>
                            @else
                                <div class="form-group">
                                    {!! Form::checkbox('permissions['.$key.']', $key, isset($role)  && in_array($key, $permissionArray) ? true : false, ['id' => 'permissions['.$permission.']'] ) !!}
                                    <label for="{{'permissions['.$permission.']'}}" class="e-label e-label--margin-y">
                                        <span class="u-checkbox-icon"></span>
                                        <span class="u-inline">
                        {{ucfirst( str_replace($key.'-', ' ', $permission))}}
                    </span>
                                    </label>
                                    {!! $errors->first('permissions['.$key.']', '<div class="text-danger">:message</div>') !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="text-left">
                    {!! Form::submit($isEdit ? 'Update' : 'Create', ['class' => 'btn btn-success submit-button']) !!}
                    <a href="{{route('backend.roles.index')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

@push('extra-scripts')
    <script type="text/javascript">
        function setPermissions(key, main) {
            value = $(main).prop('checked');
            $("#div-" + key + " input").each(function (e, item) {
                $(item).prop('checked', value);
            });
        }
    </script>
@endpush
