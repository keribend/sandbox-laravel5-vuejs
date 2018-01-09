<?php

namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Car extends Model {
	protected $fillable = ['model'];

    public $errors;

    private static $validationRules = [
        'model' => 'string|required',
    ];

    public function isValid() {
        $validator = Validator::make($this->attributes, self::$validationRules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public function pollingexecution() {
        return $this->belongsTo('App\PollingExecution');
    }
}
