<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }


    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $filter = $request->filter;
        $users = $this->userService->searchItems($request);
        return view('dashboard.user.index', compact('users', 'filter'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.user.edit', compact('user', 'roles'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $this->userService->updateUser($request, $user);
        return redirect()->route('user.index')->withToastSuccess('User updated successfully!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->userService->deleteUser($user);
        return redirect()->route('user.index')->withToastSuccess('User deleted successfully!');
    }
}
