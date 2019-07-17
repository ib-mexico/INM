<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\RequisitionCat;
use App\Site;

class SitesController extends Controller
{
    public function index(){
        $sitios = Site::all();
        return view('dashboard.sites.index', ['sitios' => $sitios]);
    }

    public function formulario($id_empresa){
        $empresa = Site::where('id_site', '=', $id_empresa)->first();
        $requisiones = RequisitionCat::all();

        return view('dashboard.sites.formulario', ['requisiciones' => $requisiones,
                                                    'sitio' => $empresa]);
    }

}
