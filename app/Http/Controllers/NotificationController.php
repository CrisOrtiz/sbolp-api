<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource according user id in request.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserNotifications(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->where('content', 'LIKE', "%{$request->search}%");
            })
            ->with('user')
            ->orderBy($request->orderBy, $request->direction)
            ->paginate((int)$request->pageSize);

        return response()->json(compact(['notifications']), 200);
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
        $user = User::findOrFail($request->user_id);

        $notification = new Notification();
        $notification->content = $request->content;
        $notification->user_id = $request->user_id;
        $notification->clinic_case_id = $request->clinic_case_id;
        $notification->save();

        $user->hasUnreadNotifications = true;
        $user->save();

        return response()->json(compact(['notification']), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function delete($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        $message = "Notificación eliminada.";

        return response()->json(compact('message'), 200);
    }
}
