@extends('layouts.backend.app')
<?php
$navLink = 'roles';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <a class="nav-link btn btn-outline-success" href="#">
                            <i class="fa fa-align-justify"></i> Total: <span
                                class="total-roles-count">{{$roles->total()}}</span></a>
                    </div>
                    @if(\App\Library\AppConfig::permission()->canCreateRole())
                        <div class="col-md-2">
                            <a class="nav-link btn btn-outline-success" href="{{route('backend.roles.create')}}">
                                <i class="fa fa-plus"></i> Add New</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card card shadow mb-4">
            {{ Breadcrumbs::render('backend.roles.index') }}

            <div class="card-body ">
                <div class="col-md-12">
                    {!! Form::open(['route' => 'backend.roles.index', 'method' => 'GET', 'id' => 'roles-form']) !!}
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
                               href="{{route('backend.roles.index')}}">
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
                @forelse($roles as $key => $role)

                    <tr>
                        <td>{{$key + $roles->firstItem()}}</td>
                        <td>
                            {{$role->name}}
                        </td>
                        <td width="14%" class="text-center">
                            @if(\App\Library\AppConfig::permission()->canReadRole())
                                <a href="{{route('backend.roles.show', $role)}}"
                                   title="Show"
                                   class="btn btn-success btn-circle"><i class="fas fa-eye "></i>
                                </a>
                            @endif

                            @if(\App\Library\AppConfig::permission()->canUpdateRole())
                                <a href="{{route('backend.roles.edit', $role)}}"
                                   title="Edit"
                                   class="btn btn-primary btn-circle"><i class="fas fa-edit "></i>
                                </a>
                            @endif

                            @if(\App\Library\AppConfig::permission()->canDeleteRole())
                                <a href="#"
                                   class="btn btn-danger btn-circle delete" data-id="{{$role->id}}"
                                   data-delete-route="{{route('backend.roles.destroy', $role)}}"
                                   title="Delete">
                                    <i class="fas fa-trash "></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Roles.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$roles->appends(request()->input())->links()}}
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.data-table').stacktable();
    </script>

    <script>
        let $_total_role_count = $('.total-roles-count');
    </script>

    <script>

        $('.delete').click(function () {
            let $_this = $(this);
            Swal.fire({
                title: 'Are you sure you want to delete this role?',
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
                            $_total_role_count.html(parseInt($_total_role_count.html()) - 1);
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
