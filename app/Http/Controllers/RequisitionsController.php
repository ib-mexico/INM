<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\Returns\ActionReturn;
use App\RequisitionCat;
use App\Requisition;
use App\RequisitionData;
use Auth;

class RequisitionsController extends Controller
{
    public function store(Request $request) {

        //dd($request);

        $objReturn = new ActionReturn('panel/sitios/formulario' . $request->id_site, 'panel/sitios');
        $requisionesCat = RequisitionCat::all();
        
        try {
            $objRequisition = new Requisition();
            $objRequisition->id_user = Auth::user()->id_user;
            $objRequisition->id_site = $request->id_site;
    
            foreach($requisionesCat as $item) {
    
                switch($item->id_requisition_cat) {
                    case 1:
                        ((isset($request['check'.$item->id_requisition_cat]))? $objRequisition->bool_ins_elec = true : $objRequisition->bool_ins_elec = false);
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
                    for($i = 1; $i < sizeof($requisionesCat); $i++) {                        
                        for($j = 0; $i < sizeof($request['cantidad'].$i); $i++) {
                            if(isset($request['cantidad'.$i][$j])) {
                                $objData                    = new RequisitionData();
                                $objData->id_requisition    = $objRequisition->id_requisition;
                                $objData->quantity          = $request['cantidad'.$i][$j];
                                $objData->part_number       = $request['n_parte'.$i][$j];
                                $objData->description       = $request['descripcion'.$i][$j];
                                $objData->price             = $request['precio'.$i][$j];
                                $objData->id_requisition_cat = $i;
    
                                try {
                                    $objData->create();
                                } catch(Exception $exception) { $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']); }
                            }
                        }
                    }
                } else {
                    $objReturn->setResult(false, Errors::REQUISICIONES_CREATE_01_TITLE, Errors::REQUISICIONES_CREATE_01_MESSAGE);
                }
            } catch(Exception $exception) { $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']); }

            return $objReturn->getRedirectPath();
        }

    }

