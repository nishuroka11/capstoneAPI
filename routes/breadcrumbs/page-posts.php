<?php

$backend = 'backend.';


// Page Post
Breadcrumbs::for($backend . 'page-posts.index', function ($trail) use ($backend) {
    $trail->push('All Page Posts', route($backend . 'page-posts.index'));
});

// Page Post > Create Page Post
Breadcrumbs::for($backend . 'page-posts.show', function ($trail) use ($backend) {
    $trail->parent($backend . 'page-posts.index');
    $trail->push('Show Page Post', '');
});

// Page Post > Create Page Post
Breadcrumbs::for($backend . 'page-posts.create', function ($trail) use ($backend) {
    $trail->parent($backend . 'page-posts.index');
    $trail->push('Create Page Post', route($backend . 'page-posts.create'));
});

// Page Post > Edit Page Post
Breadcrumbs::for($backend . 'page-posts.edit', function ($trail) use ($backend) {
    $trail->parent($backend . 'page-posts.index');
    $trail->push('Edit Page Post');
});
