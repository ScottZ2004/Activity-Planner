<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function my_activities(){
        return view('dashboard');
    }

    public function manage_activties(){
        return view('manage-activities');
    }

    public function new_activity(){
        return view('new-activity');
    }

    public function create_activity(Request $request){
        $data= $request->validate([
            'name' => 'required|min:3',
            'date' => 'required|after:yesterday',
            'description' => ''
        ]);

        $user_id = Auth::id();

        $activity = new Activities();
        $activity->name =  $data['name'];
        $activity->date =  $data['date'];
        $activity->description =  $data['description'];
        $activity->admin_id = $user_id;

        $activity->save();

        return redirect()->route('activity', $activity->id);
    }

    public function activity($slug){
        $user = Auth::user();
        $participants = User::all();
        $activity = Activities::where('id', '=', $slug)->first();
        $admin_user = User::where('id', '=', $activity->admin_id)->first();
        $activity_user = array(
            'user_1' => $activity->participant1_id,
            'user_2' => $activity->participant2_id,
            'user_3' => $activity->participant3_id,
            'user_4' => $activity->participant4_id,
            'user_5' => $activity->participant5_id,
            'user_6' => $activity->participant6_id

        );
        return view('activity', ['activity' => $activity, 'admin_user' => $admin_user, 'user' => $user, 'activity_users' => $activity_user, 'participants'=> $participants]);
    }

    public function manage_account(){
        return view('manage-account');
    }


}
