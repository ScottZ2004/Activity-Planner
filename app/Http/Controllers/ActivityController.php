<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\User;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function my_activities(){
        $user = Auth::user();
        $activities = Activities::all();
        return view('dashboard', ['user' => $user, 'activities' => $activities]);
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

        $user_1 = User::where('id', '=', $activity->participant1_id)->first();
        $user_2 = User::where('id', '=', $activity->participant2_id)->first();
        $user_3 = User::where('id', '=', $activity->participant3_id)->first();
        $user_4 = User::where('id', '=', $activity->participant4_id)->first();
        $user_5 = User::where('id', '=', $activity->participant5_id)->first();
        $user_6 = User::where('id', '=', $activity->participant6_id)->first();

        $user_1_availability = null;
        $user_2_availability = null;
        $user_3_availability = null;
        $user_4_availability = null;
        $user_5_availability = null;
        $user_6_availability = null;

        $admin_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $admin_user->id]])->first();
        if($user_1 != null){
            $user_1_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_1->id]])->first();
        }
        if($user_2 != null){
            $user_2_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_2->id]])->first();
        }
        if($user_3 != null){
            $user_3_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_3->id]])->first();
        }
        if($user_4 != null){
            $user_4_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_4->id]])->first();
        }
        if($user_5 != null){
            $user_5_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_5->id]])->first();
        }
        if($user_6 != null){
            $user_6_availability = Availability::where([['activity_id', '=', $activity->id], ['user_id', '=', $user_6->id]])->first();
        }

        $data = array();
        $labels = array();

        if ($admin_availability != null){
            $labels[] = $admin_user->name;
            $data[] = [$admin_availability->from, $admin_availability->until];
        }


        if ($user_1 != null && $user_1_availability != null){
            $labels[] = $user_1->name;
            $data[] = [$user_1_availability->from, $user_1_availability->until];
        }
        if ($user_2 != null && $user_2_availability != null){
            $labels[] = $user_2->name;
            $data[] = [$user_2_availability->from, $user_2_availability->until];
        }
        if ($user_3 != null && $user_3_availability != null){
            $labels[] = $user_3->name;
            $data[] = [$user_3_availability->from, $user_3_availability->until];
        }
        if ($user_4 != null && $user_4_availability != null){
            $labels[] = $user_4->name;
            $data[] = [$user_4_availability->from, $user_4_availability->until];
        }
        if ($user_5 != null && $user_5_availability != null){
            $labels[] = $user_5->name;
            $data[] = [$user_5_availability->from, $user_5_availability->until];
        }
        if ($user_6 != null && $user_6_availability != null){
            $labels[] = $user_6->name;
            $data[] = [$user_6_availability->from, $user_6_availability->until];
        }


        return view('activity', ['activity' => $activity, 'admin_user' => $admin_user, 'user' => $user, 'activity_users' => $activity_user, 'participants'=> $participants, 'labels' => $labels, 'data' => $data]);
    }

    public function manage_account(){
        return view('manage-account');
    }

    public function update_availability($slug, Request $request){
        $data = $request->validate([
            'from' => 'required|integer|between:1,24|different:until',
            'until' => 'required|integer|between:1,24|different:from'
        ]);

        $user_id = Auth::id();

        $availabilities = Availability::all();
        foreach ($availabilities as $activity){
            if($activity->user_id == $user_id && $activity->activity_id == $slug){
                $activity->delete();
            }
        }

        $availability = new Availability();
        $availability->from = $data['from'];
        $availability->until = $data['until'];
        $availability->user_id = $user_id;
        $availability->activity_id = $slug;
        $availability->save();
        return redirect()->route('activity', $slug);
    }

    public function add_participants($slug){
        $user = Auth::user();
        $users = User::all();

        return view('add-participant', ['user' => $user, 'users' => $users, 'slug' => $slug]);
    }

    public function update_participants($slug, $participant_id){
        $user = Auth::user();
        $activity = Activities::where('id', '=', $slug)->first();

        if ($activity->admin_id != $user->id){
            return redirect(route('dashboard'));
        }
        else{
            if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant1_id == $participant_id || $activity->participant1_id == null)){
                $activity->participant1_id = $participant_id;
                $activity->save();
                return redirect(route('activity', $slug));
            }
            else if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant2_id == $participant_id || $activity->participant2_id == null)){
                $activity->participant2_id = $participant_id;
                $activity->save();
                return redirect(route('activity', $slug));
            }
            else if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant3_id == $participant_id || $activity->participant3_id == null)){
            $activity->participant3_id = $participant_id;
            $activity->save();
            return redirect(route('activity', $slug));
            }

            else if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant4_id == $participant_id || $activity->participant4_id == null)){
                $activity->participant4_id = $participant_id;
                $activity->save();
                return redirect(route('activity', $slug));
            }
            else if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant5_id == $participant_id || $activity->participant5_id == null)){
                $activity->participant5_id = $participant_id;
                $activity->save();
                return redirect(route('activity', $slug));
            }
            else if(($activity->participant1_id != $participant_id && $activity->participant2_id != $participant_id && $activity->participant3_id != $participant_id && $activity->participant4_id != $participant_id && $activity->participant5_id != $participant_id && $activity->participant6_id != $participant_id) && ($activity->participant6_id == $participant_id || $activity->participant6_id == null)){
                $activity->participant6_id = $participant_id;
                $activity->save();
                return redirect(route('activity', $slug));
            }
            else{
                return redirect(route('add-Participant', $slug));
            }
        }
    }

}
