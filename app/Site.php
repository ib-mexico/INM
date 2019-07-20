<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Site extends Model
{
    protected $table = 'sites';
    protected $primaryKey = 'id_site';

    protected $fillable = ['name', 'latitute', 'longitude', 'created_at'];

    /* RELATIONSHIPS - BEGIN */
    public function state() {
        return $this->belongsTo('App\State', 'id_state', 'id_state');
    }
    /* RELATIONSHIPS - END */

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_site'] === null) {
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
