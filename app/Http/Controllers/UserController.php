<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string',
            'password'  => 'required'
        ]);

        $user = User::firstOrCreate([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        $user->assignRole('parent');

        return redirect()->route('adminDashboard')
                         ->with('success', 'Berhasil Membuat Akun Parent');
    }

    public function destroy(User $user)
    {
        // Security Check
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak boleh menghapus akun Anda sendiri.');
        }

        if ($user->hasRole('admin')) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun Administrator.');
        }        

        try {
            $name = $user->name;
            $user->delete();

            return redirect()->back()
                            ->with('success', "Parent '{$name}' berhasil dihapus.");

        } catch (\Exception $e) {
            \Log::error('Delete User Error: ' . $e->getMessage());
            
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat menghapus parent.');
        }
    }
}
