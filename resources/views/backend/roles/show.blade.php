@extends('layouts.backend.app')
<?php
$navLink = 'roles';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            {{Breadcrumbs::render('backend.roles.show')}}
            <div class="card-body">
                @include('backend.roles.partials.role', ['role' => $role])
            </div>
        </div>

    </div>

@endsection
