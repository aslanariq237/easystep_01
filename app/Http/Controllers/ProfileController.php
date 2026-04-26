<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = Auth::user();

        // Statistik Belajar
        $totalModulesAccessed = ProgressActivity::where('user_id', $user->id)
                                    ->distinct('module_id')
                                    ->count('module_id');

        $totalForumPosts = \App\Models\ForumPost::where('user_id', $user->id)->count();
        
        $totalForumComments = \App\Models\ForumComment::where('user_id', $user->id)->count();

        // Module yang paling sering diakses (5 teratas)
        $topModules = ModuleAccessHistory::where('user_id', $user->id)
                        ->with('module')
                        ->selectRaw('module_id, COUNT(*) as access_count')
                        ->groupBy('module_id')
                        ->orderBy('access_count', 'desc')
                        ->limit(5)
                        ->get();

        return view('profile.show', compact(
            'user',
            'totalModulesAccessed',
            'totalForumPosts',
            'totalForumComments',
            'topModules'
        ));
    }    
    // public function edit()
    // {
    //     return view('profile.edit');
    // }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.show')
                         ->with('success', 'Profil berhasil diperbarui!');
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request)
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
