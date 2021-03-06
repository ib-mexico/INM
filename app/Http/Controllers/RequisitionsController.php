<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\Returns\ActionReturn;
use App\RequisitionCat;
use App\Requisition;
use App\RequisitionData;
use App\RequisitionDescription;
use App\RequisitionMedia;
use Auth;
use PDF;

class RequisitionsController extends Controller
{
    public function index() {
        $lstRequisitions = Requisition::select(
                                        'requisitions.id_requisition',
                                        'sites.instance AS site',
                                        'users.name AS user',
                                        'requisitions.created_at'
                                    )
                                    ->join('users', 'users.id_user', '=', 'requisitions.id_user')
                                    ->join('sites', 'sites.id_site', '=', 'requisitions.id_site')
                                    ->get();

        return view('dashboard.requisitions.Index', ['lstRequisitions' => $lstRequisitions]);
    }

    public function store(Request $request) {

        $objReturn = new ActionReturn('panel/sitios/formulario/' . $request->id_site, 'panel/sitios');
        $requisionesCat = RequisitionCat::all();
        
        try {
            $objRequisition = new Requisition();
            $objRequisition->id_user = Auth::user()->id_user;
            $objRequisition->id_site = $request->id_site;
    
            foreach($requisionesCat as $item) {
    
                switch($item->id_requisition_cat) {
                    case 1:
                        (isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_elec = true : $objRequisition->bool_ins_elec = false;
                    break;
    
                    case 2:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_phy_earth = true : $objRequisition->bool_ins_phy_earth = false);
                    break;
    
                    case 3:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_grounding = true : $objRequisition->bool_ins_grounding = false);
                    break;
    
                    case 4:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_lighting = true : $objRequisition->bool_ins_lighting = false);
                    break;
    
                    case 5:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_supressor_a = true : $objRequisition->bool_ins_supressor_a = false);
                    break;
    
                    case 6:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_supressor_b = true : $objRequisition->bool_ins_supressor_b = false);
                    break;
                }
            }

                if($objRequisition->create()) {

                    if($request['description_requisition1'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 1;
                        $objDescription->description = $request['description_requisition1'];
                        $objDescription->create();
                    }    
                   
                    if($request['description_requisition2'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 2;
                        $objDescription->description = $request['description_requisition2'];
                        $objDescription->create();
                    }     
                    if($request['description_requisition3'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 3;
                        $objDescription->description = $request['description_requisition3'];
                        $objDescription->create();
                    }
                    if($request['description_requisition4'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 4;
                        $objDescription->description = $request['description_requisition4'];
                        $objDescription->create();
                    }  
                    if($request['description_requisition5'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 5;
                        $objDescription->description = $request['description_requisition5'];
                        $objDescription->create();
                    }  
                    if($request['description_requisition6'] != null) {
                        $objDescription = new RequisitionDescription();
                        $objDescription->id_requisition = $objRequisition->id_requisition;
                        $objDescription->id_requisition_cat = 6;
                        $objDescription->description = $request['description_requisition6'];
                        $objDescription->create();
                    }    


                    for($i = 1; $i < sizeof($requisionesCat) + 1; $i++) {
                        for($j = 0; $j < sizeof($request['cantidad'.$i]); $j++) {
                            if(isset($request['cantidad'.$i][$j]) && $request['cantidad'.$i][$j] != 0) {
                                $objData                    = new RequisitionData();
                                $objData->id_requisition    = $objRequisition->id_requisition;
                                $objData->quantity          = $request['cantidad'.$i][$j];
                                $objData->part_number       = $request['n_partes'.$i][$j];
                                $objData->description       = $request['descripcion'.$i][$j];
                                $objData->price             = $request['precio'.$i][$j];
                                $objData->id_requisition_cat = $i;
    
                                try {
                                    $objData->create();
                                } catch(Exception $exception) { $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']); }
                            }
                        }
                    }

                    $objReturn->setResult(true, Messages::REQUISICIONES_CREATE_01_TITLE, Messages::REQUISICIONES_CREATE_01_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::REQUISICIONES_CREATE_01_TITLE, Errors::REQUISICIONES_CREATE_01_MESSAGE);
                }
            } catch(Exception $exception) { $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']); }

         return $objReturn->getRedirectPath();
    }

    public function storeMedia(Request $request){

        $objMedia = new RequisitionMedia();

        $storage = Storage::disk('s3');
        $path = $storage->put('images', $request->file('imagen'), 'public');

        $objMedia->id_requisition = $request->id_requisition;
        $objMedia->created_id_user = Auth::user()->id_user;
        $objMedia->url = $path;
        $objMedia->create();

        return redirect('panel/requisiciones');
    }

    public function edit($id_requisition) {
        $objRequisition = Requisition::where('id_requisition', $id_requisition)->first();
    
        if($objRequisition != null) {
            $categories = array();
            $lstRequisitionCat = RequisitionCat::all();
    
            foreach($lstRequisitionCat as $requisitionCat) {
    
                $lstRequisitionData = RequisitionData::where('id_requisition', $id_requisition)
                                                    ->where('id_requisition_cat', $requisitionCat->id_requisition_cat)
                                                    ->get();

                $requisitionDescription = RequisitionDescription::where('id_requisition', $id_requisition)
                                                    ->where('id_requisition_cat', $requisitionCat->id_requisition_cat)
                                                    ->first();
                
                if(sizeof($lstRequisitionData) > 0 || $requisitionDescription) {
                    array_push($categories, array(
                        "id_requisition_cat"    => $requisitionCat->id_requisition_cat,
                        "name"                  => $requisitionCat->name,
                        "id_description"           => $requisitionDescription['id_requisition_description'],
                        "description"           => $requisitionDescription['description'],
                        "lstRequisitionData"    => ((sizeof($lstRequisitionData) == 0)? 0 : $lstRequisitionData)
                    ));
                }
            }

            $data = array(
                "id_requisition"    => $objRequisition->id_requisition,
                "id_user"           => $objRequisition->id_user,
                "name_user"         => $objRequisition->user->name,
                "id_site"           => $objRequisition->id_site,
                "name_site"         => $objRequisition->site->instance,
                "created_at"        => $objRequisition->created_at,
                "categories"        => $categories
            );
        } else {
            $data = "No hay registros.";
        }

        return view('dashboard.requisitions.Edit', ['data' => $data]);
    }

    public function storeEdit(Request $request){
        $objData                        = new RequisitionData();
        $objData->id_requisition        = $request->input('id_requisition');
        $objData->id_requisition_cat    = $request->input('id_requisition_cat');
        $objData->quantity              = $request->input('cantidad');
        $objData->part_number           = $request->input('n_partes');
        $objData->description           = $request->input('descripcion');
        $objData->price                 = $request->input('precio');
      
        $stringData = '<div class="row">
            <div class="col-md-1 text-center">
                <label>'.$request->input('cantidad').'</label>
            </div>
            <div class="col-md-2 text-right">
                <label>$ '.number_format($request->input('precio'), 2, '.', ',').'</label>
            </div>
            <div class="col-md-2 text-right">
                <label>$ '.number_format(($request->input('cantidad') * $request->input('precio')), 2, '.', ',').'</label>
            </div>
            <div class="col-md-2">
                <label>'.$request->input('n_partes').'</label>
            </div>
            <div class="col-md-4">
                <label>'.$request->input('descripcion').'</label>
            </div></div>
        ';

        if ($objData->create()){
            $return = true;
        } else {
            $return = false;
        }

        return ['return' => $return, 'data' => $stringData, 'id_cat' => $request->input('id_requisition_cat')];
    }

    public function deleteData(Request $request){

        $objData = RequisitionData::where('id_requisition_data', $request->input('id_data'))->first();
        $objData->delete();

        if($objData) {
            $delete = true;
        } else {
            $delete = false;
        }


        return ['delete' => $delete, 'id_requisition_data' => $request->input('id_data')];
    }

    public function editDescription(Request $request) {
        $descriptionUpdate = RequisitionDescription::where('id_requisition_description', $request->input('id_description'))->first();

        
        if($descriptionUpdate != null) {
            $description = RequisitionDescription::where('id_requisition_description', $request->input('id_description'))
                                ->update(['description' => $request->input('description')]);

            $rtDescription = RequisitionDescription::select('description')
                                                        ->where('id_requisition_description', $request->input('id_description'))
                                                        ->first();

            $returnDescription = $rtDescription->description;
        } else {
            $newDescription = new RequisitionDescription();
            $newDescription->id_requisition      = $request->input('id_requisition');
            $newDescription->id_requisition_cat  = $request->input('id_requisition_cat');
            $newDescription->description         = $request->input('description');
            
            $newDescription->create();

            $returnDescription = $newDescription->description;
        }

        $strNewDescription = '<div class="col-md-12"><div>Descripci&oacute;n: '.$returnDescription.'</div></div>';

        return ['descripcion' => $strNewDescription, 'id_requisition' => $request->input('id_requisition_cat')];

    }

    public function getMedia(Request $request){
        $idRequisicion = $request->input('id_requisicion');
        $stringFoto = '';

        $objFotos = RequisitionMedia::where('id_requisition', $idRequisicion)->get();

        foreach ($objFotos as $foto) {
            $stringFoto .= '
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel" height="110" width="110">
                            <img height="130px" src="https://s3.amazonaws.com/migracion-inm/'. $foto->url .'" />
                        </div>
                    </div>
                </div>
            ';
        }

        return ['fotos' => $stringFoto];
    }

    public function deleteRequisition($id_requisition){

        $requisitionData = RequisitionData::where('id_requisition', $id_requisition)->get();
        $requisitionMedia = RequisitionMedia::where('id_requisition', $id_requisition)->get();
        $requisitionDescription = RequisitionDescription::where('id_requisition', $id_requisition)->get();

        if (sizeof($requisitionData) > 0) {
            foreach ($requisitionData as $reqData) {
                $reqData->delete();
            }
        }

        if (sizeof($requisitionMedia) > 0) {
            foreach ($requisitionMedia as $reqMedia) {
                $reqMedia->delete();
            }
        }

        if (sizeof($requisitionDescription) > 0) {
            foreach ($requisitionDescription as $reqDescription) {
                $reqDescription->delete();
            }
        }

        Requisition::where('id_requisition', $id_requisition)->delete();

        return redirect('panel/requisiciones');
    }

    /*public function copyRequisition($id_requisition) {

        return redirect('panel/requisiciones');
    }*/

    public function generatePDF($id_requisition) {
    
        $objRequisition = Requisition::where('id_requisition', $id_requisition)->first();
    
        if($objRequisition != null) {
            $categories = array();
            $lstRequisitionCat = RequisitionCat::all();
    
            foreach($lstRequisitionCat as $requisitionCat) {
    
                $lstRequisitionData = RequisitionData::where('id_requisition', $id_requisition)
                                                    ->where('id_requisition_cat', $requisitionCat->id_requisition_cat)
                                                    ->get();

                $requisitionDescription = RequisitionDescription::where('id_requisition', $id_requisition)
                                                    ->where('id_requisition_cat', $requisitionCat->id_requisition_cat)
                                                    ->first();
                if ($requisitionDescription['description'] != null && sizeof($lstRequisitionData) == 0) {
                    array_push($categories, array(
                        "id_requisition_cat"    => $requisitionCat->id_requisition_cat,
                        "name"                  => $requisitionCat->name,
                        "description"           => $requisitionDescription['description'],
                        "lstRequisitionData"    => $lstRequisitionData
                    ));
                }

                if(sizeof($lstRequisitionData) > 0) {
                    array_push($categories, array(
                        "id_requisition_cat"    => $requisitionCat->id_requisition_cat,
                        "name"                  => $requisitionCat->name,
                        "description"           => $requisitionDescription['description'],
                        "lstRequisitionData"    => $lstRequisitionData
                    ));
                }
            }

            $data = array(
                "id_requisition"    => $objRequisition->id_requisition,
                "id_user"           => $objRequisition->id_user,
                "name_user"         => $objRequisition->user->name,
                "id_site"           => $objRequisition->id_site,
                "name_site"         => $objRequisition->site->instance,
                "created_at"        => $objRequisition->created_at,
                "categories"        => $categories
            );
    
            $pdf = PDF::loadView('dashboard.reports.Requisition', ['data' => $data]);
            return $pdf->stream();
        }
    }
}


