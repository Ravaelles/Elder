<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract,
                                    CanResetPasswordContract
 {

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    const ROLE_ADMIN = "Admin";
    const ROLE_USER = "User";
    const DEFAULT_IMAGE = "/img/critter/animated/elder.gif";

    // =========================================================================

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Fields that allow to be sorted by.
     */
    protected $sortable = [
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * Determines how dates concerning this model are displayed.
     *
     * @var string
     */
    protected $dateFormat = 'd M Y';

    // =========================================================================
    // Custom functions

    /**
     * Returns date when user has registered.
     */
    public function registered() {
//        return $this->getMongoDate('created_at', $this->dateFormat);
        return $this->created_at->format($this->dateFormat);
    }

    /**
     * Mutator for password field
     * @EDIT: It's possible that it's going to affect password reminders etc, so this approach is NOT used.
     * The moment we change password, only then it takes effect.
     */
//    public function setPasswordAttribute($value) {
//        $this->attributes['password'] = \Hash::make($value);
//    }

    /**
     * @return boolean returns <b>true</b> if this User model is the user we logged in as.
     */
    public function isLoggedUser() {
        $authUser = \Auth::user();
        if (!empty($authUser) && $authUser->id == $this->id) {
            return true;
        }
        return false;
    }

    /**
     * @return true if user has admin role.
     */
    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    // =========================================================================
    // Accessors & Mutators

    public function getRoleAttribute($value) {
        if (empty($value)) {
            return self::ROLE_USER;
        } else {
            return $value;
        }
    }

    public function getCritterImageAttribute($value) {
        if (empty($value)) {
            return self::DEFAULT_IMAGE;
        } else {
            return $value;
        }
    }

    // =========================================================================
    // Relations

    public function agreements() {
        return $this->hasMany(\App\Agreement::class);
    }

}
