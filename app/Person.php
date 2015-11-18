<?php

namespace App;

use App\Helpers\Image as Image;
use App\Critter as Critter;
use App\SPECIAL;
use Illuminate\Database\Eloquent\Model;

class Person extends Eloquent {

    protected $sortable = [
        'strength'
    ];

    // =========================================================================
    // Generator

    public static function generateAndSave() {
        $special = SPECIAL::generateSpecialForTribesman();

        $person = new Person;
        $person->user = \Auth::user()->id;
        $person->save();
        $person->SPECIAL()->save($special);

        return $person;
    }

    // =========================================================================
    // Custom functions
    // =========================================================================
    // Scopes

    public function scopeOur($query) {
        return $query->where('user', \Auth::user()->id);
    }

    // =========================================================================
    // Accessors & Mutators

    public function getImageAttribute($value) {
        return Image::create()->warrior()->actionRandomStatic();
//        return Image::gifFor(
//                Critter::WARRIOR, Critter::ACTION_RANDOM_STATIC, Critter::DIR_SE
//        );
    }

    // =========================================================================
    // Relations

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function SPECIAL() {
        return $this->embedsOne(\App\SPECIAL::class);
//        return $this->hasOne(\App\SPECIAL::class);
    }

}
