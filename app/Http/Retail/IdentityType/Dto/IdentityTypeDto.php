<?php
namespace App\Http\Retail\IdentityType\Dto;

/**
 * Created by PhpStorm.
 * User: Hamza Kt.
 * Date: 13/12/21
 * Time: 3:48 PM
 */
/**
 * This Class Transfer Currency Data
 *
 *
 */
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

class IdentityTypeDto
{
    use HasAttributes;

    /**
     * @return mixed
     */
    public function getIdentityTypeDto($IdTypId,$IdTypCode,$IdTypNm)
    {
        $this->attributes = [];
        $this->attributes['IdTypId'] = $IdTypId;
        $this->attributes['IdTypCode'] = $IdTypCode;
        $this->attributes['IdTypNm'] = $IdTypNm;
        return $this->attributes;
    }


    /**
     * @return mixed
     */
    public function getIdTypId()
    {
        return $this->attributes['IdTypId'];
    }

    /**
     * @param mixed $IdTypId
     */
    public function setIdTypId($IdTypId): void
    {
        $this->attributes['IdTypId'] = $IdTypId;
    }

    /**
     * @return mixed
     */
    public function getIdTypCode()
    {
        return $this->attributes['IdTypCode'];
    }

    /**
     * @param mixed $IdTypCode
     */
    public function setIdTypCode($IdTypCode): void
    {
        $this->attributes['IdTypCode'] = $IdTypCode;
    }

    /**
     * @return mixed
     */
    public function getIdTypNm()
    {
        return $this->attributes['IdTypNm'];
    }

    /**
     * @param mixed $IdTypNm
     */
    public function setIdTypNm($IdTypNm): void
    {
        $this->attributes['IdTypNm'] = $IdTypNm;
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