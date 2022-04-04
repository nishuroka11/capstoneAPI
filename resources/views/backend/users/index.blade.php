@extends('layouts.backend.app')
<?php
$navLink = 'users';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <a class="nav-link btn btn-outline-success" href="#">
                            <i class="fa fa-align-justify"></i> Total: <span
                                class="total-users-count">{{$users->total()}}</span></a>
                    </div>
                    <div class="col-md-2">
                        <a class="nav-link btn btn-outline-success" href="{{route('backend.users.create')}}">
                            <i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card shadow mb-4">
            {{ Breadcrumbs::render('backend.users.index') }}

            <div class="card-body ">
                <div class="col-md-12">
                    {!! Form::open(['route' => 'backend.users.index', 'method' => 'GET', 'id' => 'users-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', request('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'All'])!!}
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', request('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'All'])!!}
                                </div>
                                @if(auth()->check() && \App\Library\AppConfig::permission()->canReadRole())
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        {!! Form::label('role_id', 'Role') !!}
                                        {!! Form::select('role_id',$roles, request('role_id'), ['class' => 'custom-select form-control ', 'id' => 'role_id', 'placeholder' => 'All'])!!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" type="submit">Search
                            </button>
                            <a class="btn btn-danger" type="reset" id="reset"
                               href="{{route('backend.users.index')}}">
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
                    <th>Email</th>
                    @if(\App\Library\AppConfig::permission()->canReadRole())
                        <th>Role</th>
                    @endif
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $key => $user)

                    <tr>
                        <td>{{$key + $users->firstItem()}}</td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        @if(\App\Library\AppConfig::permission()->canReadRole())
                            <td>
                                {{$user->roles->first()->name ?? ''}}
                            </td>
                        @endif
                        <td width="14%" class="text-center">
                            <a href="{{route('backend.users.show', $user)}}"
                               title="Show"
                               class="btn btn-success btn-circle"><i class="fas fa-eye "></i>
                            </a>

                            <a href="{{route('backend.users.edit', $user)}}"
                               title="Edit"
                               class="btn btn-primary btn-circle"><i class="fas fa-edit "></i>
                            </a>
                            <a href="#"
                               class="btn btn-danger btn-circle delete" data-id="{{$user->user_id}}"
                               data-delete-route="{{route('backend.users.destroy', $user)}}"
                               title="Delete">
                                <i class="fas fa-trash "></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Users.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$users->appends(request()->input())->links()}}
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.data-table').stacktable();
    </script>

    <script>
        let $_total_user_count = $('.total-users-count');
    </script>

    <script>
        $('#role_id').select2();
    </script>

    <script>
        $('.delete').click(function () {
            let $_this = $(this);
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
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
                            $_total_user_count.html(parseInt($_total_user_count.html()) - 1);
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
