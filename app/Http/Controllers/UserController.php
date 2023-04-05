<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Storage;
use App\Models\User;
use App\Models\Role;
use App\Models\Store;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            // $users = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->users : User::all();
            $users = User::all();
            return view('users.index', compact('users'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $stores =  Store::all();
            $roles =  Role::all();
            return view('users.create', compact('stores', 'roles'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        try {
            // $request->validate(
            //     [
            //         'image' => 'required|max:10240|mimes:doc,pdf,docx,jpeg,jpg,png',
            //     ],
            //     // custom messages
            //     [
            //         'image.required' => __('Image file is required'),
            //     ]
            // );
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'store_id' => $request->store_id,
                'company_id' => Auth::User()?->company?->id,
                'email_verified_at' => now(),
            ]);
            $user->save();

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        try {
            $user = User::find($id);
            return view('users.show', compact('user'));
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        try {
            $user = User::find($id);
            if ($user) {
                $stores =  Store::all();
                $roles =  Role::all();
                return view('users.edit', compact('user', 'stores', 'roles'));
            }
            return redirect()->route('users.index')
                ->with('error', 'User can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        //
        try {
            $user = User::find($request->user_id);
            if ($user) {
                $user->name = $request->input('name') ? $request->input('name') : '';
                $user->email = $request->input('email') ? $request->input('email') : '';
                if ($request->input('password')) $user->password = $request->input('password');
                $user->role_id = $request->input('role_id') ? $request->input('role_id') : null;
                $user->store_id = $request->input('store_id') ? $request->input('store_id') : null;
                $user->save();
            }
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'done' => true,
                    'message' => 'User deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'User not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getUsers()
    {
        //
        try {

            $data = [];
            $users = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->users : User::all();

            return response()->json(['users' => $users]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
