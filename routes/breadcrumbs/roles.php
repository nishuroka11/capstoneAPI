<?php

$backend = 'backend.';


// Role
Breadcrumbs::for($backend . 'roles.index', function ($trail) use ($backend) {
    $trail->push('All Roles', route($backend . 'roles.index'));
});

// Role > Create Role
Breadcrumbs::for($backend . 'roles.show', function ($trail) use ($backend) {
    $trail->parent($backend . 'roles.index');
    $trail->push('Show Role', '');
});

// Role > Create Role
Breadcrumbs::for($backend . 'roles.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'roles.index');
    $trail->push('Create Role', route($backend . 'roles.create'));
});

// Role > Edit Role
Breadcrumbs::for($backend . 'roles.edit', function ($trail) use ($backend) {
    $trail->parent($backend . 'roles.index');
    $trail->push('Edit Role');
});

// Role > Bulk Store Role
Breadcrumbs::for($backend . 'roles.bulk-store.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'roles.index');
    $trail->push('Bulk Store Role');
});
