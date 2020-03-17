@extends("layouts.app")
@section("content")

    <h3>Текущая температура в Брянске: {{$weather['currentTemp']}}°C</h3>

@endsection