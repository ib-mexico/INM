<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionMedia extends Model
{
    protected $table = 'requisition_media';
    protected $primaryKey = 'id_requisition_media';

    protected $fillable = [
        'description', 'url', 'created_at', 'created_id_user'
    ];

    /* RELATIONSHIPS - BEGIN */
    public function user() {
        return $this->belongsTo('App\User', 'id_user', 'created_id_user');
    }
    /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_requisition_media'] === null) {
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
