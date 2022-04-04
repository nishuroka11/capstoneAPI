<?php

$backend = 'backend.';


// Permission
Breadcrumbs::for($backend . 'permissions.index', function ($trail) use ($backend) {
    $trail->push('All Permissions', route($backend . 'permissions.index'));
});

// Permission > Show Permission
Breadcrumbs::for($backend . 'permissions.show', function ($trail) use ($backend) {
    $trail->parent($backend . 'permissions.index');
    $trail->push('Show Permission', '');
});

// Permission > Create Permission
Breadcrumbs::for($backend . 'permissions.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'permissions.index');
    $trail->push('Create Permission', route($backend . 'permissions.create'));
});

// Permission > Edit Permission
Breadcrumbs::for($backend . 'permissions.edit', function ($trail) use ($backend) {
    $trail->parent($backend . 'permissions.index');
    $trail->push('Edit Permission');
});

// Permission > Bulk Store Permission
Breadcrumbs::for($backend . 'permissions.bulk-store.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'permissions.index');
    $trail->push('Bulk Store Permission');
});
