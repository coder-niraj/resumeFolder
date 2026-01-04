<?php
namespace Modules\Admin\Controllers;
use Illuminate\Http\Request;
use Modules\Admin\DTOs\AdminLoginDTO;
use App\Http\Controllers\Controller;
use Modules\Admin\Services\AdminServices;

class AdminController extends Controller{
    public function index($request=null){
        return view("admin::auth.login");
    }
    public function login(AdminRequest $request,AdminServices $adminServices){
    $validated = $request->validated();
    $result = $adminServices->AdminLogin(new AdminLoginDTO($validated));
    if($result){
        return redirect()->route("admin.dashboard");
    }else{
        return back()->with("error","error occurred")->withInput($request->only("email"));
    }
    }
    public function profile(Request $request){
    }
}