<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Klasat;
use PDF;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class KlasaMngController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();

        $data_klasat = Klasat::all();
        $data_m = User::role('Mesuesi')->get();

        $teachers = User::role('Mesuesi')->get(); // Fetch all users with the role 'Mesuesi'
        $students = User::role('Studenti')->get();
        return view('mng-klasa' , compact('data_klasat' ,'teachers','students','data_m'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::all();

        $data_klasat = Klasat::all();
        $data_m = User::role('Mesuesi')->get();

        $teachers = User::role('Mesuesi')->get(); // Fetch all users with the role 'Mesuesi'
        return view('mng-klasa' , compact('data_klasat','teachers', 'data_m'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
        ]);
    
        // Create a new class
        $class = new Klasat();
        $class->name = $validatedData['name'];
        $class->teacher_id = $validatedData['teacher_id'];
        $class->save();
    
        return redirect()->route('mng-klasa')->with('success', 'Class created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $klasa = Klasat::find($id);
        $teachers = User::role('Mesuesi')->get(); 
        $roles = \Spatie\Permission\Models\Role::all();
        $users= User::all();
        return view('klasa' , compact('klasa', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the user by ID
        $klasa = Klasat::find($id);
        $teachers = User::role('Mesuesi')->get(); // Fetch all users with the role 'Mesuesi'
        $roles = \Spatie\Permission\Models\Role::all();

        if (!$klasa) {
            return redirect()->back()->with('error', 'Klasa not found.');
        }

        // Return the edit view with user data
        return view('edit_klasa', compact('klasa','teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
        ]);

        // Find the class by ID
        $class = Klasat::find($id);

        // Check if the class exists
        if (!$class) {
            return redirect()->back()->with('error', 'Class not found.');
        }

        // Update class properties with validated data
        $class->name = $validatedData['name'];
        $class->teacher_id = $validatedData['teacher_id'];
        $class->save();

        // Redirect back to class management page with success message
        return redirect()->route('mng-klasa')->with('success', 'Class modified successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $klasa = Klasat::find($id);

        if (!$klasa) {
            return redirect()->back()->with('error', 'Klasa not found.');
        }

        // Delete the user
        $klasa->delete();

        // Redirect back with success message
        return redirect()->route('mng-klasa')->with('success', 'Class deleted successfully.');
    }

    public function exportPDF()
    {
        $data = Klasat::all();
        $users = User::all();
        
        $pdf = PDF::loadView('pdf.klasat_pdf', compact('data' , 'users'));
        return $pdf->download('klasat.pdf');
    }

}
