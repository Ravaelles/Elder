<?php

namespace App;

use Carbon\Carbon;
use Jenssegers\Mongodb\Model as Moloquent;

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

    /**
     * Converts MongoDate value as in $this[$fieldName] into either Carbon date or into string.
     * @param string $fieldName name of the field to convert in $this context e.g. 'created_at'
     * @param string $format if null, then Carbon date object is returned. If non-empty string is passed
     * then date is formatted and string is returned
     * @return object Carbon date or date string with given format
     */
//    public function getMongoDate($fieldName, $format = null) {
//
//        // If attribute is unset, avoid exception, return null.
//        if (empty($this->getAttributes()[$fieldName])) {
////            abort(500, 'No date found for object');
//            return null;
//        }
//
//        // Create Carbon date
//        $carbonDate = Carbon::createFromTimestamp($this->getAttributes()[$fieldName]->sec);
//
//        // Check whether return date or format as string.
//        if (empty($format)) {
//            return $carbonDate;
//        } else {
//            return $carbonDate->format($format);
//        }
//    }

    /**
     * Returns date of last modification of this record.
     * @return Carbon
     */
//    public function createdAt() {
//        return $this->getMongoDate('created_at');
//    }
//
//    /**
//     * Returns date of last modification of this record.
//     * @return Carbon
//     */
//    public function lastUpdated() {
//        return $this->getMongoDate('updated_at');
//    }
//
//    /**
//     * Returns date of creation of this record.
//     * @return Carbon
//     */
//    public function updatedAt() {
//        return $this->getMongoDate('updated_at');
//    }
//    
    // =========================================================================
    // Accessors & Mutators

    /**
     * Accessor for created_at.
     */
//    public function getCreatedAtAttribute($value) {
//        return $this->getMongoDate('created_at')->format('Y-m-d h:i:s A');
//    }
}
