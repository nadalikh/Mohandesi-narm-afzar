@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">quize</div>

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}

                @isset($status)
                    @if($status)
                        {{"<script>alert('Well done, you were true.Try this one!!!')</script>"}}
                    @else
                        {{"<script>alert('You were wrong. Compensate on this question :)')</script>"}}

                    @endif

                @endisset
                <form method="get" action="{{route("directorAns")}}" class="form-check">
                    <p>Who is the director of {{$quiz["question"]->title}} movie which published in {{$quiz["question"]->year}} in {{$quiz["question"]->country}}?</p>
                    <input type="hidden" name="movieId" value="{{$quiz["question"]->imdb_title_id}}">
                    <div class="row justify-content-around">
                        @foreach($quiz["answer"] as $answerKey => $answer)
                            <div class="col-5">
                                <input class="form-check-input" type="radio" name="director" id="{{$answer->director}}" value="{{$answer->director}}">
                                <label class="form-check-label" for="{{$answer->director}}">
                                    {{$answer->director}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btn-primary my-3" type="submit">confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
