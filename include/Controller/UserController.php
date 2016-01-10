<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.01.2016
 * Time: 15:34
 */

namespace {
    require_once "../Service/UserService.php";
    session_start();
}

namespace Controller {

    use Service\UserService;

    $service = new UserService();
    $method = $_SERVER['REQUEST_METHOD'];
    //$request = explode("/", sub str(@$_SERVER['PATH_INFO'], 1));

    switch ($method) {
        case 'PUT':
            $firstName = $_GET['firstName'];
            $lastName = $_GET['lastName'];
            $userLogin = $_GET['login'];
            $userPassword = $_GET['password'];

            $service->create ( $firstName , $lastName , $userLogin , $userPassword );

            break;

        case 'GET':

            $id = $_SESSION['userId'];

            echo json_encode($service->read($id));

            break;

        case 'HEAD':
            echo "HEAD";

            break;

        case 'DELETE':
            $id = $_GET['id'];
            $service->remove($id);
            break;

        case 'OPTIONS':
            $id = $_GET['id'];
            $newFirstName = $_GET['firstName'];
            $newLastName = $_GET['lastName'];
            $newPassword = $_GET['password'];

            $service->update($id, $newFirstName, $newLastName, $newPassword);
            break;

        default:
            E_ERROR;
            break;
    }
}