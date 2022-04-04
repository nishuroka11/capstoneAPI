<?php

namespace App\Modules\PagePosts\Repositories;

use App\Repositories\Repository;

interface PagePostRepository extends Repository
{
    public function getModel();
}
