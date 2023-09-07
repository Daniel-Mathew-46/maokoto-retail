<?php

namespace App\Http\Retail\IdentityType\Api;

use App\Http\Retail\Controller;
use App\Http\Retail\IdentityType\Dao\IdentityTypeDaoImpl;
use App\Http\Retail\IdentityType\Dto\IdentityTypeDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * This Class Controls Currency
 * @author Hamza Kt.
 * Email:khalfanthamza@gmail.com
 * 28/12/2021
 *
 */

/**
 * Currency API controller
 */
class IdentityTypeApi extends Controller
{
    private $identityTypeDao = null;

    /**
     * CurrencyController constructor.
     */
    public function __construct()
    {
        $this->identityTypeDao = new IdentityTypeDaoImpl();

    }


    /**
     * Display a listing of currencies.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createIdentityType(Request $request)
    {

        try {
            $identityTypeDto = new IdentityTypeDto();
            $identityTypeDto->setAttributes($request->all());
            Log::info("OriginalMessage:: " . $identityTypeDto->getIdTypNm());

            //LARAVEL VALIDATION

            $identityTypeExist = $this->identityTypeDao->getIdentityTypeByIdentityTypeCodeOrIdentityTypeName($identityTypeDto->getIdTypCode(), $identityTypeDto->getIdTypNm());
            if (blank($identityTypeExist)) {
                $identityType = $this->identityTypeDao->createIdentityType($identityTypeDto);
                if (!blank($identityType)) {
                    return Response()->json(["error" => false, 'message' => ['OK']], Response::HTTP_OK);
                }
                return Response()->json(["error" => true, 'message' => ['FAILED']], Response::HTTP_BAD_REQUEST);
            }
            return Response()->json(["error" => true, 'message' => ['Identity type exists']], Response::HTTP_BAD_REQUEST);

        } catch (\Exception $exception) {
            Log::info("ExceptionMessage:: " . $exception->getMessage());
            return Response()->json(["error" => true, 'message' => ['FAILED']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display a listing of identityType.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * http://localhost/maokoto-retail-service-6/api/identity-type/1
     */
    public function getIdentityTypeByIdentityTypeId(Request $request, $identityTypeId)
    {
        try {

            $identityTypeExist = $this->identityTypeDao->getIdentityTypeByIdentityTypeId($identityTypeId);

            Log::info("OriginMessage:" . gettype($identityTypeExist));
            if (!blank($identityTypeExist->getAttributes())) {
                $identityTypeDto = new IdentityTypeDto();
                $identityTypeArray = $identityTypeDto->getIdentityTypeDto($identityTypeExist->getIdentityTypeId(), $identityTypeExist->getIdentityTypeCode(), $identityTypeExist->getIdentityTypeName());
                $identityTypeDto->setAttributes($identityTypeArray);
                return Response()->json(["error" => false, 'IdTypDtl' => $identityTypeDto->getAttributes()], Response::HTTP_OK);
            }
            return Response()->json(["error" => true, 'message' => ['FAILED']], Response::HTTP_BAD_REQUEST);

        } catch (\Exception $exception) {
            Log::info("ExceptionMessage:: " . $exception->getMessage());
            return Response()->json(["error" => true, 'message' => ['FAILED']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
