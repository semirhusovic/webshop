<?php

namespace App\Services;

use App\Models\Manufacturer;
use App\Models\User;

class UserService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        return User::query()
            ->when($request->filter, function ($query) use ($filter) {
                $query->where('first_name', 'like', '%'.$filter.'%')
                    ->orWhere('last_name', 'like', '%'.$filter.'%')
                    ->orWhere('email', 'like', '%'.$filter.'%');
            })
            ->paginate();
    }

    public function deleteUser($user):void
    {
        $user->delete();
    }

    public function updateUser($request, $user): void
    {
        $user->updateOrFail($request->all());
    }
}
