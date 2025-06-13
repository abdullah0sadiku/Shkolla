<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:klasat,id',
            'date' => 'required|date',
            'new_memorization' => 'required|integer|min:0|max:30',
            'revision' => 'required|integer|min:0|max:40',
            'tajweed' => 'required|integer|min:0|max:30',
        ]);

        $total = $request->new_memorization + $request->revision + $request->tajweed;

        Grade::create([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'date' => $request->date,
            'new_memorization' => $request->new_memorization,
            'revision' => $request->revision,
            'tajweed' => $request->tajweed,
            'total' => $total
        ]);

        return redirect()->back()->with('success', 'Grade recorded successfully!');
    }
}
