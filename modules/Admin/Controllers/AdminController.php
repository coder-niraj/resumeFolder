<?php

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\DTOs\AdminLoginDTO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\DTOs\AdminUpdateDTO;
use Modules\Admin\Services\AdminServices;
use Modules\Employers\Models\Employees;
use Modules\Users\Models\User;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    private $service;
    function __construct(AdminServices $service)
    {
        $this->service = $service;
    }
    public function index($request = null)
    {
        return view("admin::auth.login");
    }
    public function dashboardView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.dashboard', compact('adminObj'));
    }
    public function changePasswordView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.changePassword', compact('adminObj'));
    }
    public function profileView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.profile', compact('adminObj'));
    }
    public function usersView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.users', compact('adminObj'));
    }
    public function jobsView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.jobs', compact('adminObj'));
    }

    public function toggleUserStatus(Request $request)
    {
        $adminObj = Auth::guard('admin')->user();
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $validatedData['email'];
        $this->service->getUserToggleService($email);
        return response()->json(['message' => 'Status toggled successfully']);
    }
    public function toggleEmployeeStatus(Request $request)
    {
        $adminObj = Auth::guard('admin')->user();
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $email = $validatedData['email'];

        $this->service->getEmployeeToggleService($email);
        return response()->json(['message' => 'Status toggled successfully ' . $email]);
    }

    public function usersData()
    {

        $query = $this->service->getUsersService();
        $adminObj = Auth::guard('admin')->user();
        return DataTables::of($query)->editColumn('created_at', function ($e) {
            return $e->created_at->format('Y-m-d H:i');
        })->addColumn('blocked', function ($users) {
            return $users->blocked ? '
            <div class="form-switch">
            <input
            class="form-check-input blocked-toggle"
            type="checkbox"
                data-email="' . $users->email . '"
                id="' . $users->id . '"
                name="status"
                checked
            >
        </div>
        ' : '
        <div class="form-switch">
        <input
                class="form-check-input blocked-toggle"
                type="checkbox"
                data-email="' . $users->email . '"
                id="' . $users->id . '"
                name="status"
                >
                </div>
                ';
        })->addColumn('name', function ($users) {
            return $users->firstname . ' ' . $users->lastname;
        })->rawColumns(['blocked'])
            ->make(true);
    }

    public function employeesData()
    {
        $services = new AdminServices();
        $query = $services->getEmployeesService();
        $adminObj = Auth::guard('admin')->user();
        return DataTables::of($query)->editColumn('created_at', function ($e) {
            return $e->created_at->format('Y-m-d H:i');
        })->addColumn('name', function ($employee) {
            return $employee->firstname . ' ' . $employee->lastname;
        })->addColumn('status', function ($employee) {
            return $employee->status ? '
           <div class="form-switch">
            <input
                class="form-check-input blocked-toggle"
                type="checkbox"
                data-email="' . $employee->email . '"
                id="' . $employee->id . '"
                name="status"
                checked
            >
        </div>
        ' : '
         <div class="form-switch">
            <input
                class="form-check-input blocked-toggle"
                type="checkbox"
                data-email="' . $employee->email . '"
                id="' . $employee->id . '"
                name="status"
            >
        </div>';
        })->rawColumns(['status'])->make(true);
    }
    public function employeesView()
    {
        $adminObj = Auth::guard('admin')->user();
        return view('admin::admin.employees', compact('adminObj'));
    }
    public function login(AdminRequest $request, AdminServices $adminServices)
    {
        $validated = $request->validated();
        $result = $adminServices->AdminLogin(new AdminLoginDTO($validated));
        if ($result) {
            return redirect()->route("admin.dashboard");
        } else {
            return back()->with("error", "error occurred")->withInput($request->only("email"));
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, auth()->guard('admin')->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect',
            ]);
        }
        $this->service->changePassword($request['email'], $request['current_password'], $request['password']);
        return back()->with("success", "password updated");
    }
    public function updateAdminProfile(UpdateAdminRequest $request)
    {
        $validated = $request->validated();
        $this->service->updateAdminProfile(new AdminUpdateDTO(
            $validated['firstname'],
            $validated['lastname'],
            $validated['avatar'] ?? null,
        ), $validated['email']);
        return back()->with("success", "profile updated");
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
