<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class ManyToManyController extends Controller
{
    public function manyToMany()
    {
        $city = City::where('name', 'São Paulo')->get()->first();
        echo "{$city->name}<br>";

        $companies = $city->companies;
        foreach ($companies as $company){
            echo " {$company->name},";
        }
    }

    public function manyToManyInverse()
    {
        $company = Company::where('name', 'Especializa TI')->get()->first();
        echo "{$company->name}<br>";

        $cities = $company->cities;
        foreach ($cities as $city){
            echo " {$city->name},";
        }
    }

    public function manyToManyInsert()
    {
        $dataForm = [1,2,3,4];

        $company = Company::find(1);
        echo "<strong>{$company->name}:</strong><br>";

        /* Attach sempre INCREMENTA. Caso eu queira deletar um relacionamento, preciso fazer na mão; */
        //$company->cities()->attach($dataForm);

        /* Detach remove os itens de relacionamento. Caso não seja passado paramêtro indicando o relacionamento a ser removido, ele remove tudo; */
        //$company->cities()->detach($dataForm);


        /* Sync faz a SINCRONIZAÇÃO dos campos. Ele verifica os itens e, caso algum deles tenha sido removido do array, ele também o remove da tabela automaticamente; */
        $company->cities()->sync($dataForm);

        $cities = $company->cities;
        foreach ($cities as $city){
            echo " {$city->name},";
        }
    }






































}
