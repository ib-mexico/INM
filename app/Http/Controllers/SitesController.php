<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\RequisitionCat;
use App\Site;
use DB;

class SitesController extends Controller
{
    public function index(){
        $sitios = Site::all();
        return view('dashboard.sites.Index', ['sitios' => $sitios]);
    }

    public function formulario($id_empresa){
        $empresa = Site::where('id_site', $id_empresa)->first();
        $requisiones = RequisitionCat::all();

        return view('dashboard.sites.Form', ['requisiciones'      => $requisiones,
                                                    'sitio'             => $empresa,
                                                    'num_requisiciones' => sizeof($requisiones)]);
    }

}
