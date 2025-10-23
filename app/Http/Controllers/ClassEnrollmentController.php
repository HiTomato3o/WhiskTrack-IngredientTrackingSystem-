<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;

class ClassEnrollmentController extends Controller
{
    // Enroll a user in a class
    public function enroll(Request $request, ClassModel $class)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        $class->users()->syncWithoutDetaching([$request->user_id]);
        return back()->with('success', 'User enrolled successfully!');
    }

    // Remove a user from a class
    public function remove(Request $request, ClassModel $class)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        $class->users()->detach($request->user_id);
        return back()->with('success', 'User removed from class.');
    }
}