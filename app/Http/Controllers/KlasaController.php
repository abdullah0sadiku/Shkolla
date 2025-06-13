<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Grade;
use App\Models\Klasat;
use Illuminate\Http\Request;
use App\Models\ActiveSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KlasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klasa = Klasat::all();

        return view('klasa', compact('klasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $klasa = Klasat::find($id); // This should return a single instance or null
        $users = User::role('Studenti')->get();
        $sesioni = ActiveSession::where('class_id' , $id)->value('is_active');
        $meeting = ActiveSession::where('class_id' , $id)->first();
        $notat = Grade::with('student')->where('class_id', $klasa->id)->get();
        
        if (!$klasa) {
            return redirect()->back()->with('error', 'Class not found.');
        }

        return view('klasa', compact('klasa', 'users', 'notat' , 'sesioni' , 'meeting'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addStudentToClass(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:klasat,id',
        ]);

        // Find the student by student_id from the request
        $student = User::find($request->input('student_id'));

        // Check if student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Update the student's class_id
        $student->class_id = $request->input('class_id');
        $student->save();

        // Redirect to the specific class page with a success message
        return redirect()->route('klasa.show', ['id' => $id])->with('success', 'Student added to class successfully.');
    }


    public function removeStudentFromClass(string $id)
    {   
        $Student = User::find($id);
        
        if (!$Student) {
            return redirect()->back()->with('error', 'Klasa not found.');
        }

        $Student->class_id = null;
        $Student->save();

        // Redirect back with success message
        return redirect()->route('klasa.show', ['id' => $id])->with('success', 'Class deleted successfully.');
    }

   
}
