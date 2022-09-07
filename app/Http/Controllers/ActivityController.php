<?php

namespace App\Http\Controllers;

use App\Models\User;
use Haruncpi\LaravelUserActivity\Models\Log;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $staff_id = $request->staff_id;
        $sort_search = $request->search;
        $users = User::where("user_type","staff");
        $logs = Log::orderBy("log_date","desc");
        if ($request->staff_id != null || $request->search != null){
            $logs = $logs->where("user_id",$request->staff_id)->orWhere('log_date',"like","%".$request->search."%");
        }
        $users = $users->get();
        $logs = $logs->whereNotIn("log_type",["login"])->paginate(12);
        return view('activity_log.index',compact("logs","users",'staff_id',"sort_search"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $log = Log::find($request->id);
        return view('activity_log.activity_modal',compact("log"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
