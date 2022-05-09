<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/theme.css') }}">
    <title>home</title>
</head>
<body>
{{--@if(session()->has('success'))--}}
{{--    <h1 class="alert-danger"> {{session()->get('success')}} </h1>--}}
{{--@endif--}}

<nav class="navbar navbar-expand navbar-dark bg-success">
{{--    <ul class="nav navbar-nav">--}}
{{--        <li class="nav-item"><a class="nav-link" href="{{ route('home')}}"> home</a> </li>--}}
{{--        <li class="nav-item"> <a class="nav-link" href="{{ route('blog')}}"> about </a></li>--}}
{{--        <li class="nav-item"><a class="nav-link" href="{{ route('posts.index')}}"> posts </a></li>--}}
{{--        <li class="nav-item"><a class="nav-link" href="{{ route('posts.create')}}"> post add </a></li>--}}
{{--    </ul>--}}
    <ul class="nav navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#"> home</a> </li>
        <li class="nav-item"> <a class="nav-link" href="#"> about </a></li>
        <li class="nav-item"><a class="nav-link" href="#"> posts </a></li>
        <li class="nav-item"><a class="nav-link" href="#"> post add </a></li>
    </ul>
</nav>
<div class="container">
    @yield('content')
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
    <a class="btn btn-primary" href="{{ route('tickets.show',['ticket'=> $t->id ])}}">{{ $t->ticket_title }}</a>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
