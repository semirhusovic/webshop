<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    private $roles;
    public function __construct()
    {
        $this->roles = Role::all();
    }

    public function model(array $row)
    {
        $role = $this->roles->where('role_name', '=', $row['role'])->first();
//        dump($role->id);
        return new User([
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "password" => Hash::make('password'),
            "role_id" => $role->id
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string',],
            'last_name' => ['required', 'string',],
            'phone' => ['required'],
            'role' => ['required','string',Rule::in(['Buyer','Admin','Super Admin'])],
            'email' => ['required', 'unique:users',],
        ];
    }



    public function headingRow(): int
    {
        return 1;
    }
}
