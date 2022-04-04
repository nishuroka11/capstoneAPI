<?php

namespace App\Modules\PagePosts\Repositories;

use App\Models\PagePost;
use App\Repositories\RepositoryImplementation;

class PagePostRepositoryImplementation extends RepositoryImplementation implements PagePostRepository
{
    public function getModel()
    {
        return new PagePost();
    }

    public function filterQuery($query, $data)
    {
        $nameLike = extractFromArray($data, 'name_like');
        $slugLike = extractFromArray($data, 'slug_like');

        if(!empty($nameLike)){
            $query = $this->filterLikeBy($query, 'name', $nameLike);
        }

        if(!empty($slugLike)){
            $query = $this->filterLikeBy($query, 'page_post_slug', $slugLike);
        }

        return $query;
    }
}
