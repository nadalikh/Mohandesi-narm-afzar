@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-light p-3 bg-dark text-light">Quiz</div>

                @isset($status)
                    @if($status)
                        <script>alert('Well done, you were true.Try this one!!!')</script>
                    @else
                        <script>alert('You were wrong. Compensate on this question :)')</script>
                    @endif

                @endisset
                <form method="get" action="{{route("directorAns")}}" class="form-check bg-dark p-3">
                    <p class="text-light">Who is the director of {{$quiz["question"]->title}} movie which was published in {{$quiz["question"]->year}} in {{$quiz["question"]->country}}?</p>
                    <input type="hidden" name="movieId" value="{{$quiz["question"]->imdb_title_id}}">
                    <div class="row justify-content-around">
                        @foreach($quiz["answer"] as $answerKey => $answer)
                            <div class="col-5">
                                <input class="form-check-input text-light" type="radio" name="director" id="{{$answer->director}}" value="{{$answer->director}}">
                                <label class="form-check-label text-light" for="{{$answer->director}}">
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
