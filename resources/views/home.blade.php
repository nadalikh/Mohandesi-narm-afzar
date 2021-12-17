@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}

                @foreach($question as $movieKey => $movie)
                    <div class="form-check" id="{{$movie->imdb_title_id}}">
                        <p>Who is the director of {{$movie->title}} movie which published in {{$movie->year}} in {{$movie->country}}?</p>
                        @foreach($movie->directorQuiz as $answerKey => $answer)
                            <input class="form-check-input" type="radio" name="{{$movieKey}}" id="{{$answerKey}}" value="{{$answer}}">
                            <label class="form-check-label" for="flexRadioDefault1">
                                {{$answer}}
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
