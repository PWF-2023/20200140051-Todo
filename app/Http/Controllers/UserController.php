<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use App\Models\Todo;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
                ->orderBy('name')
                ->where('id', '!=', '1')
                ->paginate(20)
                // ->simplePaginate(10)
                ->withQueryString();
        } else {
            // $todos = Todo::where('user_id', auth()->user()->id)->get();
            // dd($todos);
            $users = User::where('id', '!=', '1')
                ->orderBy('name')
                ->paginate(10);
                // ->simplePaginate(10);
        }
        return view('user.index', compact('users'));
    }
    public function makeadmin(User $user)
    {
        $user->timestamps = false;
        $user->is_admin = true;
        $user->save();
        return back()->with('success', $user->name . ' - Make admin successfully!');
    }

    public function removeadmin(User $user)
    {
        if ($user->id !=1) {
            $user->timestamps = false;
            $user->is_admin = false;
            $user->save();
            return back()->with('success', $user->name . ' - Remove admin successfully!');
        } else {
            return redirect()->route('user.index');
        }
    }
    public function destroy(User $user)
    {
        if ($user->id !=1) {
            $user->delete();
            return back()->with('success', $user->name . ' - Delete user successfully!');
        } else {
            return redirect()->route('user.index')->with('danger', 'Delete user failed!');
        }
    }
}
