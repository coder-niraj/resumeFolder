<?php
namespace Modules\Auth\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Auth\Controllers\Requests\UserLoginRequest;
use Modules\Auth\Controllers\Requests\UserRegisterRequest;
use Modules\Auth\DTOs\User\UserLoginDTO;
use Modules\Auth\DTOs\User\UserRegisterDTO;
use Modules\Auth\Services\UserServices;

class AuthController extends Controller{
    public function __construct(
        private readonly UserServices $service
    ) {}
    public function loginView(){
        return view('auth::auth.login');
    }
    public function registerView(){
        return view('auth::auth.register');
    }
    public function register(UserRegisterRequest $request){
        $validated = $request->validated();
        $this->service->registerService(new UserRegisterDTO(
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
    public function login(UserLoginRequest $request){
        $validated = $request->validated();
        $result = $this->service->loginService(new UserLoginDTO(
            $validated['email'], 
            $validated['password'],
        ));
        if($result){
            
            return redirect()->route("user.dashboard");
        }else{
            return back()->with("error","error occurred")->withInput($request->only("email"));
        }
    }
    public function logout(){
    }
}