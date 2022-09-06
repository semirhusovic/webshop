<?php

namespace App\Services;

use App\Exports\UsersExport;
use App\Models\Manufacturer;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use MeiliSearch\Client;

class UserService
{
    public function searchItems($request)
    {
        return User::search($request->filter)->paginate();

//        return User::search($filter, function ($meilisearch, $filter, $options) use ($request) {
//            $options['filter'] = 'role_id = 3';
//            return $meilisearch->search($filter, $options);
//        })->paginate();

//        $filter = $request->filter;
//        return User::query()
//            ->when($request->filter, function ($query) use ($filter) {
//                $query->where('first_name', 'like', '%'.$filter.'%')
//                    ->orWhere('last_name', 'like', '%'.$filter.'%')
//                    ->orWhere('email', 'like', '%'.$filter.'%');
//            })
//            ->paginate();
    }

    public function deleteUser($user):void
    {
        $user->delete();
    }

    public function updateUser($request, $user): void
    {
        $user->updateOrFail($request->all());
    }

    public function exportUsers($request)
    {
        $users = User::query()
            ->join('roles', 'role_id', '=', 'roles.id')
            ->when($request->role, function ($query) use ($request) {
                $query->whereIn("roles.id", $request->role);
            })
        ->select('first_name', 'last_name', 'email', 'phone', 'role_name')->orderBy('users.id')->get();
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
}
