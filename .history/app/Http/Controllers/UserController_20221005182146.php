<?php
  
namespace App\Http\Controllers;
   
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserServiceInterface;
  
class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllPaginatedUsers();
    
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    public function create()
    {
        $roles = Role::all(['id', 'name']);
        return view('users.create', compact('roles'));
    }
    
    public function store(RegisterRequest $request)
    {
        $this->userService->createUser($request);
     
        return redirect()->route('users.index')
            ->with('success','User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    } 

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $user->update($request->all());
    
        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}