<?php
/**
 * There written Subscription Model
 */

namespace Model;


class SubscriptionModel implements \JsonSerializable
{
    private $id;
    private $userId;
    private $type;
    private $receiver;
    private $status;

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @param $userId
     */
    public function setUserId($userId){
        $this->userId = $userId;
    }

    /**
     * @param $type
     */
    public function setType($type){
        $this->type = $type;
    }

    /**
     * @param $receiver
     */
    public function setReceiver($receiver){
        $this->receiver = $receiver;
    }

    /**
     * @param $status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getType(){
        return $this->type;
    }

    public function getReceiver(){
        return $this->receiver;
    }

    public function getStatus(){
        return $this->status;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize (){
        return [
            'id'        => $this->getId(),
            'userId'    => $this->getUserId(),
            'type'      => $this->getType(),
            'receiver'  => $this->getReceiver(),
            'status'    => $this->getStatus()
        ];
    }

};