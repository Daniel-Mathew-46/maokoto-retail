<?php

namespace App\Http\Retail\Dto;

/**
 * Created by PhpStorm.
 * User: chuma
 * Date: 2/16/22
 * Time: 4:18 PM
 */


use Illuminate\Database\Eloquent\Concerns\HasAttributes;

/**
 * Class MessageAckDto
 * @package App\Http\Retail\Dto
 */
class MessageAckDto
{
    use HasAttributes;

    /**
     * @param $msgAckId
     * @param $msgReqId
     * @param $stsCode
     * @param $stsDesc
     * @return array
     */
    public function getMessageAckDto($msgAckId, $msgReqId, $stsCode, $stsDesc)
    {
        $this->attributes['MsgAckId'] = $msgAckId;
        $this->attributes['MsgReqId'] = $msgReqId;
        $this->attributes['StsCode'] = $stsCode;
        $this->attributes['StsDesc'] = $stsDesc;
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getMsgAckId()
    {
        return $this->attributes['MsgAckId'];
    }

    /**
     * @param mixed $MsgAckId
     */
    public function setMsgAckId($MsgAckId)
    {
        $this->attributes['MsgAckId'] = $MsgAckId;
    }

    /**
     * @return mixed
     */
    public function getMsgReqId()
    {
        return $this->attributes['MsgReqId'];
    }

    /**
     * @param mixed $MsgReqId
     */
    public function setMsgReqId($MsgReqId)
    {
        $this->attributes['MsgReqId'] = $MsgReqId;
    }

    /**
     * @return mixed
     */
    public function getStsCode()
    {
        return $this->attributes['StsCode'];
    }

    /**
     * @param mixed $StsCode
     */
    public function setStsCode($StsCode)
    {
        $this->attributes['StsCode'] = $StsCode;
    }

    /**
     * @return mixed
     */
    public function getStsDesc()
    {
        return $this->attributes['StsDesc'];
    }

    /**
     * @param mixed $StsDesc
     */
    public function setStsDesc($StsDesc)
    {
        $this->attributes['StsDesc'] = $StsDesc;
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