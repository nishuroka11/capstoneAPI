<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>System Audit!</title>

    <meta name="robots" content="noindex, nofollow" />
</head>
<body>
<div class="container">
    <h1>System Audit</h1>
    {!! Form::open(['route' => ['backend.morningstar.audit.logs'], 'id' => 'page-post-edit-form', 'method' => "GET"]) !!}
    <div class="row my-2">
        <div class="col-md-6">
            {!! Form::label('per_page', "Per Page:") !!}
            {!! Form::select('per_page', [5 => 5, 10 => 10, 20 => 20, 30 => 30], $perPage, ['class' => 'form-select ', 'required', 'id' => 'per_page']) !!}
        </div>
        <div class="col-md-12 mt-2">
            <button class="btn btn-success">Search</button>
        </div>
        <div class="col-md-12"></div>
    </div>

    {!! Form::close() !!}

</div>
<div class="row">
    <div class="col-md-12">
        <div class="container">
            {!! $systemAudits->appends(request()->input())->links()  !!}
        </div>

        <table class="table table-hover table-bordered" style="overflow: auto">
            <thead>
            <tr>
                <th>S.No.</th>
                <th>Event</th>
                <th>Auditable Type</th>
                <th>Auditable ID</th>
                <th style="width: 2.66%">Old Value</th>
                <th>New Value</th>
                <th>Url</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @php
                $loopCount = 1;
            @endphp
            @foreach($systemAudits as $systemAudit)
                <tr>
                    <td>{{$loopCount++}}</td>
                    <td>{{$systemAudit->event}}</td>
                    <td>{{$systemAudit->auditable_type}}</td>
                    <td>{{$systemAudit->auditable_id}}</td>
                    <td style="width: 2.66%">{{$systemAudit->old_values}}</td>
                    <td style="width: 2.66%">{{$systemAudit->new_values}}</td>
                    <td>{{$systemAudit->url}}</td>
                    <td>{{$systemAudit->ip_address}}</td>
                    <td>{{$systemAudit->user_agent}}</td>
                    <td>{{$systemAudit->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="container">

            {!! $systemAudits->appends(request()->input())->links()  !!}
        </div>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>
