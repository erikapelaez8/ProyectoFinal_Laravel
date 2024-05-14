<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //Conexión a la base de datos
    function testDB(){
        try {
            DB::connection()->getPdo();
            if (DB::Connection()->getDataBaseName()){
                echo "Yes! Successfully connected to the DB: " . DB::Connection()->getDataBaseName();
            }else {
                die("Could not find the database. Please check your configuration. ");
            }
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        
    }
}
