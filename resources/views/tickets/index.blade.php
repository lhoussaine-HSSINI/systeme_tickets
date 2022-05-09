@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card_t">
                <div class="card-header d-flex justify-content-sm-evenly justify-content-around align-items-center nav_status_ticket_admin">
                    <a href="{{ route('tickets.index')}}" class="btn btn-success all_tickets">all tickets </a>
                    <div class="dropdown">
                        <a class="btn btn-success all_tickets dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            status ticket
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('Dashboard', ['id'=>0])}}">nouveau</a></li>
                            <li><a class="dropdown-item" href="{{ route('Dashboard', ['id'=>1])}}">pas encore répondu</a></li>
                            <li><a href="{{ route('Dashboard', ['id'=>2])}}" class="dropdown-item">répondu</a></li>
                            <li><a href="{{ route('Dashboard', ['id'=>3])}}" class="dropdown-item">pas encore résolu</a></li>
                            <li><a href="{{ route('Dashboard', ['id'=>4])}}" class="dropdown-item">résolu</a></li>
                            <li><a href="{{ route('Dashboard', ['id'=>5])}}" class="dropdown-item">fermé</a></li>
                        </ul>
                    </div>
                </div>
                <strong class="text-center"> all tickets </strong>
                <div class="card-body card-body_t" id="card-body">
                    <div class="table-responsive">
                        @if( count($tickets))
                            <table class="table caption-top">
                                <thead>
                                <tr class="text-center">
                                    <th class="color_font_size_tabl_all_ticket_td" scope="col">#</th>
                                    <th class="color_font_size_tabl_all_ticket_td" scope="col">title</th>
                                    <th class="color_font_size_tabl_all_ticket_td" scope="col">status </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ( $tickets as $i =>  $t)
                                    <tr class="text-center ">
                                        <td>{{ ++$i }}</td>
                                        <td><a class=" color_font_size_tabl_all_ticket_td btn btn-primary all_tickets" href="{{ route('tickets.show',['ticket'=> $t->id ])}}">{{ $t->ticket_title }}</a></td>
                                            <td><span class=" color_font_size_tabl_all_ticket_td btn-primary all_tickets">{{ $table_status[$t->ticket_status]}}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center"> Not ticket </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    @if(session()->has('success'))--}}
{{--        <h1 class="alert-danger"> {{session()->get('success')}} </h1>--}}
{{--    @endif--}}
{{--    <h1 class="text-center">list of tickets</h1>--}}
{{--    <h1 class="text-center"> <a class=" link-danger btn " href="{{ route('tickets.create')}}"> add ticket</a></h1>--}}
{{--    <ul class="list-group text-center">--}}
{{--            @forelse ( $tickets as $t)--}}
{{--                <li class="list-group-item">--}}
{{--                    <p> {{ $t->id }} </p>--}}
{{--                    <p> {{ $t->user_id }} </p>--}}
{{--                    <p> {{ $t->ticket_status }} </p>--}}
{{--                    <p> {{ $t->ticket_question }} </p>--}}
{{--                    <p> {{ $t->created_at->diffForHumans()}} </p>--}}
{{--                    <a href="{{ route('tickets.show',['ticket'=> $t->id ])}}">show this ticket </a>--}}
{{--                </li>--}}
{{--            @empty--}}
{{--                <p> Not tickets </p>--}}
{{--            @endforelse--}}
{{--    </ul>--}}
</div>
@endsection
