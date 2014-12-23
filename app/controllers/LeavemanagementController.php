<?php

class LeavemanagementController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /leavemanagement
     *
     * @return Response
     */
    public function index()
    {

        if (Auth::check() && Auth::user()->is_admin) {
//            $userLeaves = Leave::whereHas('status', function($q) {
//                        $q->where('status', '=', Leave::$applied);
//                    })->get();
//            $leaves = count($userLeaves) ? $userLeaves[0]->leaves : null;

            $leaves = Leave::where('status', '=', Leave::$applied)->get();
            return View::make('leavemanagements.pending', array('leaves' => $leaves));
        } else {

            //404 page
            return Redirect::route('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /leavemanagement/approve/{leave}
     *
     * @return Response
     */
    public function approve(Leave $leave)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            //$leaves = Leave::where('status', '=', Leave::$applied)->get();
            $leave = Leave::find($leave->id);
            $leave->status = Leave::$approved;
            $leave->save();
            Session::flash('message', 'Leave Approved successfully..');
            return Redirect::route('admin_leave_pening'); 
        } else {

            //404 page
            return Redirect::route('/');
        }
    }

    /**
     * Display the specified resource.
     * GET /leavemanagement/reject/{leave}
     *
     * @param  int  $leave
     * @return Response
     */
    public function reject($leave)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            //$leaves = Leave::where('status', '=', Leave::$applied)->get();
            $leave = Leave::find($leave->id);
            $leave->status = Leave::$rejected;
            $leave->save();
            Session::flash('message', 'Leave Rejected successfully..');
            //return View::make('leavemanagements.pending', array('leaves' => $leaves));
            return Redirect::route('admin_leave_pening'); 
        } else {

            //404 page
            return Redirect::route('/');
        }
    }

}
