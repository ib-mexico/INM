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

    public function saveDate(Request $request){

        $fecha =  $request->input('fecha');
        $objSite = Site::where('id_site', $request->id_site)->first();
        $objSite->delivery_date = date('Y-m-d H:i:s', strtotime($fecha));
        $objSite->save();
        
        return redirect()->route('sites');
    }
}
