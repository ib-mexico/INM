<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $table = 'requisitions';
    protected $primaryKey = 'id_requisition';

    protected $fillable = [
        'bool_ins_elec', 'bool_ins_phy_earth', 'bool_ins_grounding', 'bool_ins_lighting', 'bool_ins_supressor_A',
        'bool_ins_supressor_B', 'created_at'
    ];

    /* RELATIONSHIPS - BEGIN */
    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function entity() {
        return $this->belongsTo('\App\Entity', 'id_entity');
    }

    public function requisitionData() {
        return $this->hasMany('\App\RequisitionData', 'id_requisition');
    }
    /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_requisition'] === null) {
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
