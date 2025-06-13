<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Klasat;
use App\Models\Kerkesat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Count total requests
        $k_count = Kerkesat::count();

        // Group requests by created_at date
        $requestsByDate = Kerkesat::selectRaw("DATE(created_at) as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $requestsByDate->pluck('date')->toArray();
        $requestCounts = $requestsByDate->pluck('total')->toArray();


        $students = User::role('studenti')->selectRaw("DATE(created_at) as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Extract data for the chart
        $s_dates = $students->pluck('date')->toArray();
        $studentCounts = $students->pluck('total')->toArray();

        // Get the total number of students
        $totalStudents = $students->sum('total');

        // -----------------------------------------------------

        $klasat = Klasat::selectRaw("DATE(created_at) as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Extract data for the chart
        $klasa_dates = $klasat->pluck('date')->toArray();
        $classCounts = $klasat->pluck('total')->toArray();

        // Get the total number of classes
        $totalClasses = $klasat->sum('total');


        return view('stat.stat', compact('k_count', 'dates', 'requestCounts', 's_dates', 'studentCounts', 'totalStudents', 'klasa_dates', 'classCounts', 'totalClasses'));
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
    public function show(string $id)
    {
        //
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
}
