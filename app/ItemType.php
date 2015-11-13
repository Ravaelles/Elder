<?php namespace App;

use App\Eloquent as Model;

class ItemType extends Model
{
    
	public $table = "itemTypes";
    

	public $fillable = [
	    "name",
		"description",
		"base_value",
		"image",
		"dmg_low",
		"dmg_hi",
		"item_type"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "name" => "string",
		"description" => "string",
		"base_value" => "string",
		"image" => "string",
		"item_type" => "string"
    ];

	public static $rules = [
	    "name" => "required",
		"base_value" => "required|numeric",
		"image" => "required",
		"dmg_low" => "sometimes|numeric",
		"dmg_hi" => "sometimes|numeric",
		"item_type" => "required"
	];

}
