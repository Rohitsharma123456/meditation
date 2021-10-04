<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgoController extends Controller
{
    public function index(){
        //display the array
        $array=[4,8,5,41,65,1,3,21,47];
        echo('[');
        foreach($array as $key=>$value){
        echo($value.' ');
        }
        echo(']');
        echo('<br>');

        //linear search
        $searchterm=3;
        $i=0;
        foreach($array as $key=>$value){
            $i++;
            if($searchterm==$value){

                echo('Linear Search : search term '.$searchterm. ' found at index  '. $key .' in '. $i . ' steps');
            }
        }
        //binary search
        $sortedarray=[];
        foreach($array as $key=>$value){
            if($key>0){
            if($value<$array[$key-1]){
             $temp=$array[$key-1];
             $array[$key-1]=$array[$key];
             $array[$key]=$temp;
            }
        }else{
            $temp=$array[0];
            $array[0]=$array[$key];
            $array[$key]=$temp;
            }
        }
        $sortedarray=$array;
        echo('[');
        foreach($sortedarray as $key=>$value){
                echo($value.' ');
        }
        echo(']');
        echo('<br>');

    }

    
}
