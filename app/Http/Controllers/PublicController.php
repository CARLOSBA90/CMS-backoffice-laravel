<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PublicService;

class PublicController extends Controller
{
    public function index()
    {  return PublicService::index(); 
    }

    public function seccion($seccion)
    {  return "es seccion ".$seccion; 
    }
}
