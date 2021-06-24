<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Laravel\Lumen\Http\ResponseFactory;

class PokemonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @param $cityz'
     * @return Response|ResponseFactory
     */
    public function searchByCity(Request $request, $city)
    {
        $response = $this->getCityInfos($city);
        $pokemon = $this->getPokemon($response);

        return response($pokemon, 200);
    }

    public function getCityInfos($cityName)
    {
        $urlOpenWeatherToken = getenv('OPENWEARHERTOKEN');
        $urlOpenWeather = getenv("OPENWEARHERURL");
        $urlGet = $urlOpenWeather."?q=".$cityName."&APPID=".$urlOpenWeatherToken;

        $client = new Client();
        $response = $client->request('GET', $urlGet);
        $data = json_decode($response->getBody());

        $tempKelvin = number_format($data->main->temp);
        $kelvinToCelsius = $tempKelvin - 273.15;

        return [
            'temp' => round($kelvinToCelsius),
            'rain' => $data->weather[0]->main == "Rain" ? 1 : 0
        ];
    }

    public function getPokemon($cityInfo)
    {
        $type = 'normal';
        if ($cityInfo['temp'] < 5) $type = 'ice';
        if ($cityInfo['temp'] >= 5 && $cityInfo['temp'] < 10) $type = 'water';
        if ($cityInfo['temp'] >= 12 && $cityInfo['temp'] < 15) $type = 'grass';
        if ($cityInfo['temp'] >= 15 && $cityInfo['temp'] < 21) $type = 'ground';
        if ($cityInfo['temp'] >= 23 && $cityInfo['temp'] < 27) $type = 'bug';
        if ($cityInfo['temp'] >= 27 && $cityInfo['temp'] < 33) $type = 'rock';
        if ($cityInfo['temp'] >= 33) $type = 'fire';
        if ($cityInfo['rain']) $type = 'eletric';

        $pokemonApiUrl = getenv('POKEMONAPIURL');
        $urlGet = $pokemonApiUrl.$type;

        $client = new Client();
        $response = $client->request('GET', $urlGet);
        $data = json_decode($response->getBody());

        $qtd = count($data->pokemon);
        $randPokemon = rand(0, $qtd-1);

        $cityInfo['pokemon']['name'] = $data->pokemon[$randPokemon]->pokemon->name;

        $response = $client->request('GET', $data->pokemon[$randPokemon]->pokemon->url);
        $dataUrlForms = json_decode($response->getBody());

        $responseUrlForms = $client->request('GET', $dataUrlForms->forms[0]->url);
        $dataUrlFormsImage = json_decode($responseUrlForms->getBody());
        $cityInfo['pokemon']['image'] = $dataUrlFormsImage->sprites->front_default;
        return $cityInfo;
    }
}
