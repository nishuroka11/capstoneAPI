{!! Form::open(['route' => ['backend.permissions.bulk-store.store'], 'id' => 'permission-bulk-store-form']) !!}
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card">
            {{Breadcrumbs::render('backend.permissions.bulk-store.create')}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span
                                    class="required-field"></span></label>
                            <small class="form-text text-primary">ex: For users, put value: users</small>
                            {!! Form::text('name', null, ['class' => getFormControlClass('name', $errors), 'placeholder' => 'Enter a name', 'required', 'id' => 'name']) !!}
                            {!! getFormInputErrorMessage('name', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="text-left">
                    {!! Form::submit('Bulk Insert', ['class' => 'btn btn-success submit-button']) !!}
                    <a href="{{route('backend.permissions.index')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
