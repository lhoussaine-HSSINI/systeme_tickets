<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreComment $request)
    {
        //
        $data=$request->only('comment_content');
        $data['ticket_id']=$request->id_ticket;
        $data['user_id']=Auth::user()->id;
//        dd($data);
        $comment=Comment::create($data);
        $ticket=Ticket::find($data['ticket_id']);
        $data_notification['type']='Comment';
        $data_notification['type_id']=$data['ticket_id'];
        if(Auth::user()->id==1){
            $data_notification['data']="Admin created a new comment";
            $data_notification['user_id']=1;
            $data_notification['user_to_notify_id']=$ticket->user_id;
        }else{
            $data_notification['data']=Auth::user()->name." created a new comment";
            $data_notification['user_id']=Auth::user()->id;
            $data_notification['user_to_notify_id']=1;
        }

        $noti=Notification::create($data_notification);
        return redirect()->route('tickets.show',['ticket'=> $data['ticket_id']]);
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
    public function destroy($id)
    {
        //
    }
}
