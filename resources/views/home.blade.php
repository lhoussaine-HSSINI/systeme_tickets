@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <a class="btn-primary btn " href="{{ route('tickets.create')}}"> add ticket</a>
                </div>
                <div class="card-body" id="card-body">
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
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('tickets.show',['ticket'=> $t->id ])}}">
                                            {{ $t->ticket_title }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="btn-primary p-1 rounded">
                                            {{ $table_status[$t->ticket_status] }}
                                        </span>
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
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    {{ __('You are logged in!') }}--}}
