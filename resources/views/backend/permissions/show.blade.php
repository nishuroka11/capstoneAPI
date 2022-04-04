@extends('layouts.backend.app')
<?php
$navLink = 'permissions';
?>
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            {{Breadcrumbs::render('backend.permissions.show')}}
            <div class="card-body">
                @include('backend.permissions.partials.permission', ['permission' => $permission])
            </div>
        </div>

    </div>

@endsection
