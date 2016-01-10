<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.01.2016
 * Time: 17:52
 */

namespace {
    require_once "DAO.php";
}

namespace DAO {

    use Model\SubscriptionModel;

    class SubscriptionDAO
    {
        private $dao = null;

        /**
         * SubscriptionDAO constructor, get static exemplar
         */
        public function __construct ()
        {
            $this->dao = DAO::getInstance ();
        }

        /**
         * @param $model, Subscription Model
         */
        public function create ( $model )
        {
            $userId = $model->getUserId ();
            $type = $model->getType ();
            $receiver = $model->getReceiver ();
            $status = $model->getStatus ();

            $sql = "INSERT INTO tblSubscription
                      (`userId`,`type`,`receiver`,`status`)
                    VALUES
                      ('$userId', '$type', '$receiver', '$status')";

            if ( $this->dao->connection->query ( $sql ) === TRUE ) {
                echo "<br>New Subscription was success created!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model, Subscription Model
         */
        public function remove ( $model )
        {
            $id = $model->getId ();

            $sql = "DELETE FROM `tblsubscription`
                    WHERE `id` = '$id'";

            if ( $this->dao->connection->query ( $sql ) === TRUE ) {
                echo "<br>Subscription was success removed!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model
         */
        public function updateStatus ( $model )
        {
            $id = $model->getId ();
            $status = $model->getStatus ();

            $sql = "UPDATE tblSubscription
                    SET `status` = '$status'
                    WHERE `id` = '$id'";

            if ( $this->dao->connection->query ( $sql ) === TRUE ) {
                echo "Subscription Status was success updated!";
            } else {
                echo "ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model, Subscription Model
         */
        public function update ( $model )
        {
            $id = $model->getId ();
            $type = $model->getType ();
            $receiver = $model->getReceiver ();

            $sql = "UPDATE tblsubscription
                    SET `type`      = '$type',
                        `receiver`  = '$receiver',
                    WHERE `id`      = '$id'";

            if ( $this->dao->connection->query ( $sql ) === TRUE ) {
                echo "<br>Subscription was success updated!";
            } else {
                echo "<br>ERROR: " . $this->dao->connection->error;
            }
        }

        /**
         * @param $model
         * @return array|null
         */
        public function readByUserId ( $model )
        {
            $data = null;
            $result = null;

            $userId = $model->getUserId();

            $sql = "SELECT *
                    FROM tblSubscription
                    WHERE `userId` = '$userId'";

            $response = $this->dao->connection->query($sql);

            $numberRow = mysqli_num_rows($response);

            if($numberRow >= 2) {

                $row = mysqli_fetch_all($response);

                $i = $numberRow - 1;

                while($i != -1)
                {
                    $j = 0;

                         $id  = $row[$i][$j];
                      $userId = $row[$i][++$j];
                        $type = $row[$i][++$j];
                    $receiver = $row[$i][++$j];
                      $status = $row[$i][++$j];

                    $model = new SubscriptionModel();

                    $model->setId($id);
                    $model->setUserId($userId);
                    $model->setReceiver($receiver);
                    $model->setStatus($status);
                    $model->setType($type);

                    $array[$i] = array( $model );

                    --$i;
                }

            } elseif (mysqli_num_rows($response) == 1 ) {

                $response = mysqli_fetch_array($response);

                $model = new SubscriptionModel();

                      $id = $response['id'];
                  $userId = $response['userId'];
                $receiver = $response['receiver'];
                    $type = $response['status'];
                  $status = $response['type'];

                $model->setId($id);
                $model->setUserId($userId);
                $model->setReceiver($receiver);
                $model->setStatus($status);
                $model->setType($type);

                $array[0] = $model;
            } else {

                return $array = null;
            }
            return $array ;
        }

    };
}