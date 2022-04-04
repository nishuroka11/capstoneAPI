@extends('layouts.backend.app')
<?php
$navLink = 'page-posts';
?>
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            {{Breadcrumbs::render('backend.page-posts.show')}}
            <div class="card-body">
                @include('backend.page-posts.partials.page-post', ['pagePost' => $pagePost])
            </div>
        </div>

    </div>

@endsection
