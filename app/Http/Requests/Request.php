<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
 {

    /**
     * Auxiliary function that will exclude special fields like '_token', '_method' etc. 
     * So it alwats returns the actual input fields that should be inserted into model.
     * @return array
     */
    public function getValidInputs() {
        return $this->getValidInputsExcept();
    }

    /**
     * Auxiliary function that will exclude special fields like '_token', '_method' etc. 
     * So it alwats returns the actual input fields that should be inserted into model.
     * @return array
     */
    public function getValidInputsExcept($except = []) {
        $except = array_merge($except, ['_token', '_method', '_redirect_url']);
        return $this->except($except);
    }

}
