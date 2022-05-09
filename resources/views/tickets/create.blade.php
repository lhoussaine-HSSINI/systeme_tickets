@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        <h1 class="text-center heder_add_ticket"> add ticket </h1>
                    </div>
                    <div class="card-body">
                 <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select class="form-select" name="ticket_choix">
                        <option selected disabled> select category </option>
                        <option value="math" {{ old('ticket_choix') == "math" ? 'selected' : '' }}>math</option>
                        <option value="islamic" {{ old('ticket_choix') == "islamic" ? 'selected' : '' }}>islamic</option>
                        <option value="physsique" {{ old('ticket_choix') == "physsique" ? 'selected' : '' }}>physsique</option>
                    </select>
                    @error('ticket_choix')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ticket_title" class="form-label">title of ticket</label>
                    <input type="text" class="form-control" id="ticket_title" name="ticket_title" value="{{ old('ticket_title')}}">
                    @error('ticket_title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="question_ticket" class="form-label">question ticket</label>
                    <textarea  class="form-control" id="question_ticket" name="ticket_question" value="{{ old('ticket_question')}}"></textarea>
                    @error('ticket_question')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
{{--                @if( $errors->any() )--}}
{{--                    <ul>--}}
{{--                        @foreach( $errors-> all() as $error )--}}
{{--                            <li class="text-danger"> {{ $error }} </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                @endif--}}
                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary">add</button>
                    <a class="btn-primary btn " href="{{ route('home')}}"> cancel</a>
                </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
