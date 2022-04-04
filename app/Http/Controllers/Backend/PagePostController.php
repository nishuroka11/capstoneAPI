<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Models\PagePost;
use App\Modules\PagePosts\Requests\PagePostCreateRequest;
use App\Modules\PagePosts\Requests\PagePostUpdateRequest;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\PagePosts\Repositories\PagePostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PagePostController extends BackendController
{
    protected $additionalViewPrefix = "page-posts";

    /**
     * @var PagePostRepository
     */
    private $pagePostRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * PagePostController constructor.
     * @param PagePostRepository $pagePostRepository
     */
    public function __construct(
        PagePostRepository $pagePostRepository
    )
    {
        $this->pagePostRepository = $pagePostRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('read', $this->pagePostRepository->getModel());

        $pagePosts = $this->pagePostRepository->getModel();

        $filterData = [
            'page_post_name_like' => extractFromArray($request, 'page_post_name'),
            'page_post_slug_like' => extractFromArray($request, 'page_post_slug'),
        ];

        $pagePosts = $this->pagePostRepository->filterQuery($pagePosts, $filterData);

        $pagePostCount = $pagePosts->count();

        $pagePosts = $pagePosts->paginate(config('constants.records_per_page'));

        return $this->view('index', [
            'pagePosts' => $pagePosts,
            'pagePostCount' => $pagePostCount,
            'title' => 'Page Post Listing',
        ]);
    }

    public function create()
    {
        $this->authorize('create', $this->pagePostRepository->getModel());

        return $this->view('create', [
            'title' => 'Create Page Post',
            'isEdit' => false,
        ]);
    }

    public function store(PagePostCreateRequest $request)
    {
        $this->authorize('create', $this->pagePostRepository->getModel());

        try {
            DB::beginTransaction();

            $formData = sanitize($request->except('page_post_description'));

            $formData['page_post_description'] = clean($request->page_post_description);

            $pagePost = $this->pagePostRepository->create($formData);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Page Post store ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.page-posts.edit', $pagePost)->with('success', 'Page Post Created Successfully!');
    }


    public function show(PagePost $pagePost)
    {
        $this->authorize('read', $this->pagePostRepository->getModel());

        return $this->view('show', [
            'title' => "Show Page Post",
            'pagePost' => $pagePost,
        ]);
    }

    public function edit(PagePost $pagePost)
    {
        $this->authorize('update', $this->pagePostRepository->getModel());

        return $this->view('edit', [
            'title' => 'Update Page Post',
            'pagePost' => $pagePost,
            'isEdit' => true,
        ]);
    }

    public function update(PagePostUpdateRequest $request, PagePost $pagePost)
    {
        $this->authorize('update', $this->pagePostRepository->getModel());

        try {
            DB::beginTransaction();

            $formData = sanitize($request->except('page_post_description'));

            $formData['page_post_description'] = clean($request->page_post_description);

            $pagePost = $this->pagePostRepository->update($formData, $pagePost->page_post_id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('PagePost update ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.page-posts.edit', $pagePost)->with('success', 'Page Post Updated Successfully!');
    }

    public function destroy(PagePost $pagePost)
    {
        $this->authorize('delete', $this->pagePostRepository->getModel());

        try {
            DB::beginTransaction();

            $this->pagePostRepository->delete($pagePost->page_post_id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('PagePost delete ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }

        return jsonresSuccess();
    }

}
