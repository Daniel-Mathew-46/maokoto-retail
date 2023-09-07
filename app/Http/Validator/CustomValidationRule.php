<?php
/**
 * Created by PhpStorm.
 * User: sitta
 * Date: 6/13/18
 * Time: 2:48 PM
 */

namespace App\Http\Validator;


use App\Lib\GlobalMethods;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

class CustomValidationRule extends Validator
{
    public function validatePhone($attribute, $value, $parameters)
    {
        return ((strlen(trim(GlobalMethods::removeSpecialCharactersFromInteger($value)))==10&&substr(trim(GlobalMethods::removeSpecialCharactersFromInteger($value)),0,1)==0) ? 1 : 0);
    }
    public function validateMobile($attribute, $value, $parameters)
    {
        return preg_match("/^\+?\d[0-9-]{9,12}/", $value);
    }

    public function validateCsv($attribute, $value, $parameters)
    {

        return preg_match("/[A-Za-z0-9\s]+(,[A-Za-z0-9\s]+)*[A-Za-z0-9]$/", $value);
    }

    public function validateMonthYear($attribute, $value, $parameters)
    {
        return preg_match("/^(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sept|Oct|Nov|Dec)-[0-9]{4}$/i", $value);
    }

    public function validateAlphaSpaces($attribute, $value, $parameters)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
    public function validateFileExtension($attribute, $value, $parameters){
        $fileExtension=Input::file('xlsxFile')->getClientOriginalExtension();
        return ((!blank($fileExtension)&&$fileExtension=='xlsx')?1:0);
    }
    
    public function validateOnlyPositive($attribute, $value, $parameters)
    {
        return (is_numeric($value)&&$value>0)?1:0;

    }

}