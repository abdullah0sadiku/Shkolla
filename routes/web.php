<?php

use App\Models\User;
use App\Models\Grade;
use App\Models\Klasat;
use App\Models\ActiveSession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\KlasaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FinancController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\KerkesatController;
use App\Http\Controllers\KlasaMngController;

Route::get('/', function () {
    return view('shkolla');
});

Route::get('/Steps' , function(){
    return view('steps');
});

Route::get('/Klasa-test' , function(){
    $klasa = Klasat::find(1); 
    $users = User::role('Studenti')->get();
    $sesioni = ActiveSession::where('class_id' , 1)->value('is_active');
    $notat = Grade::with('student')->where('class_id', $klasa->id)->get();
 
    if (!$klasa) {
        return redirect()->back()->with('error', 'Class not found.');
    }

    return view('klasaTest', compact('klasa', 'users','notat', 'sesioni'));
});


Route::post('/Kerkesat-store', [KerkesatController::class, 'store'])->name('kerkesat.store');

Route::get('/tabela' , function(){
    $users = User::all();
    $data = Klasat::all();
    return view('pdf.klasat_pdf', compact('users', 'data'));
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/admin/dashboard', function () {

            return view('admin.dashboard');
        })->name("admin.dashboard");

    });

    Route::get('/dashboard', function () {
        if (Auth::user()->getRoleNames()->first() == "Admin") {
            return redirect()->route('admin.dashboard');
        }
        $data = Klasat::all();
        $users = User::all();
        return view('dashboard', compact('data','users'));
    
    })->name('dashboard');
    
    //Rutat per menagjimin e studentve dhe mesuesve
    Route::middleware(['role:Drejtor'])->group(function () {
        Route::get('/mng-users', [UserController::class , 'index'])->name('mng-users');

        Route::get('/mng-users/show/{id}', [UserController::class, 'show'])->name('mng-users.show');

        Route::delete('/mng-users/{id}', [UserController::class, 'destroy'])->name('mng-users.destroy');
        
        Route::get('/mng-users/edit/{id}', [UserController::class, 'edit'])->name('mng-users.edit');
        Route::put('/mng-users/update/{id}', [UserController::class, 'update'])->name('mng-users.update');
        Route::get('/mng-users/create', [UserController::class, 'create'])->name('mng-users.create');
        Route::post('/mng-users', [UserController::class, 'store'])->name('mng-users.store');
    
        Route::get('/mng-klasa', [KlasaMngController::class, 'index'])->name('mng-klasa');
        Route::get('mng-klasa/krijo', [KlasaMngController::class, 'create'])->name('klasat.create');
        Route::get('/mng-klasa/edit/{id}', [KlasaMngController::class, 'edit'])->name('klasat.edit');
        Route::put('/mng-klasa/update/{id}', [KlasaMngController::class, 'update'])->name('klasat.update');
        Route::post('mng-klasa/krijo', [KlasaMngController::class, 'store'])->name('klasat.store');
        Route::delete('mng-klasa/{id}', [KlasaMngController::class, 'destroy'])->name('klasat.destroy');

        Route::get('/klasa/{id}', [KlasaMngController::class, 'show'])->name('klasat.show');

        Route::get('/Kerkesat', [KerkesatController::class, 'index'])->name('kerkesat');
        Route::post('/kerkesat/bulk-confirm', [KerkesatController::class, 'bulkConfirm'])->name('kerkesat.bulkConfirm');
        Route::post('/kerkesat/bulk-delete', [KerkesatController::class, 'bulkDelete'])->name('kerkesat.bulkDelete');


        Route::get('/export/excel', [UserController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [UserController::class, 'exportPDF'])->name('export.pdf');
        Route::get('/export-class/pdf', [KlasaMngController::class, 'exportPDF'])->name('export-class.pdf');

        Route::get('/Meetings', [MeetingController::class , 'meetings'])->name('Meetings');
        
        Route::get('/Statistika' , [StatController::class, 'index'])->name('stat');


        Route::get('/Financat', [FinancController::class, 'index'])->name('mng-paga');
    });
        //  Rrjeti social
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/destroy/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
        Route::get('/media/{id}/edit', [MediaController::class, 'edit'])->name('media.edit');
        Route::put('/media/{id}', [MediaController::class, 'update'])->name('media.update');
        
        //  Klasat 
        Route::get('/Klasa/{id}',[KlasaController::class, 'index'])->name('klasa.index');
        Route::get('/Klasa/{id}',[KlasaController::class, 'show'])->name('klasa.show');
        
        Route::delete('/Klasa/student/{id}', [KlasaController::class, 'removeStudentFromClass'])->name('klasa.fshij');
        Route::post('/Klasa/student/{id}', [KlasaController::class, 'addStudentToClass'])->name('klasa.shto');
        Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
       
        // Meetings Takimet
        Route::get('/Klasa/{classId}/meeting', [MeetingController::class, 'meeting'])->name('meeting');
        Route::post('/klasa/{userId}/{classId}/start', [MeetingController::class, 'meeting_check'])->name('meeting-check');
        Route::post('/meeting/{meetingId}/{classId}/join', [MeetingController::class, 'joinMeeting'])->name('join-meeting');

        Route::post('/meeting/{meetingId}/leave', [MeetingController::class, 'leaveMeeting'])->name('meeting.leave');

        Route::post('/klasa/{classId}' , [MeetingController::class , 'end_meeting'])->name('end_meeting');
});

