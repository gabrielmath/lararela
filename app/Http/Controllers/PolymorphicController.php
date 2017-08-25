<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class PolymorphicController extends Controller
{
    public function polymorphic()
    {
        $city = City::where('name', 'São Paulo')->get()->first();
        echo "<strong>{$city->name}:</strong><br>";

        $comments = $city->comments()->get();

        foreach ($comments as $comment) {
            echo "{$comment->description}<br>";
        }
    }

    public function polymorphicInsert()
    {

        $city = City::where('name', 'São Paulo')->get()->first();
        echo $city->name;

        $comment = $city->comments()->create([
            'description' => "New Comment {$city->name} ".date('YmdHis'),
        ]);

        dd($comment);
        /*
        $state = State::where('name', 'Paraná')->get()->first();
        echo $state->name;

        $comment = $state->comments()->create([
            'description' => "New Comment {$state->name} ".date('YmdHis'),
        ]);

        dd($comment);

        $country = Country::where('name', 'Brasil')->get()->first();
        echo $country->name;

        $comment = $country->comments()->create([
            'description' => "New Comment {$country->name} ".date('YmdHis'),
        ]);

        dd($comment);
        */
    }
}
