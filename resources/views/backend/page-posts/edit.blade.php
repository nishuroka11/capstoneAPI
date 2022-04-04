@extends('layouts.backend.app')
<?php
$navLink = 'page-posts';
?>
@section('content')
    <div class="pl-3 pr-3">
        @include('backend.page-posts.partials.form')
    </div>
@endsection
