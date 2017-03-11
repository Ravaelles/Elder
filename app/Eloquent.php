<?php

namespace App;

use Carbon\Carbon;
//use Jenssegers\Mongodb\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Eloquent extends Moloquent {

    /**
     * Auxiliary constant that allows to static access.
     */
    const PRIMARY_KEY_NAME = '_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    // =========================================================================

    /**
     * Returns name of the primary key.
     * @return string 
     */
    public static function primaryKey() {
        return self::PRIMARY_KEY_NAME;
    }

    // =========================================================================

    public function get($field) {
        return $this->$field;
    }

    public function set($field, $value) {
        return $this->$field = $value;
    }

    public function getOrSet($field, $value = null, $type = null) {
        if ($value === null) {
            return $this->$field;
        } else {
            if ($type === 'int') {
                $value = (int) $value;
            }
            return $this->$field = $value;
        }
    }

    // =========================================================================

    /**
     * Returns ID of this model.
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Returns <b>name</b> of the primary key.
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

}
