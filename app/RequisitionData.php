<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionData extends Model
{
    protected $table = 'requisition_data';
    protected $primaryKey = 'id_requisition_data';
    public $timestamps = false;

    protected $fillable = [
        'quantity', 'part_number', 'description', 'price', 'created_at', 'id_requisition_cat'
    ];

    /* RELATIONSHIPS - BEGIN */
    public function requisitionCat() {
        return $this->belongsTo('App\RequisitionCat', 'id_requisition_cat', 'id_requisition_cat');
    }
    /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_requisition_data'] === null) {
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
