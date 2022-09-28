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
        $participants_id = array(
            'participant1_id',
            'participant2_id',
            'participant3_id',
            'participant4_id',
            'participant5_id',
            'participant6_id',
        );

        $user_1 = User::where('id', '=', $activity->participant1_id)->first();
        $user_2 = User::where('id', '=', $activity->participant2_id)->first();
        $user_3 = User::where('id', '=', $activity->participant3_id)->first();
        $user_4 = User::where('id', '=', $activity->participant4_id)->first();
        $user_5 = User::where('id', '=', $activity->participant5_id)->first();
        $user_6 = User::where('id', '=', $activity->participant6_id)->first();
        $data = array();
        $labels = array();
        if ($user_1 != null){
            $labels[] = $user_1->name;
            $data[] = [$user_1->from, $user_1->until];
        }
        if ($user_2 != null){
            $labels[] = $user_2->name;
            $data[] = [$user_2->from, $user_2->until];
        }
        if ($user_3 != null){
            $labels[] = $user_3->name;
            $data[] = [$user_3->from, $user_3->until];
        }
        if ($user_4 != null){
            $labels[] = $user_4->name;
            $data[] = [$user_4->from, $user_4->until];
        }
        if ($user_5 != null){
            $labels[] = $user_5->name;
            $data[] = [$user_5->from, $user_5->until];
        }
        if ($user_6 != null){
            $labels[] = $user_6->name;
            $data[] = [$user_6->from, $user_6->until];
        }


        return view('activity', ['activity' => $activity, 'admin_user' => $admin_user, 'user' => $user, 'activity_users' => $activity_user, 'participants'=> $participants, 'labels' => $labels, 'data' => $data]);
    }

    public function manage_account(){
        return view('manage-account');
    }


}
