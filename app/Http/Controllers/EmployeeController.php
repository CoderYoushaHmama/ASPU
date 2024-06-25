<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //Add Employee
    public function addEmployee(UserRequest $userRequest, PermissionRequest $permissionRequest)
    {
        $userRequest->validated([
            'username' => 'unique:users,username',
            'email' => 'unique:users,email',
            'phone_number' => 'unique:users,phone_number',
        ]);
        if ($userRequest->password === $userRequest->confirm_password)
            $employee = User::create([
                'username' => $userRequest->username,
                'email' => $userRequest->email,
                'phone_number' => $userRequest->phone_number,
                'address' => $userRequest->address,
                'password' => Hash::make($userRequest->password),
                'type' => 'E',
            ]);
        else
            return error('some thing went wrong', 'wrong password confirmation', 502);

        $roles = explode(',', $permissionRequest->roles);
        foreach ($roles as $role)
            UserRole::create([
                'user_id' => $employee->id,
                'role_id' => $role,
            ]);

        return success(null, 'this employee added successfully', 201);
    }

    //Edit Employee Function
    public function editEmployee(User $employee, UserRequest $userRequest, PermissionRequest $permissionRequest)
    {
        $userRequest->validated([
            'username' => 'unique:users,username,' . $employee->id,
            'email' => 'unique:users,email,' . $employee->id,
            'phone_number' => 'unique:users,phone_number,' . $employee->id,
        ]);
        $employee->update([
            'username' => $userRequest->username,
            'email' => $userRequest->email,
            'phone_number' => $userRequest->phone_number,
            'address' => $userRequest->address,
        ]);

        if ($userRequest->password) {
            if ($userRequest->password === $userRequest->confirm_password)
                $employee->update([
                    'password' => Hash::make($userRequest->password),
                ]);
            else
                return error('some thing went wrong', 'wrong password confirmation', 502);
        }

        $roles = explode(',', $permissionRequest->roles);
        foreach ($employee->userRoles as $userRole)
            $userRole->delete();
        foreach ($roles as $role)
            UserRole::create([
                'user_id' => $employee->id,
                'role_id' => $role,
            ]);

        return success(null, 'this employee updated successfully');
    }

    //Delete Employee Function
    public function deleteEmployee(User $employee)
    {
        $employee->delete();

        return success(null, 'this employee deleted successfully');
    }

    //Get Employees Function
    public function getEmployees()
    {
        $employees = User::where('type', 'E')->get();

        return success($employees, null);
    }

    //Get Employee Information Function
    public function getEmployeeInformation(User $employee)
    {
        return success($employee->with('roles')->find($employee->id), null);
    }
}