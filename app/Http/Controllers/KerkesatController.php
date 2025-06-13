<?php

namespace App\Http\Controllers;

use App\Mail\Confirmed;
use App\Mail\NewKerkes;
use App\Models\Kerkesat;
use Illuminate\Http\Request;
use App\Mail\KerkesatSubmitted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class KerkesatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kerkesat = Kerkesat::all();

        return view('kerkesat', compact('kerkesat'));
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
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'agreement' => 'accepted', // Ensures checkbox is checked
        ]);
    
        // Save the request data to the database
        Kerkesat::create($request->all());
    
        // Prepare data for the email
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
    
        // Send the email to the user
        Mail::to($request->email)->send(new KerkesatSubmitted($details));
        Mail::to('avdullahsadiku@gmail.com')->send(new NewKerkes($details));
    
        // Return a response or redirect
        return redirect()->back()->with('success', 'Kerkesa e juaj eshte derguar me sukses!!');
    }

     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    public function bulkConfirm(Request $request)
    {
        $ids = explode(',', $request->input('selected_ids', ''));
        Kerkesat::whereIn('id', $ids)->update(['status' => 'done']);

        $kerkesat = Kerkesat::whereIn('id', $ids)->get();

        foreach ($kerkesat as $kerkesa) {
            // Update the status to 'done'
            $kerkesa->status = 'done';
            $kerkesa->save();

            // Prepare email details
            $details = [
                'name' => $kerkesa->name,
                'email' => $kerkesa->email,
                'phone' => $kerkesa->phone,
            ];

            // Send confirmation email
            Mail::to($kerkesa->email)->send(new Confirmed($details));
        }

        return redirect()->back()->with('success', 'Selected requests confirmed successfully!');
    }
    
    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->input('selected_ids', ''));
        Kerkesat::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Selected requests deleted successfully!');
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
    }

}
