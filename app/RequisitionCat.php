<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RequisitionCat extends Model
{
    protected $table = 'requisition_cats';
    protected $primaryKey = 'id_requisition_cat';

    protected $fillable = ['name', 'created_at'];

    /* RELATIONSHIPS - BEGIN */
    public function requisitionData() {
        return $this->hasMany('App\RequisitionData', 'id_requisition_cat', 'id_requisition_cat');
    }
    /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_requisition_cat'] === null) {
            $this['created_at'] = date('Y-m-d H:i:s');
            return parent::save($options);
        } else {
            return false;
        }
    }

    public function update(array $attributes = array(), array $options = array()) {
        return save($options);
    }

    public function delete() {
        return false;
    }
}
