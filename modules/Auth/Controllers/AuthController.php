<?php

namespace Modules\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Auth\Controllers\Requests\EmployeeLoginRequest;
use Modules\Auth\Controllers\Requests\EmployeeRegisterRequest;
use Modules\Auth\Controllers\Requests\UserLoginRequest;
use Modules\Auth\Controllers\Requests\UserRegisterRequest;
use Modules\Auth\DTOs\Employee\EmployeeLoginDTO;
use Modules\Auth\DTOs\Employee\EmployeeRegisterDTO;
use Modules\Auth\DTOs\User\UserLoginDTO;
use Modules\Auth\DTOs\User\UserRegisterDTO;
use Modules\Auth\Services\EmployeeService;
use Modules\Auth\Services\UserServices;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserServices $userService,
        private readonly EmployeeService $Employeeservice,
    ) {}
    public function loginView()
    {
        return view('auth::auth.login');
    }
    public function registerView()
    {
        return view('auth::auth.register');
    }
    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();

        $this->userService->registerService(new UserRegisterDTO(
            $validated['firstname'],
            $validated['lastname'],
            $validated['email'],
            $validated['password'],
            $validated['phone'] ?? null,
            $request->file('avatar') ?? null,
        ));
        return redirect()
            ->route('user.login.view')
            ->with('success', 'Account created successfully');
    }
    public function login(UserLoginRequest $request)
    {
        $validated = $request->validated();
        $result = $this->userService->loginService(new UserLoginDTO(
            $validated['email'],
            $validated['password'],
        ));
        if ($result) {

            return redirect()->route("user.dashboard");
        } else {
            return back()->with("error", "error occurred")->withInput($request->only("email"));
        }
    }
    public function logout() {}

    public function employeeRegister(EmployeeRegisterRequest $request)
    {
        $validated = $request->validated();
        $this->Employeeservice->registerService(new EmployeeRegisterDTO(
            $validated['firstname'],
            $validated['lastname'],
            $validated['email'],
            $validated['password'],
            $validated['company_name'],
            $validated['company_website'],
            $validated['phone'] ?? null,
            $validated['address'],
            $validated['status'] ?? false,
            $request->file('avatar') ?? null,
        ));
        return redirect()
            ->route('employee.login.view')
            ->with('success', 'Account created successfully');
    }
    public function employeeLogin(EmployeeLoginRequest $request)
    {
        $validated = $request->validated();
        $result = $this->Employeeservice->loginService(new EmployeeLoginDTO(
            $validated['email'],
            $validated['password'],
        ));
        if ($result) {
            return redirect()->route("employee.dashboard");
        } else {
            return back()->with("error", "error occurred")->withInput($request->only("email"));
        }
    }
    public function employeeRegisterView()
    {
        return view('auth::employee.register');
    }
    public function employeeLoginView()
    {
        return view('auth::employee.login');
    }
}
