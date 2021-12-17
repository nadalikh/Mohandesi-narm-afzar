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


                <div class="form-check" id="{{$question->imdb_title_id}}">
                    <p>Who is the director of {{$question->title}} movie which published in {{$question->year}} in {{$question->country}}?</p>
                    @foreach($answers as $answerKey => $answer)
                        <div class="col-5">
                            <input class="form-check-input" type="radio" name="{{$answer->director}}" id="{{$answer->director}}" value="{{$answer->director}}">
                            <label class="form-check-label" for="{{$answer->director}}">
                                {{$answer->director}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
