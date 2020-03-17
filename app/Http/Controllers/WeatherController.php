<?php

namespace App\Http\Controllers;

use App\Classes\Weather\Api\YandexWeather;

class WeatherController extends Controller
{
    public function index(YandexWeather $yandexWeather){

        $lat = "53.15";
        $lon = "34.22";

        $weather = $yandexWeather->get_weather($lat,$lon);

        if($weather){

            return view("weather.index", compact('weather'));

        }else{

            return back()->with('fails','Сервис погоды временно недоступен.');

        }

    }
}
