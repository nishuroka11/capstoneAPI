@extends('layouts.backend.app')
<?php
$navLink = 'page-posts';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <a class="nav-link btn btn-outline-success" href="#">
                            <i class="fa fa-align-justify"></i> Total: <span
                                class="total-page-post-count">{{$pagePosts->total()}}</span></a>
                    </div>
                    @if(\App\Library\AppConfig::permission()->canCreatePagePost())
                        <div class="col-md-2">
                            <a class="nav-link btn btn-outline-success" href="{{route('backend.page-posts.create')}}">
                                <i class="fa fa-plus"></i> Add New</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card card shadow mb-4">
            {{ Breadcrumbs::render('backend.page-posts.index') }}

            <div class="card-body ">
                <div class="col-md-12">
                    {!! Form::open(['route' => 'backend.page-posts.index', 'method' => 'GET', 'id' => 'page-post-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', request('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'All'])!!}
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {!! Form::label('page_post_slug', 'Slug') !!}
                                    {!! Form::text('page_post_slug', request('page_post_slug'), ['class' => 'form-control', 'id' => 'page_post_slug', 'placeholder' => 'All', ])!!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" type="submit">Search
                            </button>
                            <a class="btn btn-danger" type="reset" id="reset"
                               href="{{route('backend.page-posts.index')}}">
                                Reset
                            </a>
                        </div><!--  -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table data-table table-hover" width="100%"
                   cellspacing="0">
                <thead class="thead-light">
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pagePosts as $key => $pagePost)

                    <tr>
                        <td>{{$key + $pagePosts->firstItem()}}</td>
                        <td>
                            {{$pagePost->page_post_name}}
                        </td>
                        <td>
                            {{$pagePost->page_post_slug}}
                        </td>
                        <td>
                            {!! $pagePost->page_post_description !!}
                        </td>
                        <td width="14%" class="text-center">
                            @if(\App\Library\AppConfig::permission()->canReadPagePost())
                                <a href="{{route('backend.page-posts.show', $pagePost)}}"
                                   title="Show"
                                   class="btn btn-success btn-circle"><i class="fas fa-eye "></i>
                                </a>
                            @endif

                            @if(\App\Library\AppConfig::permission()->canUpdatePagePost())
                                <a href="{{route('backend.page-posts.edit', $pagePost)}}"
                                   title="Edit"
                                   class="btn btn-primary btn-circle"><i class="fas fa-edit "></i>
                                </a>
                            @endif

                            @if(\App\Library\AppConfig::permission()->canDeletePagePost())
                                <a href="#"
                                   class="btn btn-danger btn-circle delete" data-id="{{$pagePost->page_post_id}}"
                                   data-delete-route="{{route('backend.page-posts.destroy', $pagePost)}}"
                                   title="Delete">
                                    <i class="fas fa-trash "></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Page Posts.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$pagePosts->appends(request()->input())->links()}}
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.data-table').stacktable();
    </script>

    <script>
        let $_total_page_post_count = $('.total-page-post-count');
    </script>

    <script>

        $('.delete').click(function () {
            let $_this = $(this);
            Swal.fire({
                title: 'Are you sure you want to delete this page post?',
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: $(this).data('delete-route'),
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        beforeSend: function () {
                            $('#gif-loading-screen').show();
                        },
                    }).then(function (data, textStatus, jqXHR) {
                        $('#gif-loading-screen').hide();
                        if (data.status) {
                            toastr.success(data.message);
                            $_total_page_post_count.html(parseInt($_total_page_post_count.html()) - 1);
                            $_this.parent().parent().remove();
                        } else {
                            toastr.error(data.message);
                        }
                    }, function (jqXHR, textStatus, errorThrown) {
                        $('#gif-loading-screen').hide();
                        toastr.error("Fail");
                    });
                }
            });
        });
    </script>
@endsection
