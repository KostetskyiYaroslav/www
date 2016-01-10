<?php
/**
 * There written User Model Class
 */

namespace Model;

class UserModel implements \JsonSerializable
{

    private $id;
    private $firstName;
    private $lastName;
    private $login;
    private $password;

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @param $firstName
     */
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    /**
     * @param $lastName
     */
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    /**
     * @param $login
     */
    public function setLogin($login){
        $this->login = $login;
    }

    /**
     * @param $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    public function getId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getPassword(){
        return $this->password;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize ()
    {
        return [
            'id'        => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName'  => $this->getLastName(),
            'login'     => $this->getLogin(),
            'password'  => $this->getPassword()
        ];
    }

};