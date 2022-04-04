@extends('layouts.backend.app')
<?php
$navLink = 'users';
?>
@section('content')
    <div class="pl-3 pr-3">
        @include('backend.users.partials.form')
    </div>
@endsection
