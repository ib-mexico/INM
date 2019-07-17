<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Entity extends Model
{
    protected $table = 'entities';
    protected $primaryKey = 'id_entity';

    protected $fillable = ['entity', 'created_at'];

    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['id_entity'] === null) {
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
