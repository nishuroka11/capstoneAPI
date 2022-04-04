<?php

$backend = 'backend.';


// User
Breadcrumbs::for($backend . 'users.index', function ($trail) use ($backend) {
    $trail->push('All Users', route($backend . 'users.index'));
});

// User > Create User
Breadcrumbs::for($backend . 'users.show', function ($trail) use ($backend) {
    $trail->parent($backend . 'users.index');
    $trail->push('Show User', '');
});

// User > Create User
Breadcrumbs::for($backend . 'users.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'users.index');
    $trail->push('Create User', route($backend . 'users.create'));
});

// User > Edit User
Breadcrumbs::for($backend . 'users.edit', function ($trail) use ($backend) {
    $trail->parent($backend . 'users.index');
    $trail->push('Edit User');
});
