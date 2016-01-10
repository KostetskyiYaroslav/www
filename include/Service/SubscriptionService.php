<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.01.2016
 * Time: 17:51
 */

namespace {
    require_once "../DAO/SubscriptionDAO.php";
    require_once "../Model/SubscriptionModel.php";
}

namespace Service {

    use DAO\SubscriptionDAO;
    use Model\SubscriptionModel;
    use Model\UserModel;

    class SubscriptionService
    {

        private $dao = null;

        /**
         * SubscriptionService constructor, take static exemplar
         */
        public function __construct ()
        {
            $this->dao = new SubscriptionDAO();
        }

        /**
         * @param $userId
         * @param $type
         * @param $receiver
         * @param $status
         */
        public function create ( $userId, $type, $receiver, $status )
        {
            $model = new SubscriptionModel();
            $model->setUserId ( $userId );
            $model->setType ( $type );
            $model->setReceiver ( $receiver );
            $model->setStatus ( $status );

            if($this->validateModel($model)){
                $this->dao->create($model);
            } else {
                echo "ERROR: User information invalid!";
            }
        }

        /**
         * @param $id
         */
        public function remove($id){
            $model = new SubscriptionModel();
            $model->setId($id);

            if($this->validateModel($model)){
                $this->dao->remove($model);
            } else {
                echo "<br>ERROR: User information is invalid!";
            }
        }

        /**
         * @param $id
         * @param $receiver
         * @param $type
         */
        public function update($id, $receiver, $type){
            $model = new SubscriptionModel();
            $model->setId($id);
            $model->setReceiver($receiver);
            $model->setType($type);

            if($this->validateModel($model)){
                $this->dao->update($model);
            } else {
                echo "<br>ERROR: User information is invalid!";
            }
        }

        /**
         * @param $userId
         * @return SubscriptionModel|null
         */
        public function readById($userId){
            $model = new SubscriptionModel();
            $model->setUserId($userId);

            if($this->validateModel($model)){
                return $this->dao->readByUserId($model);

            } else {

                echo "<br>ERROR: User information is invalid!";
            }

            return null;
        }

        /**
         * @param $model
         * @return bool
         */
        private function validateModel($model){
            $condition = true;
            if ( $model == null ) {
                $condition = false;
            }
            return $condition;
        }
    };
}