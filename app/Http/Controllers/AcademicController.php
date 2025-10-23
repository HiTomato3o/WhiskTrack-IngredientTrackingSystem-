<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Semester;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    // List all academic sessions with their semesters
    public function index()
    {
        $sessions = AcademicSession::with('semesters')->orderBy('start_date', 'desc')->get();
        return view('settings.academic.index', compact('sessions'));
    }

    // Show form to create a new session
    public function createSession()
    {
        return view('settings.academic.create_session');
    }

    // Store a new academic session
    public function storeSession(Request $request)
    {
        $request->validate([
            'session_name' => 'required|string|max:100|unique:academic_sessions,session_name',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after:start_date',
            'is_current'   => 'boolean',
        ]);
        AcademicSession::create($request->all());
        return redirect()->route('settings.academic.index')->with('success', 'Academic session added!');
    }

    // Show form to edit a session
    public function editSession(AcademicSession $session)
    {
        return view('settings.academic.edit_session', compact('session'));
    }

    // Update an academic session
    public function updateSession(Request $request, AcademicSession $session)
    {
        $request->validate([
            'session_name' => 'required|string|max:100|unique:academic_sessions,session_name,' . $session->id,
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after:start_date',
            'is_current'   => 'boolean',
        ]);
        $session->update($request->all());
        return redirect()->route('settings.academic.index')->with('success', 'Academic session updated!');
    }

    // SEMESTER Management

    // Show form to create a semester for a session
    public function createSemester(AcademicSession $session)
    {
        return view('settings.academic.create_semester', compact('session'));
    }

    // Store a new semester
    public function storeSemester(Request $request, AcademicSession $session)
    {
        $request->validate([
            'semester_name' => 'required|string|max:10',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $session->semesters()->create($request->all());
        return redirect()->route('settings.academic.index')->with('success', 'Semester added!');
    }

    // Show form to edit a semester
    public function editSemester(Semester $semester)
    {
        return view('settings.academic.edit_semester', compact('semester'));
    }

    // Update a semester
    public function updateSemester(Request $request, Semester $semester)
    {
        $request->validate([
            'semester_name' => 'required|string|max:10|unique:semesters,semester_name,' . $semester->id . ',id,academic_session_id,' . $semester->academic_session_id,
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);
        $semester->update($request->all());
        return redirect()->route('settings.academic.index')->with('success', 'Semester updated!');
    }
}