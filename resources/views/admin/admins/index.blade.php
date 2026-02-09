@extends('layouts.admin')

@section('title', 'Admin Users')
@section('header', 'Admin Users')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">Manage admin users</p>
        <a href="{{ route('admin.admins.create') }}"
            class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
            <i class="fas fa-plus mr-2"></i> Add Admin
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($admins as $admin)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $admin->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $admin->email }}</td>
                        <td class="px-6 py-4">
                            @if ($admin->is_super_admin)
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Super
                                    Admin</span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Admin</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $admin->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.admins.edit', $admin) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($admin->id !== auth()->guard('admin')->id())
                                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">
            {{ $admins->links() }}
        </div>
    </div>
@endsection
