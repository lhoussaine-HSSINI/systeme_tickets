<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTicket;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public $table_status = array("Nouveau", "Pas encore répondu","Répondu","Pas encore résolu","Résolu","Fermé");
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(\App\Models\Ticket::orderBy('created_at', 'DESC')->get());
//        dd(\App\Models\Ticket::all()) 'tickets'=>Ticket::all();
        session(['login' => 1]);
        return view('tickets.index',
            ['tickets'=>Ticket::orderBy('created_at', 'DESC')->get(), 'table_status'=> $this->table_status,
                'notification'=>Notification::where([['user_to_notify_id',Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tickets.create',
            ['notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
//        $post=new Ticket();
//        $post->user_id=Auth::user()->id;
//        $post->ticket_status = $request->input('category');
//        $post->ticket_question = $request->input('question');
//        $post->save();
        $data=$request->only(['ticket_choix','ticket_title','ticket_question']);
        $data['user_id']=Auth::user()->id;
        $post=Ticket::create($data);
        $data_notification['type']='Ticket';
        $data_notification['type_id']=$post->id;
        $data_notification['data']=Auth::user()->name." created a new ticket";
        $data_notification['user_id']=Auth::user()->id;
        $data_notification['user_to_notify_id']=1;
        $noti=Notification::create($data_notification);
        $request->session()->flash('success', 'l3amalya  najha rah dkhlo hado nbas de donne');
        return redirect()->route('home');
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
        $id_user_create_comment=Ticket::find($id)->user_id;
//        dd(\App\Models\User::find($idid));
//        dd(\App\Models\Comment::all(), \App\Models\Comment::where('ticket_id', $id)->get());
        return view('tickets.show',
            [ 'ticket'=>Ticket::find($id),'comment_user'=>User::find($id_user_create_comment) ,
                'comment'=>Comment::where('ticket_id', $id)->orderBy('created_at', 'DESC')->get(),
                'table_status'=> $this->table_status[Ticket::find($id)->ticket_status],
                'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
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
