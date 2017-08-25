<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class OneToManyController extends Controller
{
    public function oneToMany()
    {
        /* Busca direta com retorno de apenas 1 resultado */
        //$country = Country::where('name', 'Brasil')->get()->first();

        //echo $country->name;

        /* Buscar em formato de atributo */
        //$states = $country->states;

        /* Buscar em formato de método - O resultado (geral) será igual, porém dessa forma também é possível realizar filtros na tabela relacionada */
        //$states = $country->states()->where('initials', 'SP')->get();

        //foreach ($states as $state){
            //echo "<hr>{$state->initials} - {$state->name}";
        //}



        //=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=//



        /* Busca com a possibilidade de retornar mais de um resultado*/
        $keySearch = 'a';

        //$countries = Country::where('name', 'LIKE', "%{$keySearch}%")->get();

        /* OTIMIZANDO A BUSCA E RETORNANDO MAIS RESULTADO EM MENOS CONSULTAS COM O MÉTODO with('tabela_relacionada') */
        $countries = Country::where('name', 'LIKE', "%{$keySearch}%")->with('states')->get();

        //dd($countries);

        foreach ($countries as $country){

            echo "<hr><strong>{$country->name}</strong>";

            /* Buscar em formato de atributo */
            $states = $country->states;

            /* Buscar em formato de método - O resultado (geral) será igual, porém dessa forma também é possível realizar filtros na tabela relacionada */
            //$states = $country->states()->where('initials', 'SP')->get();

            foreach ($states as $state){
                echo "<br>{$state->initials} - {$state->name}";
            }
            echo "<br>";
        }

    }

    public function manyToOne()
    {
        $stateName = 'São Paulo';
        $state = State::where('name', $stateName)->get()->first();

        echo $state->name;
        echo "<br>";

        $country = $state->country;
        echo "País: {$country->name}";
    }

    public function oneToManyTwo()
    {
        $keySearch = 'a';
        $countries = Country::where('name', 'LIKE', "%{$keySearch}%")->with('states')->get();

        dd($countries);

        foreach ($countries as $country){

            echo "<hr><strong>{$country->name}</strong>";


            $states = $country->states;

            foreach ($states as $state){
                echo "<br>{$state->initials} - {$state->name}: ";

                foreach ($state->cities as $city){
                    echo " <span style='font-style: italic;'>{$city->name},</span>";
                }
            }
            echo "<br>";
        }
    }


    /*
     * Como salvar dados em um relacionamento de um para muitos
     */

    /* Método 1 (melhor método até agora) */
    public function oneToManyInsert()
    {
        $dataForm = [
            'name' => 'Paraná',
            'initials' => 'PR'
        ];

        $country = Country::find(1);

        $insertState = $country->states()->create($dataForm);
        dd($insertState->name);
    }

    /* Método 2 */
    public function oneToManyInsertTwo()
    {
        $dataForm = [
            'name' => 'Rio Grande do Sul',
            'initials' => 'RS',
            'country_id' => '1',
        ];


        $insertState = State::create($dataForm);
        dd($insertState->name);
    }

    public function hasManyThrough()
    {
        $country = Country::find(1);
//        dd($country);
        echo "<strong>{$country->name}</strong><br>";

        $cities = $country->cities;

        foreach ($cities as $city){
            echo " {$city->name},";
        }

        echo "<br> Total cidades: {$cities->count()}";
    }






































}
