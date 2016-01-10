<?php
/**
 * There written Service for User Controller
 */

namespace {
    require_once "../DAO/UserDAO.php";
    require_once "../Model/UserModel.php";

}

namespace Service {

    use DAO\UserDAO;
    use Model\UserModel;

    class UserService
    {
        private $dao = null;

        /**
         * UserService constructor, take static exemplar
         */
        public function __construct ()
        {
            $this->dao = new UserDAO();
        }

        /**
         * @param $firstName
         * @param $lastName
         * @param $login
         * @param $password
         */
        public function create ( $firstName , $lastName , $login , $password )
        {
            $model = new UserModel();
            $model->setFirstName ( $firstName );
            $model->setLastName ( $lastName );
            $model->setLogin ( $login );
            $model->setPassword ( $password );

            if ( $this->validateModel ( $model ) ) {
                $this->dao->create ( $model );
            }
        }

        /**
         * @param $id
         */
        public function remove($id){
            $model = new UserModel();
            $model->setId($id);

            if( $this->validateModel($model) ){
                $this->dao->remove($model);
            } else {
                echo "<br>ERROR: User Information Invalid!";
            }
        }

        /**
         * @param $id
         * @param $firstName
         * @param $lastName
         * @param $password
         */
        public function update($id, $firstName , $lastName , $password){
            $model = new UserModel();
            $model->setId($id);
            $model->setPassword($password);
            $model->setFirstName($firstName);
            $model->setLastName($lastName);

            if($this->validateModel($model)){
                $this->dao->update($model);
            } else {
                echo "<br>ERROR: User Information Invalid!";
            }
        }

        /**
         * @param $id
         * @return UserModel
         */
        public function read($id){
            $model = new UserModel();
            $model->setId($id);

            if($this->validateModel($model)){
                return $this->dao->read($model);
            } else {
                echo "<br>ERROR: User Information Invalid!";
            }
            return null;
        }

        /**
         * @param $login
         * @param $password
         * @return bool
         */
        public function checkLoginAndPassword($login,$password){
            $model = new UserModel();

            $model->setLogin($login);
            $model->setPassword($password);

            return $this->dao->checkLogin($model);
        }


        public function getIdByLogin($login){

            $model = new UserModel();

            $model->setLogin($login);

            if($this->validateModel($model)){

                return $this->dao->getIdByLogin($model);

            }

            return null;
        }

        /**
         * @param $model/UserModel
         * @return bool
         */
        private function validateModel ( $model )
        {
            $condition = true;
            if ( $model == null ) {
                $condition = false;
            }
            return $condition;
        }

    };
}