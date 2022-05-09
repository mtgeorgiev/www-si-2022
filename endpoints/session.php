<?php

session_start();

require_once '../libs/Bootstrap.php';
Bootstrap::initApp();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        $logged = isset($_SESSION['user_id']);
        echo json_encode(["logged" => $logged, "session" => $_SESSION]);
        break;
    }
    case 'POST': {
        // login

        $requestBody = json_decode(file_get_contents("php://input"), true);

        $username = $requestBody['username'];
        $password = $requestBody['password'];

        // check if username/password is correct
        $userId = 5;

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $username;

        echo json_encode(["success" => true]);

        break;
    }
    case 'DELETE': {
        session_destroy();
        echo json_encode(["success" => true]);
    }

}
