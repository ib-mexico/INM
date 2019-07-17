<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
class SitesController extends Controller
{
    public function index(){
        $sitios = Site::all();
        return view('dashboard.sites.index', ['sitios' => $sitios]);
    }

    public function formulario(){
        return view('dashboard.components.form');
    }

}
