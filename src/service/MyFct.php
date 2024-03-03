<?php
namespace App\service;
class MyFct{

    public function printr($array){

        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    public function getExtension($nameFile){
        $names=explode('.',$nameFile);
        $key=array_key_last($names);
        $extension=$names[$key];
        return $extension;
    }


}