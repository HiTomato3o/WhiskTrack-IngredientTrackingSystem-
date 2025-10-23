<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['semester', 'creator'])->paginate(20);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $semesters = Semester::all();
        return view('classes.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10|unique:classes,name',
            'password' => 'required|string|min:6',
            'semester_id' => 'required|exists:semesters,id',
        ]);
        $class = ClassModel::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'semester_id' => $request->semester_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        // Optionally enroll creator as is_creator
        $class->enrolledUsers()->attach(Auth::id(), ['is_creator' => true]);
        return redirect()->route('classes.index')->with('success', 'Class created!');
    }

    public function edit(ClassModel $class)
    {
        $semesters = Semester::all();
        return view('classes.edit', compact('class', 'semesters'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'name' => 'required|max:10|unique:classes,name,' . $class->id,
            'password' => 'nullable|string|min:6',
            'semester_id' => 'required|exists:semesters,id',
        ]);
        $data = [
            'name' => $request->name,
            'semester_id' => $request->semester_id,
            'updated_by' => Auth::id(),
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $class->update($data);
        return redirect()->route('classes.index')->with('success', 'Class updated!');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted!');
    }
}