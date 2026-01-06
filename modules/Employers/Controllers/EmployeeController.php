<?php

namespace Modules\Employers\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Employers\Controllers\Requests\EmployeeUpdateProfileRequest;
use Modules\Employers\DTOs\EmployeeProfileDTO;
use Modules\Employers\Services\EmployeeServices;

class EmployeeController extends Controller
{
    private $service;
    function __construct(EmployeeServices $service)
    {
        $this->service = $service;
    }
    function profileView()
    {
        $employeeObj = Auth::guard('employee')->user();
        return view('employee::employee.profile', compact('employeeObj'));
    }
    function changePasswordView()
    {
        $employeeObj = Auth::guard('employee')->user();
        return view('employee::employee.change-password', compact('employeeObj'));
    }
    function updateProfile(EmployeeUpdateProfileRequest $request)
    {
        $validated = $request->validated();

        $this->service->updateEmployeeProfile(

            new EmployeeProfileDTO(
                $validated['firstname'],
                $validated['lastname'],
                $validated['address'],
                $validated['company_name'],
                $validated['company_website'],
                $validated['phone'] ?? null,
                $validated['avatar'] ?? null,

            ),
            $validated['email'],
        );
        return back()->with("success", "profile updated");
    }
    function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        if (!Hash::check($request->current_password, auth()->guard('employee')->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect',
            ]);
        }
        $this->service->changePassword($request['email'], $request['password']);
        return back()->with("success", "password updated");
    }
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login');
    }
}
