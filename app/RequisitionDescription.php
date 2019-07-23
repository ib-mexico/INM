<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionDescription extends Model
{
    public $timestamps = false;
    protected $fillable = ['description', 'created_at'];

    /* RELATIONSHIPS - BEGIN */
    public function requisitions() {
        return $this->hasMany(Requisition::class);
    }
     /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_requisition_description'] === null) {
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
