<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Modules\Users\Repositories\UserRepository;

class DashboardController extends BackendController
{
    protected $additionalViewPrefix = "dashboards";

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userCount = $this->userRepository->getQueryWithoutSuperAdmin()->count();

        return $this->view('index', [
            'userCount' => $userCount,
            'title' => 'Dashboard'
        ]);
    }
}
