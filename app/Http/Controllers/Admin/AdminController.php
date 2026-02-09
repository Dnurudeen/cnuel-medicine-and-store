<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(15);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'is_super_admin' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_super_admin'] = $request->boolean('is_super_admin');

        Admin::create($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user created successfully.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'is_super_admin' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_super_admin'] = $request->boolean('is_super_admin');

        $admin->update($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        // Prevent deleting yourself
        if ($admin->id === Auth::guard('admin')->id()) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Prevent deleting the last super admin
        if ($admin->is_super_admin && Admin::where('is_super_admin', true)->count() <= 1) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'Cannot delete the last super admin.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin user deleted successfully.');
    }
}
