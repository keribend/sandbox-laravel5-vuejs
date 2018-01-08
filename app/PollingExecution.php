<?php

namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;

class PollingExecution extends Model
{
    protected $fillable = [
        'age',
        'gender',
        'drivingLicenseOwned',
        'drivetrain',
        'drifting',
    ];

    public $errors;

    private static $validationRules = [
        'age' => 'numeric|required',
        'gender' => 'string|required',
        'drivingLicenseOwned' => 'boolean|required',
        'drivetrain' => 'string|nullable',
        'drifting' => 'boolean|nullable',
    ];

    public function isValid() {
        $validator = Validator::make($this->attributes, self::$validationRules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
