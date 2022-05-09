@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-between  flex-wrap">
                <div class="text-center d-flex justify-content-start align-items-center">
                    <h5>ticket : &nbsp;</h5>
                    <h6 class="title_teckit">{{ $ticket->ticket_title }}</h6>
                </div>
                <div class="text-center d-flex justify-content-start align-items-center">
                    <h5> Status : &nbsp;</h5>
                    <h6 class="status_teckit"> {{ $table_status}} </h6>
                </div>
            </div>
            <ul class="list-group-ticket text-center">
                <li class=" ticket_question">
                    <p> {{ $ticket->ticket_question }} </p>
                </li>
            </ul>
            @if( $ticket->ticket_status)
                @if( $ticket->ticket_status!=0 && $ticket->ticket_status!=5)
                <form action="{{ route('comments.store') }}" method="POST" class="p-0 mb-1">
                    @csrf
                    <div class="mb-2">
                        <label for="comment_content" class="form-label">comment</label>
                        <textarea  class="form-control bg-white" id="comment_content" name="comment_content" value="{{ old('comment_content')}}"></textarea>
                        @error('comment_content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" value="{{ $ticket->id }}" name="id_ticket">
                    <button type="submit" class="btn btn-primary">add Comment</button>
                </form>
                @endif
            <div class="d-flex flex-column align-items-center comments-responsive">
                @foreach( $comment as $comm)
                    @if(Auth::user()->status != 1)
                        @if($comm->user_id != Auth::user()->id)
                            <div class="div_comment_class d-flex justify-content-start">
                                <div class="mb-1 mt-1">
    {{--                                <h5>Adminstration </h5>--}}
                                    <div class="text-center d-flex justify-content-start align-items-center">
                                        <h5 class="comment-user-time">Adminstration  . </h5>
                                        <h6 class="title_teckit comment-user-time">{{ $comm->created_at->diffForHumans() }}</h6>
                                    </div>
                                    <p class="comment_class bg-info p-2 text-center">{{ $comm->comment_content }}</p>
                                </div>
                            </div>
                        @else
                            <div class="div_comment_class d-flex justify-content-end">
                                <div class=" mb-1 mt-1">
                                    <div class="text-center d-flex  align-items-center justify-content-end">
                                        <h5 class="comment-user-time">{{ Auth::user()->name }}  . </h5>
                                        <h6 class="title_teckit comment-user-time">{{ $comm->created_at->diffForHumans() }}</h6>
                                    </div>
    {{--                                <h5 class="text-end">{{ Auth::user()->name }} </h5>--}}
                                    <p class="comment_class bg-warning p-2 text-center">{{ $comm->comment_content }}</p>
    {{--                                <h6 class="mt-1 text-end title_teckit"> {{ $comm->created_at->diffForHumans() }} </h6>--}}
                                </div>
                            </div>
                        @endif
                    @else
                        @if($comm->user_id != Auth::user()->id)
                            <div class="div_comment_class d-flex justify-content-end">
                                <div class=" mb-1 mt-1">
                                    <div class="text-center d-flex  align-items-center justify-content-end">
                                        <h5 class="comment-user-time">{{ $comment_user->name }}  . </h5>
                                        <h6 class="title_teckit comment-user-time">{{ $comm->created_at->diffForHumans() }}</h6>
                                    </div>
                                    {{--                                <h5 class="text-end">{{ Auth::user()->name }} </h5>--}}
                                    <p class="comment_class bg-warning p-2 text-center">{{ $comm->comment_content }}</p>
                                    {{--                                <h6 class="mt-1 text-end title_teckit"> {{ $comm->created_at->diffForHumans() }} </h6>--}}
                                </div>
                            </div>
                        @else
                            <div class="div_comment_class d-flex justify-content-start">
                                <div class="mb-1 mt-1">
                                    {{--                                <h5>Adminstration </h5>--}}
                                    <div class="text-center d-flex justify-content-start align-items-center">
                                        <h5 class="comment-user-time">{{ Auth::user()->name }} . </h5>
                                        <h6 class="title_teckit comment-user-time">{{ $comm->created_at->diffForHumans() }}</h6>
                                    </div>
                                    <p class="comment_class bg-info p-2 text-center">{{ $comm->comment_content }}</p>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach

           </div>
            @endif
        </div>
    </div>
@endsection
