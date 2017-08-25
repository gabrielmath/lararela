<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\Location;

class OneToOneController extends Controller
{
    public function oneToOne()
    {
        $country = Country::find(1);

        //Variação
//        $country = Country::where('name', 'Brasil')->get()->first();

        echo $country->name;

        $location = $country->location;

        //Variação
//        $location = $country->location()->get()->first();

        echo "<hr>Latitude: {$location->latitude}<br>Longitude: {$location->longitude}";
    }

    public function oneToOneInverse()
    {
        $latitude = 123;
        $longitude = 321;

        $location = Location::where('latitude',$latitude)->where('longitude', $longitude)->get()->first();

        echo $location->id;
    }

    public function oneToOneInsert()
    {
        $dataForm = [
            'name' => 'França',
            'latitude' => 852,
            'longitude' => 258
        ];

        $country = Country::create($dataForm);

        //$dataForm['country_id'] = $country->id;
        //$location = Location::create($dataForm);

        /*$location = new Location;
        $location->latitude = $dataForm['latitude'];
        $location->longitude = $dataForm['longitude'];
        $location->country_id = $country->id;
        $saveLocation = $location->save();*/

        $location = $country->location()->create($dataForm);
        var_dump($location);

    }























}
