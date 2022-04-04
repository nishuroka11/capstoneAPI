@extends('layouts.backend.app')
<?php
$navLink = 'roles';
?>
@section('content')
    <div class="pl-3 pr-3">
        @include('backend.roles.partials.form')
    </div>
@endsection
