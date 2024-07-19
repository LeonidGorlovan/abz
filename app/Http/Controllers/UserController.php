<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Http\Requests\UsersLimitRequest;
use App\Services\PositionService;
use App\Services\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $userService;
    private PositionService $positionService;

    public function __construct(UserService $userService, PositionService $positionService)
    {
        $this->userService = $userService;
        $this->positionService = $positionService;
    }

    public function index(UsersLimitRequest $request): View
    {
        return view('users', [
            'page' => $this->userService->getPage(),
            'users' => $this->userService->getLimit($request->validated())
        ]);
    }

    public function view(int $id): View
    {
        return view('user', [
            'user' => $this->userService->view($id)
        ]);
    }

    public function create(): View
    {
        return view('user_create_form', [
            'positions' => $this->positionService->getForSelect()
        ]);
    }

    public function save(UserSaveRequest $request)
    {
        $this->userService->save($request->validated());
        return redirect()->route('user.all');
    }
}
