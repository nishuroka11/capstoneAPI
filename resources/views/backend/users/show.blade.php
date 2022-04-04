@extends('layouts.backend.app')
<?php
$navLink = 'users';
?>
@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                   aria-controls="detail" aria-selected="true">Detail</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="card shadow mb-4 pt-4">
                    <div class="card-body">
                        @include('backend.users.partials.user', ['user' => $user])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
