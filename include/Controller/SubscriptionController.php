<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.01.2016
 * Time: 7:21
 */

namespace {
    require_once "../Service/SubscriptionService.php";
    session_start();
}

namespace Controller {

    use Service\SubscriptionService;

    $service = new SubscriptionService();

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'PUT':
            $userId     = $_SESSION['userId'];
            $type       = $_GET['type'];
            $receiver   = $_GET['receiver'];
            $status     = 0;

            $service->create($userId, $type, $receiver, $status);

            break;

        case 'GET':

            $id = $_SESSION['userId'];

            echo json_encode($service->readById($id));

            break;

        case 'HEAD':
            echo "HEAD";

            break;

        case 'DELETE':
            $id = $_GET['id'];
            $service->remove($id);

            break;

        case 'OPTIONS':
            $id         = $_GET['id'];
            $receiver   = $_GET['receiver'];
            $type       = $_GET['type'];

            $service->update($id, $receiver, $type);

            break;

        default:
            E_ERROR;
            break;
    }

}