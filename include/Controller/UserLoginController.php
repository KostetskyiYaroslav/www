<?php

namespace {

    require_once "../Service/UserService.php";
    session_start();

}


namespace Controller {

    use Service\UserService;

    $service = new UserService();

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'PUT':
            break;

        case 'GET':

            if($_GET['logout'] == 'true') {

                if ( isset( $_SESSION['userId'] ) ){
                    unset( $_SESSION['userId'] );
                    session_destroy ();
                    session_unset();
                } else {
                    die ( "ERROR: User don't Log In" );
                }
            } else {
                $login = $_GET['login'];
                $password = $_GET['password'];

                if ( $service->checkLoginAndPassword ( $login , $password ) ) {
                    $_SESSION['userId'] = $service->getIdByLogin ( $login );
                } else {
                    echo "ERROR!";
                }
            }

            break;

        case 'HEAD':
            echo "HEAD";

            break;

        case 'DELETE':

            break;

        case 'OPTIONS':
            echo "OPTIONS";

            break;

        default:
            E_ERROR;
            break;
    }

}