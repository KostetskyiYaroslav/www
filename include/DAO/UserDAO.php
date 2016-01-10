<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.01.2016
 * Time: 14:52
 */

namespace {
    require_once "DAO.php";
}

namespace DAO {

    use Model\UserModel;

    class UserDAO
    {
        private $dao = null;

        /**
         * UserDAO constructor, take static exemplar
         */
        public function __construct ()
        {
            $this->dao = DAO::getInstance();
        }

        /**
         * @param $model, User Model
         */
        public function create ( $model )
        {
            $firstName = $model->getFirstName ();
            $lastName = $model->getLastName ();
            $login = $model->getLogin ();
            $password = $model->getPassword ();

            $sql = "INSERT INTO `tblUser`
                  (`firstName`, `lastName`, `login`, `password`)
                VALUES
                  ('$firstName', '$lastName', '$login', '$password')"
            ;

            $this->dao = DAO::getInstance ();

            if ( $this->dao->connection->query ( $sql ) === TRUE ) {
                echo "<br>New User was success created!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model, User Model
         */
        public function remove( $model){

            $id = $model->getId();

            $sql = "DELETE FROM `tbluser`
                    WHERE `id` = '$id'"
            ;
            $this->dao = DAO::getInstance();

            if($this->dao->connection->query($sql) === TRUE){
                echo "<br>User was success remove from Database!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model, User Model
         */
        public function update( $model){

            $id = $model->getId();
            $firstName = $model->getFirstName();
            $lastName = $model->getLastName();
            $password = $model->getPassword();

            $sql = "UPDATE `tblUser`
                    SET `firstName` = '$firstName',
                        `lastName` = '$lastName',
                        `password` = '$password'
                    WHERE `id` = '$id'"
            ;

            if($this->dao->connection->query($sql) === TRUE){
                echo "<br>User was success updated!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model, User Model
         * @return UserModel, JsonSerialise
         */
        public function read( $model){
            $id = $model->getId();

            $sql = "SELECT *
                    FROM `tbluser`
                    WHERE `id` = '$id'";

            $response = $this->dao->connection->query($sql);
            $response = mysqli_fetch_row($response);

            $readId         = $response[0];
            $readFirstName  = $response[1];
            $readLastName   = $response[2];
            $readLogin      = $response[3];
            $readPassword   = $response[4];

            $readUser = new UserModel();

            $readUser->setId($readId);
            $readUser->setFirstName($readFirstName);
            $readUser->setLastName($readLastName);
            $readUser->setLogin($readLogin);
            $readUser->setPassword($readPassword);

            return $readUser;
        }


        public function checkLogin($model){

            $login = $model->getLogin();
            $password = $model->getPassword();

            $sql = "SELECT `*`
                    FROM tbluser
                    WHERE `login` = '$login' AND
                          `password` = '$password'";

            $response = $this->dao->connection->query($sql);

            $response = mysqli_fetch_row($response);

            if($response[3] == $login and $response[4] == $password){
                return true;

            } else {

                return false;
            }
        }

        public function getIdByLogin($model){

            $login = $model->getLogin();

            $sql = "SELECT `*`
                    FROM `tblUser`
                    WHERE `login` = '$login'";

            $response = $this->dao->connection->query($sql);

            $response = mysqli_fetch_row($response);

            if($response[3] == $login){
                $id = $response[0];

                return $id;
            }

            return null;
        }

    };
}