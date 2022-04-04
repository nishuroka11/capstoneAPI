@if($isEdit)
    {!! Form::model($permission, ['route' => ['backend.permissions.update', $permission],'id' => 'permission-create-form', 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => ['backend.permissions.store'], 'id' => 'permission-edit-form']) !!}
@endif
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card">
            @if($isEdit)
                {{Breadcrumbs::render('backend.permissions.edit')}}
            @else
                {{Breadcrumbs::render('backend.permissions.create')}}
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span
                                    class="required-field"></span></label>
                            {!! Form::text('name', null, ['class' => getFormControlClass('name', $errors), 'placeholder' => 'Enter a name', 'required', 'id' => 'name']) !!}
                            {!! getFormInputErrorMessage('name', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="text-left">
                    {!! Form::submit($isEdit ? 'Update' : 'Create', ['class' => 'btn btn-success submit-button']) !!}
                    <a href="{{route('backend.permissions.index')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
