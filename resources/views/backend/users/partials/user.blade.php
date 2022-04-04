@if(!empty($user))
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p><b>Name:</b> {{$user->name}}</p>
            </div>
            <div class="col-md-6">
                <p><b>Email:</b> {{$user->email}}</p>
            </div>
        </div>
    </div>
@endif
