<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('is_approved', false);

        if ($request->filled('role')) {
            $query->whereHas('role', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $pendingUsers = $query->with('role')->paginate(15);
        return view('users.approval', compact('pendingUsers'));
    }

    public function approve(User $user)
    {
        $user->is_approved = true;
        $user->save();
        return back()->with('success', 'User approved');
    }

    public function disapprove(User $user)
    {
        $user->delete();
        return back()->with('success', 'User disapproved and removed');
    }
}