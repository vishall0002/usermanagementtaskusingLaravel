<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->trashed == 1, function ($query) {
                return $query->onlyTrashed();
            }, function ($query) {
                return $query->withoutTrashed();
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('mobile', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(3);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.partials.table_rows', compact('users'))->render(),
                'pagination' => $users->links()->toHtml()
            ]);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.modal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated() + [
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => 'User created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.modal', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $data = $request->validated();
        if (!$request->password) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json(['success' => 'User updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return response()->json(['success' => 'User restored successfully.']);
    }
}
