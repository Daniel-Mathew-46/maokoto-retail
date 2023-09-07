<?php

namespace App\Http\Retail\IdentityType\Dao;

use App\Http\Retail\IdentityType\Dto\IdentityTypeDto;
use App\Http\Retail\IdentityType\Model\IdentityType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * This Class Controls Currency Datastore
 * @author Hamza Kt.
 * Email:khalfanthamza@gmail.com
 * 28/12/2021
 *
 */
class IdentityTypeDaoImpl implements IdentityTypeDao
{
    /**
     * @param IdentityTypeDto $identityTypeDto
     * @return IdentityType|null
     * @author chuma sitta
     */
    public function createIdentityType(IdentityTypeDto $identityTypeDto)
    {
        $identityType = null;
        try {
            $identityType = new IdentityType();

            $identityType->setIdentityTypeCode($identityTypeDto->getIdTypCode());
            $identityType->setIdentityTypeName($identityTypeDto->getIdTypNm());
            $identityType->save();

        } catch (\Exception $exception) {
            Log::error('IdentityTypeException:' . $exception->getMessage());
        }
        return $identityType;
    }

    /**
     * @param $identityTypeCode
     * @return IdentityType|null
     */
    public function getIdentityTypeByIdentityTypeCode($identityTypeCode)
    {
        $identityType = null;
        try {
            $identityType = new IdentityType();
            $identityTypeExistInfo = DB::table('SetNot_IdentityType')->where('IdentityTypeCode', '=', $identityTypeCode)->get();

            if (!blank($identityTypeExistInfo)) {
                $identityTypeExistInfoArray = json_decode(json_encode($identityTypeExistInfo), true);
                $identityType->setAttributes($identityTypeExistInfoArray);
            } else {
                $identityType = null;
            }
        } catch (\Exception $exception) {
            Log::error('IdentityTypeException:' . $exception->getMessage());
        }
        return $identityType;
    }


    /**
     * @param $identityTypeCode
     * @param $identityTypeName
     * @return IdentityType|null
     */
    public function getIdentityTypeByIdentityTypeCodeOrIdentityTypeName($identityTypeCode, $identityTypeName)
    {
        $identityType = null;
        try {
            $identityType = new IdentityType();

            $sql = "SELECT * FROM \"SetNot_IdentityType\" WHERE \"IdentityTypeCode\"='" . $identityTypeCode . "' OR \"IdentityTypeName\"='" . $identityTypeName . "'";
            $identityTypeExistInfo = DB::select(DB::raw($sql));
            if (!blank($identityTypeExistInfo)) {
                $identityTypeExistInfoArray = json_decode(json_encode($identityTypeExistInfo), true);
                $identityType->setAttributes($identityTypeExistInfoArray);
            } else {
                $identityType = null;
            }
        } catch (\Exception $exception) {
            Log::error('IdentityTypeException:' . $exception->getMessage());
        }
        return $identityType;
    }

    /**
     * @param $identityTypeId
     * @return IdentityType|null
     */
    public function getIdentityTypeByIdentityTypeId($identityTypeId)
    {
        $identityType = null;
        try {
            $identityType = new IdentityType();
            $identityTypeExistInfo = DB::table('SetNot_IdentityType')->where('IdentityTypeId', '=', $identityTypeId)->get();
            if (!blank($identityTypeExistInfo)) {
                $identityTypeExistInfoArray = json_decode(json_encode($identityTypeExistInfo), true);
                $identityType->setAttributes($identityTypeExistInfoArray[0]);
            } else {
                $identityType = null;
            }
        } catch (\Exception $exception) {
            Log::error('IdentityTypeException:' . $exception->getMessage());
        }
        return $identityType;
    }


}