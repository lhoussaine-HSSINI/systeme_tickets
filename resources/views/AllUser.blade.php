@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card_t">
                    <div class="card-header d-flex justify-content-sm-evenly justify-content-around align-items-center nav_status_ticket_admin">
                        <a href="{{ route('All')}}" class="btn btn-success all_tickets">All Users </a>
                        <a href="{{ route('All')}}" class="btn btn-success all_tickets">Choix de services </a>
                    </div>
                    <strong class="text-center"> All Users </strong>
                    <div class="card-body card-body_t" id="card-body">
                        <div class="table-responsive">
                                <table class="table caption-top">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email </th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $AllUser as $i =>  $t)
                                        <tr class="text-center">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $t->name}}</td>
                                            <td>{{ $t->email}}</td>
{{--                                            <td><i class="fas fa-trash-alt"></i></td>--}}
                                            <td><a class="btn btn_delete_user"  href="{{ route('Dashboard', ['id'=>3])}}" title="Delete"
                                                   data-bs-toggle="modal" data-bs-target="#modal_change_status{{ $t->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <!-- start Modal  form change admin status ticket -->
                                                <div class="modal fade" id="modal_change_status{{ $t->id }}" tabindex="-1"  aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" >Delete user {{ $t->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('delete') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    wax biti tms7 had user
                                                                </div>
                                                                <div class="modal-footer justify-content-evenly">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <input type="hidden" value="{{ $t->id }}" name="user_id">
                                                                    <button type="submit" class="btn btn-primary">Save</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
