<?php
namespace App\Http\Retail\IdentityType\Dao;



use App\Http\Retail\IdentityType\Dto\IdentityTypeDto;

/**
 * This interface Access IdentityType Data
 * @author Hamza Kt.
 *
 */

interface IdentityTypeDao
{
    public function createIdentityType(IdentityTypeDto $identityTypeDto);
    public function getIdentityTypeByIdentityTypeCode($IdentityTypeCode);
    public function getIdentityTypeByIdentityTypeCodeOrIdentityTypeName($IdentityTypeCode,$identityTypeName);

    public function getIdentityTypeByIdentityTypeId($identityTypeId);



}