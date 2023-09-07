<?php namespace App\Lib;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class Signature
 * @package App\Lib
 */
class Signature
{

    /**
     * @author Chuma Sitta
     * @param $keyPass
     * @param $keyAlias
     * @param $keyFilePath
     * @return string
     */
    function getPrivateKey($keyPass, $keyAlias, $keyFilePath)
    {
        $privateKey = "";
        try {
            if (!$cert_store = file_get_contents($keyFilePath)) {
                Log::error("Error: Unable to read the cert file\n");
                exit;
            } else {
                if (!empty($keyAlias)) {
                    if (openssl_pkcs12_read($cert_store, $cert_info, $keyPass)) {
                        $privateKey = $cert_info['pkey'];
                    }
                }
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $privateKey;

    }


    /**
     * @author Chuma Sitta
     * @param $content
     * @param $privateKeyPass
     * @param $privateKeyAlias
     * @param $privateKeyFilePath
     * @param $encryptAlg
     * @return string
     */
    function createSignature($content, $privateKeyPass, $privateKeyAlias, $privateKeyFilePath, $encryptAlg)
    {
        $signature = "";
        try {
            $privateKey = $this->getPrivateKey($privateKeyPass, $privateKeyAlias, $privateKeyFilePath);
            if (!empty($privateKey) && !empty($content)) {
                openssl_sign($content, $signature, $privateKey, $encryptAlg);
                $signature = base64_encode($signature);
            }
        } catch (Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $signature;
    }

    /**
     * @author Chuma Sitta
     * @param $keyPass
     * @param $keyAlias
     * @param $keyFilePath
     * @return string
     */
    function getPublicKey($keyPass, $keyAlias, $keyFilePath)
    {

        $publicKey = "";

        try {
            if (!$publicKeyCertStore = file_get_contents($keyFilePath)) {
                Log::error("Error: Unable to read the cert file\n");
                exit;
            } else {
                if (!empty($keyPass)) {
                    //Read Certificate
                    if (openssl_pkcs12_read($publicKeyCertStore, $publicKeyCertInfo, $keyPass)) {
                        $publicKey = $publicKeyCertInfo['extracerts']['0'];
                    }
                }
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $publicKey;

    }

    /**
     * @author Chuma Sitta
     * @param $signature
     * @param $content
     * @param $publicKeyPass
     * @param $publicKeyAlias
     * @param $publicKeyFilePath
     * @param $encryptAlg
     * @return bool
     */
    function verifySignature($signature, $content, $publicKeyPass, $publicKeyAlias, $publicKeyFilePath, $encryptAlg)
    {

        $t = FALSE;
        $publicKey = $this->getPublicKey($publicKeyPass, $publicKeyAlias, $publicKeyFilePath);

        if (!empty($publicKey) && !empty($content)) {
            try {
                $rawSignature = base64_decode($signature);
                $status = openssl_verify($content, $rawSignature, $publicKey, $encryptAlg);
                Log::error("SignatureVerification:  " . $status);
                $t = ($status == 1) ? TRUE : FALSE;
            } catch (Exception $e) {
                Log::error($e->getMessage());
                Log::error($encryptAlg);
            }
        }

        return $t;
    }



}