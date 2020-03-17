<?php


namespace App\Classes\Weather\Api;


use GuzzleHttp\Client;

class YandexWeather
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct()
    {

        $this->client = new Client(['base_uri'=>getenv('YANDEX_WEATHER_URI')]);

    }

    /**
     * @param float $lat
     * @param float $lon
     * @return array|bool
     */
    public function get_weather(float $lat, float $lon)
    {

        $params = [
            "lat" => $lat,
            "lon" => $lon,
            "lang" => "ru_RU",
            "limit" => 1,
            "hours" => "false",
            "extra" => "false"
        ];

        try{

            $response = $this->client->get(getenv('YANDEX_WEATHER_URI'),[

                'query' => $params,
                'headers'=>[
                    'X-Yandex-API-Key'=>getenv('YANDEX_WEATHER_KEY'),
                ]

            ]);


        }catch (\Exception $e){

            //todo логгирование ошибок

            return false;

        }

        if($response->getStatusCode()!==200){

            return false;

        }else{

            $result = $response->getBody()->getContents();

            $result = json_decode($result);

            if($result===null){

                return false;

            }

            $weather = $result->fact??null;


            if(empty($weather)){

                return false;

            }

            return [

                'currentTemp'=>$weather->temp??"Ошибка"

            ];

        }

    }
}