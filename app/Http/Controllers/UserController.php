<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Klasat;
use App\Models\Mesuesit;
use App\Models\Studentet;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
    

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = \Spatie\Permission\Models\Role::all();

        $data = User::all();
        // // Eshte zgjidhje e perkohshme deri sa ta krijoj nje tabel   
        $data_m = User::role('Mesuesi')->get();
        $data_s = User::role('Studenti')->get();
        
        return view('user' , compact('data' ,'data_m','data_s','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Show the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRole($request->input('role'));

        return redirect()->route('mng-users')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        switch ($id) {
            case "msues":
                $mng = User::role('Mesuesi')->get();
                return view('mng-users', compact('mng' , 'id'));
                break;
            case "student":
                $mng = User::role('Studenti')->get();
                return view('mng-users', compact('mng' , 'id'));
                break;
            default:
                return redirect()->route('mng-users')->with('error', 'Invalid selection.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the user by ID
        $user = User::find($id);
        $roles = \Spatie\Permission\Models\Role::all();
        $classes = Klasat::all(); // Assuming Klasat is the model for classes

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Return the edit view with user data
        return view('edit', compact('user', 'roles', 'classes'));
    }

    public function update(Request $request, string $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id, // Ensure email is unique except for the current user
            'role' => 'required|string|exists:roles,name', // Ensure the role exists
            'class_id' => 'nullable|exists:klasat,id', // Ensure the class ID exists if provided
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->class_id = $request->class_id; // Assign the class ID
        $user->save();

        // Update the user's role using Spatie's package
        $user->syncRoles([$request->role]);

        return redirect()->route('mng-users')->with('success', 'User updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('mng-users')->with('success', 'User deleted successfully.');
    }

    
    // Excel Export
    public function exportExcel()
    {
        $export = new UsersExport();
        return $export->exportUsers();
    }

    // PDF Export
    public function exportPDF(Request $request)
    {
        // Get the selected table type from the query parameter
        $table = $request->query('table');

        // Switch between different PDF views
        switch ($table) {
            case 'mesuesit':
                $data = User::role('Mesuesi')->get();
                $pdf = PDF::loadView('pdf.mesuesit_pdf', compact('data'));
                return $pdf->download('mesuesit.pdf');
            
            case 'studentet':
                $data = User::role('Studenti')->get();
                $pdf = PDF::loadView('pdf.studentet_pdf', compact('data'));
                return $pdf->download('studentet.pdf');
            case 'perdoruesve':
                $data = User::all();
                $pdf = PDF::loadView('pdf.users_pdf', compact('data'));
                return $pdf->download('users.pdf');
            default:
                return back()->with('error', 'Invalid table selection.');
        }
    }
}
 
