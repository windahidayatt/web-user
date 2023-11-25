<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "Team",
            "sub_page_name" => "",
            "list_users" => User::where(['is_deleted' => 0])->whereHas('role', function ($query) {
                return $query->where('name', '=', "Participant");
            })->get(),
            "list_teams" => Team::where(['is_deleted' => 0])->get()
        ];

        return view('pages/team/index', $data);
    }

    public function index_user()
    {
        $data = [
            "page_name" => "Team",
            "sub_page_name" => "",
            "list_users" => User::where(['is_deleted' => 0])->whereHas('role', function ($query) {
                return $query->where('name', '=', "Participant");
            })->get(),
            "list_teams" => Team::where(['is_deleted' => 0])->whereHas('user_teams', function ($query) {
                return $query->where('user_id', '=', Auth::user()->id);
            })->get()
        ];

        return view('pages/team/index_user', $data);
    }

    
    public function show($id)
    {
        $data = [
            "team" => Team::find($id),
            "list_users" => User::where(['is_deleted' => 0])->whereHas('role', function ($query) {
                return $query->where('name', '=', "Participant");
            })->get(),
            "list_selected_users" => UserTeam::where('team_id', $id)->pluck('user_id')->toArray(),
        ];

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $new_id = (string) Str::uuid();
        $team_obj = [
            "id" => $new_id,
            "name" => $request->name,
            "established_date" => Carbon::now()
        ];

        $new_team = Team::create($team_obj);

        if($request->selected_users){
            foreach($request->selected_users as $user_id){
                UserTeam::create(['team_id' => $new_id, 'user_id' => $user_id]);
            }
        }

        if($new_team->exists){
            return response()->json(['message' => 'success']);
        }
    }

    
    public function update(Request $request)
    {
        $team_obj = [
            "name" => $request->name
        ];
        
        $updated_team = Team::find($request->id)->update($team_obj);

        //teachers
        $get_current_users = UserTeam::where('team_id', $request->id)->pluck('user_id')->toArray();
        if($request->selected_users){
            foreach($request->selected_users as $user_id){
                if(!in_array($user_id, $get_current_users)){
                    UserTeam::create(['team_id' => $request->id, 'user_id' => $user_id]);
                }
            }
        }

        $diff_users = array_diff($get_current_users, $request->selected_users);
        foreach($diff_users as $unselected_user_id){
            UserTeam::where(['team_id' => $request->id, 'user_id' => $unselected_user_id])->delete();
        }

        $team_obj['total_participants'] = count($request->selected_users);

        if($updated_team){
            return response()->json(['message' => 'success', 'data' => $team_obj]);
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_team = Team::find($request->id)->update(['is_deleted' => 0]);

        if($deleted_team){
            return response()->json(['message' => 'success']);
        }
    }
}
