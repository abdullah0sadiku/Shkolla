<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Klasat;
use Illuminate\Http\Request;
use App\Models\ActiveSession;
use App\Models\MeetingParticipant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
   
   

    public function meeting($classId){
            $klasa = Klasat::find($classId);
            $meetingId = ActiveSession::where('class_id' , $classId)->value('id');

            $active_users = MeetingParticipant::where('meeting_id', $meetingId)->pluck('user_id');
            $processed_users = User::whereIn('id', $active_users)->pluck('name','id');
          
            return view('meeting',compact('klasa','processed_users'));
    }
    
    // public function getActiveParticipants($meetingId)
    // {
    //     $activeParticipants = MeetingParticipant::with('user')
    //                           ->where('meeting_id', $meetingId)
    //                           ->where('is_active', true)
    //                           ->get();

    //     return response()->json($activeParticipants);
    // }
    
    public function meeting_check($userId, $classId)
    {
        // Fetch the class
        $klasa = Klasat::with('students')->find($classId);

        if ($klasa && $klasa->teacher_id == $userId) {
            // Create or update an active session
            $meeting = ActiveSession::updateOrCreate(
                ['class_id' => $classId, 'teacher_id' => $userId],
                ['started_at' => now(), 'is_active' => true]
            );

            // Mark the teacher as active in the meeting
            MeetingParticipant::updateOrCreate(
                ['meeting_id' => $meeting->id, 'user_id' => $userId],
                ['is_active' => true]
            );

            $meetingId = ActiveSession::where('class_id' , $classId)->value('id');
            $active_users = MeetingParticipant::where('meeting_id', $meetingId)->pluck('user_id');
            $processed_users = User::whereIn('id', $active_users)->pluck('name','id');
        
            return view('meeting', ['klasa' => $klasa, 'meeting' => $meeting , 'processed_users' =>$processed_users]);
        }

        return redirect()->route('klasa.show', ['id' => $classId])->with('error', 'Ju nuk jeni pjesë e kësaj klase.');
    }

    public function joinMeeting(Request $request, $meetingId , $classId)
    {
        $userId = auth()->id(); // ID e përdoruesit të kyçur
     
        // Kontrollo nëse përdoruesi është tashmë pjesë e takimit
        $exists = MeetingParticipant::where('meeting_id', $meetingId)
                                    ->where('user_id', $userId)
                                    ->exists();
        
        if (!$exists) {
            // Shto hyrjen në tabelë
            MeetingParticipant::create([
                'meeting_id' => $meetingId,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('meeting', ['id' => $meetingId , 'classId' => $classId])
                         ->with('success', 'U kyçët me sukses në takim.');
    }

    public function leaveMeeting($meetingId)
    {
        $userId = Auth::id();

        // Fshini regjistrimin e pjesëmarrësit nga takimi nëse ata e kanë lënë
        MeetingParticipant::where('meeting_id', $meetingId)
            ->where('user_id', $userId)
            ->forcedelete();

        
        $classId = ActiveSession::where('id', $meetingId)->value('class_id');
        
        // Redirektoni pas përfundimit të operacionit
        return redirect()->route('klasa.show', ['id' => 1])->with('success', 'Pjesëmarrësi ka lënë takimin me sukses.');
    }

    public function end_meeting($classId)
    {
        ActiveSession::where('class_id', $classId)->update(['is_active' => false]);
    
        $meetingId = ActiveSession::where('class_id', $classId)->first()->meeting_id;
        MeetingParticipant::where('meeting_id', $meetingId)->delete();
    
        return redirect()->route('klasa.show', ['id' => $classId])->with('success', 'Takimi është përfunduar dhe pjesëmarrësit janë fshirë.');
    }
    
    
    public function meetings(){
        $sessions = ActiveSession::with('class', 'teacher')->where('is_active', true)->get();
        $offline_sessions = ActiveSession::with('class', 'teacher')->where('is_active', false)->get();
         
        return view( 'Meetings', ['sessions' => $sessions , 'offline_sessions' => $offline_sessions] );  
    }
}
