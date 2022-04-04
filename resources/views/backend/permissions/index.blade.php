@extends('layouts.backend.app')
<?php
$navLink = 'permissions';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <a class="nav-link btn btn-outline-success" href="#">
                            <i class="fa fa-align-justify"></i> Total: <span
                                class="total-permissions-count">{{$permissions->total()}}</span></a>
                    </div>
                    @if(\App\Library\AppConfig::permission()->canCreatePermission())
                        <div class="col-md-2">
                            <a class="nav-link btn btn-outline-success" href="{{route('backend.permissions.create')}}">
                                <i class="fa fa-plus"></i> Add New</a>
                        </div>
                        <div class="col-md-2">
                            <a class="nav-link " href="{{route('backend.permissions.bulk-store.create')}}">Bulk
                                Insert</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card card shadow mb-4">
            {{ Breadcrumbs::render('backend.permissions.index') }}

            <div class="card-body ">
                <div class="col-md-12">
                    {!! Form::open(['route' => 'backend.permissions.index', 'method' => 'GET', 'id' => 'permissions-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', request('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'All'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" type="submit">Search
                            </button>
                            <a class="btn btn-danger" type="reset" id="reset"
                               href="{{route('backend.permissions.index')}}">
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $key => $permission)

                    <tr>
                        <td>{{$key + $permissions->firstItem()}}</td>
                        <td>
                            {{$permission->name}}
                        </td>
                        <td width="14%" class="text-center">
                            @if(\App\Library\AppConfig::permission()->canReadPermission())
                                <a href="{{route('backend.permissions.show', $permission)}}"
                                   title="Show"
                                   class="btn btn-success btn-circle"><i class="fas fa-eye "></i>
                                </a>
                            @endif

                            @if(\App\Library\AppConfig::permission()->canUpdatePermission())
                                <a href="{{route('backend.permissions.edit', $permission)}}"
                                   title="Edit"
                                   class="btn btn-primary btn-circle"><i class="fas fa-edit "></i>
                                </a>
                            @endif
                            @if(\App\Library\AppConfig::permission()->canDeletePermission())
                                <a href="#"
                                   class="btn btn-danger btn-circle delete"
                                   data-delete-route="{{route('backend.permissions.destroy', $permission)}}"
                                   title="Delete">
                                    <i class="fas fa-trash "></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Permissions.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$permissions->appends(request()->input())->links()}}
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.data-table').stacktable();
    </script>

    <script>
        let $_total_permission_count = $('.total-permissions-count');
    </script>

    <script>
        $('.delete').click(function () {
            let $_this = $(this);
            Swal.fire({
                title: 'Are you sure you want to delete this permission?',
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
                        },
                        beforeSend: function () {
                            $('#gif-loading-screen').show();
                        },
                    }).then(function (data, textStatus, jqXHR) {
                        $('#gif-loading-screen').hide();
                        if (data.status) {
                            toastr.success(data.message);
                            $_total_permission_count.html(parseInt($_total_permission_count.html()) - 1);
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
