@extends('layouts.backend.app')
<?php
$navLink = 'permissions';
?>
@section('content')
    <div class="pl-3 pr-3">
        @include('backend.permissions.partials.bulk-store-form')
    </div>
@endsection
