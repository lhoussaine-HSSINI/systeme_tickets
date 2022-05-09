@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card_t">
                    <div class="card-header d-flex justify-content-sm-evenly justify-content-around align-items-center nav_status_ticket_admin">
                        <a href="{{ route('tickets.index')}}" class="btn btn-success all_tickets">All tickets </a>
                        <a href="{{ route('All')}}" class="btn btn-success all_tickets">All users </a>
                        <div class="dropdown">
                            <a class="btn btn-success all_tickets dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Status ticket
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
                    <strong class="text-center"> Tickets des {{ $table_status }} </strong>
                    <div class="card-body card-body_t" id="card-body">
                        <div class="table-responsive">
                            @if( count($tickets))
                                <table class="table caption-top">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">title</th>
                                        <th scope="col">status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $tickets as $i =>  $t)
                                        <tr class="text-center">
                                            <td>{{ ++$i }}</td>
                                            <td><a class="btn btn-primary" href="{{ route('tickets.show',['ticket'=> $t->id ])}}">{{ $t->ticket_title }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_change_status{{ $t->id }}">
                                                        {{ $table_status }}
                                                    </button>
                                                    <!-- start Modal  form change admin status ticket -->
                                                        <div class="modal fade" id="modal_change_status{{ $t->id }}" tabindex="-1"  aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" >change status ticket</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                    <form action="{{ route('changestatu')}}" method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                        <select name="ticket_status" class="form-select form-select-sm all_tickets ticket_status_change">
                                                                            <option value="0" {{ $t->ticket_status == 1 ? 'selected' : '' }}>nouveau</option>
                                                                            <option value="1" {{ $t->ticket_status == 2 ? 'selected' : '' }}>pas encore répondu</option>
                                                                            <option value="2" {{ $t->ticket_status == 3 ? 'selected' : '' }}>répondu</option>
                                                                            <option value="3" {{ $t->ticket_status == 3 ? 'selected' : '' }}>pas encore résolu</option>
                                                                            <option value="4" {{ $t->ticket_status == 4 ? 'selected' : '' }}>résolu</option>
                                                                            <option value="5" {{ $t->ticket_status == 5 ? 'selected' : '' }}>fermé</option>
                                                                        </select>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-evenly">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <input type="hidden" value="{{ $t->id }}" name="ticket_id">
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Modal  form change admin status ticket -->
                                                </td>
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
    </div>
@endsection
