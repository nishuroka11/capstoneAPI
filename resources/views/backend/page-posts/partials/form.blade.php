@if($isEdit)
    {!! Form::model($pagePost, ['route' => ['backend.page-posts.update', $pagePost],'id' => 'page-post-create-form', 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => ['backend.page-posts.store'], 'id' => 'page-post-edit-form']) !!}
@endif
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card">
            @if($isEdit)
                {{Breadcrumbs::render('backend.page-posts.edit')}}
            @else
                {{Breadcrumbs::render('backend.page-posts.create')}}
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_post_name">Name <span
                                    class="required-field"></span></label>
                            {!! Form::text('page_post_name', null, ['class' => getFormControlClass('page_post_name', $errors), 'placeholder' => 'Enter a page post name', 'required', 'id' => 'page_post_name']) !!}
                            {!! getFormInputErrorMessage('page_post_name', $errors) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_post_slug">Slug <span
                                    class="required-field"></span></label>
                            {!! Form::text('page_post_slug', null, ['class' => getFormControlClass('page_post_slug', $errors), 'placeholder' => 'Enter a slug', 'required', 'id' => 'page_post_slug', 'readonly', 'ondblclick'=>'this.readOnly=""']) !!}
                            {!! getFormInputErrorMessage('page_post_slug', $errors) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_post_description">Description <span
                                    class="required-field"></span></label>
                            {!! Form::textarea('page_post_description', null, ['class' => getFormControlClass('page_post_description', $errors), 'placeholder' => 'Enter a page description', 'required', 'id' => 'page_post_description', ]) !!}
                            {!! getFormInputErrorMessage('page_post_description', $errors) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>

                <div class="text-left">
                    {!! Form::submit($isEdit ? 'Update' : 'Create', ['class' => 'btn btn-success submit-button']) !!}
                    <a href="{{route('backend.page-posts.index')}}" class="btn btn-danger">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

@push('extra-scripts')
    <script>
        $(document).on('input', '#page_post_name', function () {
            let slug = slugify($(this).val());
            $('#page_post_slug').val(slug);
        });
    </script>
@endpush
