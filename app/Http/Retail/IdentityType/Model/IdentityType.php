<?php
namespace App\Http\Retail\IdentityType\Model;

/**
 * Created by PhpStorm.
 * User: Hamza Kt.
 * Date: 13/12/21
 * Time: 1:43 PM
 */

use Illuminate\Database\Eloquent\Model;

class IdentityType extends Model
{
    public $table = 'SetNot_IdentityType';
    public $timestamps = false;
    public $primaryKey = 'IdentityTypeId';

    /**
     * @return mixed
     */
    public function getIdentityTypeId()
    {
        return $this->attributes['IdentityTypeId'];
    }

    /**
     * @param mixed $IdentityTypeId
     */
    public function setIdentityTypeId($IdentityTypeId): void
    {
        $this->attributes['IdentityTypeId'] = $IdentityTypeId;
    }

    /**
     * @return mixed
     */
    public function getIdentityTypeName()
    {
        return $this->attributes['IdentityTypeName'];
    }

    /**
     * @param mixed $IdentityTypeName
     */
    public function setIdentityTypeName($IdentityTypeName): void
    {
        $this->attributes['IdentityTypeName'] = $IdentityTypeName;
    }

    /**
     * @return mixed
     */
    public function getIdentityTypeCode()
    {
        return $this->attributes['IdentityTypeCode'];
    }

    /**
     * @param mixed $IdentityTypeCode
     */
    public function setIdentityTypeCode($IdentityTypeCode): void
    {
        $this->attributes['IdentityTypeCode'] = $IdentityTypeCode;
    }



    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }


}