<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $table_status = array("Nouveau", "Pas encore répondu","Répondu","Pas encore résolu","Résolu","Fermé");
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        session(['login' => 1]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        dd(Auth::user()->status);
        if (Auth::user()->status){
            return view('Dashboard',
                ['tickets'=>Ticket::where('ticket_status', 0)->orderBy('created_at', 'DESC')->get(),
                    'table_status'=>$this->table_status[0],
                    'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
        }else{
            return view('home',
                ['tickets'=>Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get()
                    , 'table_status'=> $this->table_status,
                    'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Dashboard($id=0)
    {
//        dd(\App\Models\Ticket::where('ticket_status', $id)->orderBy('created_at', 'DESC')->get());
//        dd($statu);  $statu="pas encore résolu"

        if(is_numeric($id) && $id >= 0 && $id <= 5)
        {
            if (Auth::user()->status){
                return view('Dashboard',
                    ['tickets'=>Ticket::where('ticket_status', $id)->orderBy('created_at', 'DESC')->get(),'table_status'=>$this->table_status[$id],
                    'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
            }else{
                return view('home',
                    ['tickets'=>Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get()
                        , 'table_status'=> $this->table_status,
                    'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
            }
        }elseif(substr($id,0,5)=="faho_" && substr($id,-4,4)=="2022"){
            $fas_1=substr($id,5);
            $fas_2=strrev(substr($fas_1,0));
            $notification_id=intval(substr($fas_2,4));
            $Notifi=Notification::find($notification_id);
            $Notifi->read=1;
            $Notifi->save();
            return redirect()->route('tickets.show',['ticket'=> $Notifi->type_id ]);
        }else{
            return view('Dashboard',
                ['tickets'=>Ticket::where('ticket_status', 0)->orderBy('created_at', 'DESC')->get(),'table_status'=>$this->table_status[0],
                    'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
        }

    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changestatus(Request $request){
        $ticket_id=$request->ticket_id;
        $ticket_status=$request->ticket_status;
        $ticket_avant=Ticket::find($ticket_id);
        $ticket_avant->ticket_status=$ticket_status;
        $ticket_avant->save();
        $data_notification['type']='CHange_Statu_Ticket';
        $data_notification['type_id']=$ticket_id;
        $data_notification['data']="Your ticket status has changed";
        $data_notification['user_id']=1;
        $data_notification['user_to_notify_id']=$ticket_avant->user_id;
        $noti=Notification::create($data_notification);
        return redirect()->route('Dashboard',['id'=>$ticket_status]);
    }
    public function AllUsers(){
        if (Auth::user()->status){
//            dd(\App\Models\User::where('status', 0)->orderBy('created_at', 'DESC')->get());
            return view('AllUser',
                ['AllUser'=>User::where('status', 0)->orderBy('created_at', 'DESC')->get(),
                'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
        }else{
            return redirect()->route('home');
        }
    }
    public function changestatus_user(){
        if (Auth::user()->status==1){
//            dd(\App\Models\User::where('status', 0)->orderBy('created_at', 'DESC')->get());
            return view('AllUser',
                ['AllUser'=>User::where('status', 0)->orderBy('created_at', 'DESC')->get(),
                'notification'=>Notification::where([['user_to_notify_id', Auth::user()->id],
                                                    ['read', '=',0]])->orderBy('created_at', 'DESC')->get()]);
        }else{
            return redirect()->route('home');
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_user(Request $request){
        if (Auth::user()->status==1){
//            dd(\App\Models\User::where('status', 0)->orderBy('created_at', 'DESC')->get());
//            Post::destroy($id);
//            $request->session()->flash('success', 'l3amalya  najha rah safi tms7at');
//            return redirect()->route('posts.index');
            $user_id=$request->user_id;
            User::destroy($user_id);
            return redirect()->route('All',
                ['AllUser'=>User::where('status', 0)->orderBy('created_at', 'DESC')->get()]);
        }else{
            return redirect()->route('home');
        }
    }
}
