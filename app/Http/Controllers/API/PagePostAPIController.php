<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use App\Modules\PagePosts\Repositories\PagePostRepository;
use App\Modules\PagePosts\Resources\PagePostResource;

class PagePostAPIController extends APIController
{
    /**
     * @var PagePostRepository
     */
    private $pagePostRepository;

    /**
     * PagePostAPIController constructor.
     * @param PagePostRepository $pagePostRepository
     */
    public function __construct(PagePostRepository $pagePostRepository)
    {
        $this->pagePostRepository = $pagePostRepository;
    }

    public function getPagePost($slug)
    {
        $pagePost = $this->pagePostRepository->findBy('page_post_slug', $slug);

        if (empty($pagePost)) {
            return jsonresNotFound();
        }

        return jsonresSuccess(new PagePostResource($pagePost));
    }
}
