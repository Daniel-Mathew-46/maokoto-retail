<?php

use Illuminate\Support\Facades\Route;
//example.com/employees
Route::group(['namespace' => 'IdentityType\Api', 'prefix' => 'identity-type'], function () {
    //CREATE/INSERT
    Route::post('/', 'IdentityTypeApi@createIdentityType');
    //GET — Read
    Route::get('/{identityTypeId}', 'IdentityTypeApi@getIdentityTypeByIdentityTypeId');
//    UPDATE
    Route::put('/{identityTpeId}', 'IdentityTypeApi@updateIdentityTypeByIdentityTypeId');
    //DELETE
    Route::delete('/{identityTpeId}', 'IdentityTypeApi@deleteIdentityTypeByIdentityTypeId');

});



