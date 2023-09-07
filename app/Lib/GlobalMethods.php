<?php

namespace App\Lib;

use App\Http\Retail\Permission\Dto\PermissionDto;
use App\Http\Retail\System\Dto\MaintenanceHeadDto;
use App\Http\Retail\System\Dto\MaintenanceInfDto;
use App\Http\Retail\System\Dto\SystemMaintenanceWrapperDto;
use App\Http\Retail\TransactionDate\Dto\TransactionDateDto;
use App\Http\Retail\User\Dto\UserDto;
use Bschmitt\Amqp\Amqp;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire;

/**
 * Class GlobalMethods
 * @package App\Lib
 */
class GlobalMethods
{
    /**
     * @author chuma sitta
     * @param $content
     * @return mixed
     */
    public static function removeSpecialCharacter($content)
    {
        $result = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $content);
        return $result;
    }

    /**
     * @author chuma sitta
     * @param $integers
     * @return mixed
     */
    public static function removeSpecialCharactersFromInteger($integers)
    {

        $integer = preg_replace("/[^0-9]/", "", $integers);
        return $integer;
    }

    /**
     * @author chuma sitta
     * @return false|string
     */
    public static function generateLoggerId()
    {
        $loggerId = "";
        try {
            $loggerId = Carbon::now()->format('YmdHisu');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $loggerId;
    }

    /**
     * @author chuma sitta
     * @return false|string
     */
    public static function generateToken()
    {
        return $token = strtoupper(uniqid()) . sprintf("%03s", rand(10, 1000)) . sprintf("%02s", Carbon::now()->format('H')) . sprintf("%03s", Carbon::now()->dayOfYear) . sprintf("%02s", substr(Carbon::now()->format('Y'), -2)) . sprintf("%09s", Carbon::now()->format('isu'));

    }

    /**
     * @author chuma sitta
     * @param $inputContent
     * @return false|string
     */
    public static function generateTokenByInputContent($inputContent)
    {
        $token = $inputContent . uniqid() . sprintf("%03s", rand(10, 1000)) . sprintf("%02s", Carbon::now()->format('H')) . sprintf("%03s", Carbon::now()->dayOfYear) . sprintf("%02s", substr(Carbon::now()->format('Y'), -2)) . sprintf("%09s", Carbon::now()->format('isu'));
        return strtoupper(hash('SHA256', $token));
    }


    /**
     * @author chuma sitta
     * @param $inputContent
     * @return false|string
     */
    public static function generateHashByInputContent($inputContent)
    {
        return strtoupper(hash('SHA256', $inputContent));
    }

    /**
     * This method validate incoming xml against given xsd
     * @param $xsdFilePath
     * @param $xmlContent
     * @return bool
     * @author Chuma Sitta
     */
    public static function validateXMLSchemaNew($xsdFilePath, $xmlContent)
    {
        $isValid = FALSE;
        try {
            Log::info("XMLSchemaToValidate:: " . $xmlContent);
            if (is_file($xsdFilePath) && !empty($xmlContent)) {
                $xsdFormat = file_get_contents($xsdFilePath);
                libxml_use_internal_errors(true);
                $xml = new DOMDocument('1.0', 'utf-8');
                $xml->loadXML($xmlContent);
                $errors = libxml_get_errors();
                libxml_clear_errors();
                if (empty($errors)) {
                    if ($xml->schemaValidateSource($xsdFormat)) {
                        $isValid = TRUE;
                    }
                }

            }
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $isValid;
    }

    /**
     * This method validate incoming xml against given xsd
     * @param $xsdFilePath
     * @param $xmlContent
     * @return bool
     * @author Chuma Sitta
     */
    public static function validateXMLSchema ($xsdFilePath, $xmlContent)
    {
        $isValid = FALSE;
        try {
            Log::info("XmlSchemaToValidate:: " . $xmlContent);

            if (is_file($xsdFilePath) && !empty($xmlContent)) {
                $xsdFormat = file_get_contents($xsdFilePath);
                $xml = new DOMDocument();
                $xml->loadXML(trim(utf8_encode($xmlContent)));
                if ($xml->schemaValidateSource($xsdFormat)) {
                    $isValid = TRUE;
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $isValid;
    }

    /**
     * @param string $xmlFilename Path to the XML file
     * @param string $version 1.0
     * @param string $encoding utf-8
     * @return bool
     */
    public function isXMLFileValid($xmlFilename, $version = '1.0', $encoding = 'utf-8')
    {
        $xmlContent = file_get_contents($xmlFilename);
        return $this->isXMLContentValid($xmlContent, $version, $encoding);
    }

    /**
     * @param string $xmlContent A well-formed XML string
     * @param string $version 1.0
     * @param string $encoding utf-8
     * @return bool
     */
    public function isXMLContentValid($xmlContent, $version = '1.0', $encoding = 'utf-8')
    {
        if (trim($xmlContent) == '') {
            return false;
        }

        libxml_use_internal_errors(true);

        $doc = new DOMDocument($version, $encoding);
        $doc->loadXML($xmlContent);

        $errors = libxml_get_errors();
        libxml_clear_errors();

        return empty($errors);
    }

    /**
     * @author Chuma Sitta
     *  This method get content from xml string with xmlTax inclusively tag
     * @param inputContent
     * @param xmlTag
     * @return
     */
    public static function getDataStringFromXml($inputContent, $xmlTag)
    {

        $data = "";
        try {
            $startPosition = strpos($inputContent, $xmlTag);
            $endPosition = strrpos($inputContent, $xmlTag);
            $data = substr($inputContent, $startPosition - 1, $endPosition + strlen($xmlTag) + 2 - $startPosition);
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $data;
    }

    /**
     * This method validate incoming xml against given xsd
     * @author Chuma Sitta
     * @param $filePath
     * @param $fileContent
     * @return bool
     */
    public static function loadFile($filePath)
    {
        $fileContent = null;
        try {

            if (is_file($filePath)) {
                $fileContent = file_get_contents($filePath);
            }
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $fileContent;
    }

    /**
     * @author Chuma Sitta
     * @param $fullFilePath
     * @return bool
     */
    public static function isFileExist($fullFilePath)
    {
        $result = FALSE;
        try {
            if ($fullFilePath != "") {
                if (file_exists($fullFilePath)) {
                    $result = TRUE;
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $result;
    }

    /**
     * @author Chuma Sitta
     *  This validate variable if it has got content
     * @param xmlContent
     * @return
     */
    public static function isNullOREmptyString($inputString)
    {
        $result = false;

        if (empty($inputString) || is_null($inputString)) {
            $result = true;
        }

        return $result;
    }


    /**
     * @author chuma sitta
     * @param $xmlContent
     * @param $generatedSignature
     * @return string
     */


    public static function finalRetailXmlContent($xmlContent, $generatedSignature)
    {
        $xml = '';
        try {
            $xml .= '<eRtl>' . $xmlContent . '<eRtlSignature>' . $generatedSignature . '</eRtlSignature></eRtl>';
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $xml;
    }


    /**
     * @author Chuma Sitta
     * @param $contentPublished
     * @param $routingKey
     * @param $exchangeName
     * @return bool
     */
    public static function publishToExchange($contentPublished, $routingKey, $exchangeName)
    {
        $status = FALSE;
        $host = config('retail.rabbitmq.host');
        $port = config('retail.rabbitmq.port');
        $username = config('retail.rabbitmq.username');
        $password = config('retail.rabbitmq.password');
        $virtualHost = config('retail.rabbitmq.virtualhost');
        try {
            $connection = new AMQPStreamConnection($host, $port, $username, $password, $virtualHost);
            $channel = $connection->channel();
            $msg = new AMQPMessage($contentPublished);
            $channel->basic_publish($msg, $exchangeName, $routingKey);
            $channel->close();
            $connection->close();
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $status;
    }


    /**
     * @author Edward Kimaro
     * @param $contentPublished
     * @param $routingKey
     * @param $exchangeName
     * @return bool
     */
    public static function publishToExchangeAmq($contentPublished, $routingKey, $exchangeName)
    {
        $amq = new Amqp();
        $status = FALSE;
        try {
            $amq->publish($routingKey, $contentPublished, ['exchange' => $exchangeName, 'exchange_type' => 'topic']);
            $status = TRUE;
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $status;
    }

    /**
     * @return string
     */
    public static function generateRandomString()
    {
        $characters = env('CHARACTERS');
        $length = env('TOKEN_LENGTH');
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($index = 0; $index < $length; $index++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @param $contentPublished
     * @param $routingKey
     * @param $options
     * @return bool
     */
    public static function publishToExchangeOptions($contentPublished, $routingKey, $options)
    {
        $amq = new Amqp();
        $status = FALSE;
        try {
            $amq->publish($routingKey, $contentPublished, $options);
            $status = TRUE;
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $status;
    }

    /**
     * @author chuma Sitta
     * @param $contentPublished
     * @param $routingKey
     * @param $queueName
     * @return bool
     */
    public static function publishToQueueAmq($contentPublished, $routingKey, $queueName)
    {
        $amq = new Amqp();
        $status = FALSE;
        try {
            $amq->publish($routingKey, $contentPublished, ['queue' => $queueName]);
            $status = TRUE;
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }
        return $status;
    }

    /**
     * @author chuma Sitta
     * @param $contentPublished
     * @param $routingKey
     * @param $exchangeName
     * @param $header
     * @param $queueName
     * @return bool
     */
    public static function publishToExchangeWithHeadersAndQueue($contentPublished, $routingKey, $exchangeName, $header, $queueName)
    {
        $status = FALSE;
        $host = config('retail.rabbitmq.host');
        $port = config('retail.rabbitmq.port');
        $username = config('retail.rabbitmq.username');
        $password = config('retail.rabbitmq.password');
        $virtualHost = config('retail.rabbitmq.virtualhost');
        try {
            $connection = new AMQPStreamConnection($host, $port, $username, $password, $virtualHost);
            $channel = $connection->channel();
            $msgHeader = null;
            $msg = new AMQPMessage($contentPublished);
            if (is_array($header)) {
                if (!empty($header) || (!is_null($header))) {
                    foreach ($header as $key => $value) {
                        $msgHeader[$key] = $value;
                    }
                }
            }
            $headers = new Wire\AMQPTable($msgHeader);
            $msg->set('content_type', 'text/plain');
            $msg->set('delivery_mode', 2);
            $msg->set('application_headers', $headers);
            $channel->exchange_declare($exchangeName, 'topic', true, false, false);
            $channel->queue_declare($queueName, true, false, false, false);
            $channel->queue_bind($queueName, $exchangeName, $routingKey);
            $channel->basic_publish($msg, $exchangeName, $routingKey);
            $channel->close();
            $connection->close();
            $status = TRUE;
        } catch (\Exception $e) {
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
            self::processSystemMaintenance($contentPublished, $routingKey, $exchangeName, $header, $queueName);
        }
        return $status;
    }


    /**
     * @author chuma sitta
     * @param $contentPublished
     * @param $routingKey
     * @param $exchangeName
     * @param $header
     * @param $queueName
     */
    public static function processSystemMaintenance($contentPublished, $routingKey, $exchangeName, $header, $queueName)
    {
        $systemMaintenanceDto = new SystemMaintenanceWrapperDto();
        $mntInfDto = new MaintenanceInfDto();
        $mntHdDto = new MaintenanceHeadDto();
        $signatureHandler = new Signature();
        $spRetailKeyPrivateFilePath = resource_path() . Lang::get('retail.signature.spRetailKeyFilePath') . Lang::get('retail.signature.spRetailKeyPrivateFileName');
        $spRetailKeyPrivatePassPhrase = Lang::get('retail.signature.spRetailKeyPrivatePassPhrase');
        $spRetailPrivateAlias = Lang::get('retail.signature.spRetailPrivateAlias');
        try {

            $mntHdDto->setRKey($routingKey);
            $mntHdDto->setExNm($exchangeName);
            $mntHdDto->setQueNm($queueName);
            $mntHdDto->setHd($header);
            $mntInfDto->setMntHd(base64_encode(json_encode($mntHdDto->getAttributes())));
            $mntInfDto->setMntDtl(base64_encode($contentPublished));
            $systemMaintenanceDto->setMntInf($mntInfDto->getAttributes());
            $generatedSignature = $signatureHandler->createSignature(json_encode($systemMaintenanceDto->getMntInf()), $spRetailKeyPrivatePassPhrase, $spRetailPrivateAlias, $spRetailKeyPrivateFilePath, env('OPENSSL_ENCRYPTION_ALGO'));
            $systemMaintenanceDto->setSignature($generatedSignature);
            Log::channel("systemMaintenance")->info(bin2hex(base64_encode(json_encode($systemMaintenanceDto->getAttributes()))) . ";");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * @author chuma sitta
     * @param $content
     * @return mixed
     */
    public static function escapeSpecialCharacter($content)
    {
        $result = strtr($content, ["<" => "&lt;", ">" => "&gt;", '"' => "&quot;", "'" => "&apos;", "&" => "&amp;",]);
        return self::removeAllNonASCIICharacters($result);

    }
    //&lt;

    public static function removeAllNonASCIICharacters($string)
    {
        return $str = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
    }




    /**
     * @author chuma sitta
     * @param $url
     * @param $method
     * @param $contents
     * @param $headers
     * @return array
     */
    public static function connectToAnotherSystem($url, $method, $contents, $headers)
    {
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $contents);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_TIMEOUT, 50);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
            $resultCurlPost = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            if (blank($err)) {
                return ['error' => false, 'resultCurl' => $resultCurlPost];
            } else {
                Log::info("resultCurlErrors:" . $err);
                return ['error' => true, 'message' => [$err]];
            }
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
            return ['error' => true, 'message' => [$e->getMessage()]];
        }
    }


    /**
     * @author chuma Sitta
     * @param $finalSystemSetupReqXmlContent
     * @param $setupType
     * @param $version
     * @return bool
     */
    public static function validXmlSchemaSetupReqDetail($finalSystemSetupReqXmlContent, $setupType, $version)
    {

        $isValid = FALSE;
        $setupReqSpDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestSpDetail.xsd';
        $setupReqSubSpDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestSubSpDetail.xsd';
        $setupReqRetailCentDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestRetailCenterDetail.xsd';
        $setupReqExchangeRateDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestExchangeRateDetail.xsd';
        $setupReqDeviceDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestDeviceDetail.xsd';
        $setupReqDeviceModelDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestDeviceModelDetail.xsd';
        $setupReqRoleCategoryDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestRoleCategoryDetail.xsd';
        $setupReqPermissionCategoryDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestPermissionCategoryDetail.xsd';
        $setupReqPermissionDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestPermissionDetail.xsd';
        $setupReqRoleDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestRoleDetail.xsd';
        $setupReqUserDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestUserDetail.xsd';
        $setupReqPaymentTypeDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestPaymentTypeDetail.xsd';
        $setupReqAddressDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestAddressDetail.xsd';
        $setupReqCurrencyDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestCurrencyDetail.xsd';
        $setupReqDistrictDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestDistrictDetail.xsd';
        $setupReqRegionDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestRegionDetail.xsd';
        $setupReqIdentityTypeDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestIdentityTypeDetail.xsd';
        $setupReqItemTaxCodeDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestItemTaxCodeDetail.xsd';
        $setupReqCustomerDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestCustomerDetail.xsd';
        $setupReqSupplierDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestSupplierDetail.xsd';
        $setupReqEfdmsDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestEfdmsDetail.xsd';
        $setupReqItemDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestItemDetail.xsd';
        $setupReqPackageDtlXsdFilePath = resource_path() . '/xsd/system/version1/setupRequestPackageDetail.xsd';

        try {
            switch ($setupType) {
                case "SET001":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqSpDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET002":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqSubSpDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET003":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqRetailCentDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET004":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqExchangeRateDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET005":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqDeviceDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET006":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqDeviceModelDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET007":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqRoleCategoryDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET008":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqPermissionCategoryDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET009":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqPermissionDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET010":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqRoleDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET011":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqUserDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET012":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqPaymentTypeDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET013":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqAddressDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET014":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqCurrencyDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET015":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqDistrictDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET016":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqRegionDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET017":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqIdentityTypeDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET018":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqItemTaxCodeDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET019":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqCustomerDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET020":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqSupplierDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET021":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqEfdmsDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET022":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqItemDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
                case "SET023":
                    $isValid = (!blank($version) && $version == '1.0') ? GlobalMethods::validateXMLSchema($setupReqPackageDtlXsdFilePath, $finalSystemSetupReqXmlContent) : false;
                    break;
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $isValid;

    }

    /**
     * @author Chuma Sitta
     * @param UserDto $userDto
     */
    public static function processUserLogin(UserDto $userDto)
    {
        try {
            $userDto->setGenDt(preg_replace('/\s+/', 'T', Carbon::parse(Carbon::now())->format('Y-m-d H:i:s')));
            Log::channel("userLogin")->info(bin2hex(base64_encode(json_encode($userDto->getAttributes()))) . ";");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * @author Chuma Sitta
     * @param UserDto $userDto
     * @return string
     */

    public static function getAccessToken(UserDto $userDto)
    {
        $accessToken = $userDto->getSpRefNum() . ";" . $userDto->getSubSpRefNum() . ";" . $userDto->getRtlCentCode() . ";" . $userDto->getAccExp() . ";" . $userDto->getAccLock() . ";" . $userDto->getAccEn() . ";" . $userDto->getCredExp() . ";" . $userDto->getSpAdmin() . ";" . $userDto->getTopAdmin() . ";" . $userDto->getEmail() . ";" . $userDto->getUsrNm() . ";" . $userDto->getRoleNm() . ";" . $userDto->getStsCode();
        $encodeAccessTokenBase64 = base64_encode($accessToken . "+7");
        $accessTokenHashValue = hash('SHA256', $encodeAccessTokenBase64);
        return strtoupper(trim($accessTokenHashValue));

    }

    /**
     * @author Chuma Sitta
     * @param $permissionName
     * @param PermissionDto $permissionExistList
     * @return bool
     */
    public static function hasAnyAuthority($permissionName, PermissionDto $permissionExistList)
    {
        $permissionNameArray = explode(";", $permissionName);
        $s = array_intersect((array)$permissionNameArray, GlobalMethods::getUserPermissionName($permissionExistList));
        $isAllowed = (count($s) > 0) ? TRUE : FALSE;
        return $isAllowed;
    }


    /**
     * @author Chuma Sitta
     * @param PermissionDto $permissionDto
     * @return array
     */
    public static function getUserPermissionName(PermissionDto $permissionDto)
    {
        $permissionNameExist = [];
        try {
            foreach ($permissionDto->getAttributes() as $valuePermission) {
                $permissionDto->setAttributes($valuePermission);
                $permissionNameExist[] = trim($permissionDto->getPermNm());
            }
        } catch (\Exception $exception) {
            $permissionNameExist = [];
        }
        return $permissionNameExist;
    }

    /**
     * @author Chuma Sitta
     *  This method get content from signature tag
     * @param $inputContent
     * @param $tagValue
     * @return bool|string
     * @internal param $inputContent
     * @internal param $xmlSigTag
     */
    public static function getStringValueFromXmlTag($inputContent, $tagValue)
    {

        $gatValueData = "";

        try {
            $sigStartPosition = strpos($inputContent, $tagValue);
            $sigEndPosition = strrpos($inputContent, $tagValue);
            $gatValueData = substr($inputContent, $sigStartPosition + strlen($tagValue) + 1, $sigEndPosition - $sigStartPosition - strlen($tagValue) - 3);
        } catch (\Exception $e) {
            Log::error($e->getCode());
            Log::error($e->getFile());
            Log::error($e->getLine());
            Log::error($e->getMessage());
        }

        return $gatValueData;
    }

    /**
     * @author Chuma Sitta
     * @return string
     */
    public static function getCurrentDateTime()
    {
        return trim(preg_replace('/\s+/', 'T', Carbon::now()->format('Y-m-d H:i:s')));

    }

    /**
     * @author Chuma Sitta
     * @param $inputContent
     * @param $jsonField
     * @return null
     */
    public static function getStringWithJsonString($inputContent, $jsonField)
    {
        $finalContentJson = null;
        try {
            $pattern = '(?:"' . $jsonField . '":")(.*?)(?:")';
            preg_match('/' . $pattern . '/', $inputContent, $matches);
            $finalContentJson = $matches;

        } catch (\Exception $exception) {
            Log::error("ExtractStringException:: " . $exception->getMessage());
        }
        return $finalContentJson;
    }

    /**
     * @author Chuma Sitta
     * @param $inputContent
     * @param $jsonField
     * @return null
     */
    public static function getStringWithJsonArrayString($inputContent, $jsonField)
    {
        $finalContentJson = null;
        try {
            $pattern = '(?:\"' . $jsonField . '\":)(?:\[)(.*)(?:\"\])';
            preg_match('/' . $pattern . '/', $inputContent, $matches);
            $finalContentJson = $matches;

        } catch (\Exception $exception) {
            Log::error("ExtractStringException:: " . $exception->getMessage());
        }
        return $finalContentJson;
    }


    /**
     * @author Chuma Sitta
     * @param $inputContent
     * @param $jsonField
     * @return null
     */
    public static function getStringWithJsonObjectString($inputContent, $jsonField)
    {
        $finalContentJson = null;
        try {
            $pattern = '(?:\"' . $jsonField . '\":)(?:\{)(.*)(?:\"\})';
            preg_match('/' . $pattern . '/', $inputContent, $matches);
            $finalContentJson = $matches;

        } catch (\Exception $exception) {
            Log::error("ExtractStringException:: " . $exception->getMessage());
        }
        return $finalContentJson;
    }

    /**
     * @author Chuma Sitta
     * @param $inputContent
     * @param $xmlTag
     * @return null
     */
    public static function getStringWithXmlTag($inputContent, $xmlTag)
    {
        $finalContentJson = null;
        try {
            $pattern = '(?<=<' . $xmlTag . '>).*?(?=<\/' . $xmlTag . '>)';
            preg_match('/' . $pattern . '/', $inputContent, $matches);
            $finalContentJson = $matches;

        } catch (\Exception $exception) {
            Log::error("ExtractStringException:: " . $exception->getMessage());
        }
        return $finalContentJson;
    }

    public static function getActiveTransactionDate()
    {
        $transactionDateDto = new TransactionDateDto();
        $busDt = Carbon::now()->format('Y-m-d');
        $stDt = $busDt . "T00:00:00";
        $endDt = $busDt . "T23:59:59";
        $genDt = Carbon::now()->format('Y-m-d');
        $genBy = 'system.e-retail';
        return $transactionDateDto->getTransactionDateDto($stDt, $endDt, $busDt, 10001, $genDt, $genBy, $genBy, $genDt);
    }

    public static function getHashWithSHA256Token($content)
    {
        return hash('SHA256', $content);
    }

    public static function verifyHashToken($oldHash, $newHash)
    {
        $validHash = strcmp($oldHash, $newHash);
        return ($validHash == 0);

    }

    /**
     * @author chuma sitta
     * @param $userName
     * @param $password
     * @return null|string
     */
    public static function getAuthorization($userName, $password)
    {
        $userAuth = null;
        try {
            $userAuth = 'Basic ' . base64_encode($userName . ':' . $password);
        } catch (\Exception $exception) {
            $userAuth = null;
        }
        return $userAuth;
    }


}