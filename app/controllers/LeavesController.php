<?php

class LeavesController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /leave
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /leave/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /leave
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::only(['start', 'end']);

        $validator = Validator::make(
                        $data, [
                    'start' => 'required|date_format:"d-m-Y"',
                    'end' => 'required||date_format:"d-m-Y"',
                        ]
        );

        if ($validator->fails()) {
            return Redirect::route('leave.create')->withErrors($validator)->withInput();
        }

        if (Auth::check()) {
            $id = Auth::user()->id;
            $data['user_id'] = $id;
            $data['status'] = Leave::$applied;
            $data['start'] = date("Y-m-d", strtotime($data['start']));
            $data['end'] = date("Y-m-d", strtotime($data['end']));
        }
        $newLeave = Leave::create($data);
        if ($newLeave) {
            return Redirect::route('leave_status', array('leave'=>$newLeave->id));
        }

        return Redirect::route('leave.create')->withInput();
    }

    /**
     * Display the specified resource.
     * GET /leave/{leave}
     *
     * @param  int  $leave
     * @return Response
     */
    public function status($leave)
    {
        return View::make('leaves.status', array('leave' => $leave));
    }

}
