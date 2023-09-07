<?php

namespace App\Http\Retail\Dto;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;

/**
 * Created by PhpStorm.
 * User: chuma
 * Date: 2/16/22
 * Time: 4:23 PM
 */
class MessageAckWrapperDto
{
    use  HasAttributes;

    /**
     * @param $msgAck
     * @param $signature
     * @return array
     */
    public function getMessageAckWrapperDto($msgAck, $signature)
    {
        $this->attributes['MsgAck'] = $msgAck;
        $this->attributes['eRtlSignature'] = $signature;
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getMsgAck()
    {
        return $this->attributes['MsgAck'];
    }

    /**
     * @param mixed $MsgAck
     */
    public function setMsgAck($MsgAck)
    {
        $this->attributes['MsgAck'] = $MsgAck;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->attributes['eRtlSignature'];
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->attributes['eRtlSignature'] = $signature;
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