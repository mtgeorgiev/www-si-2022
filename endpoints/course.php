<?php

session_start();

// require_once "bootstrap.php";
require_once '../libs/Bootstrap.php';
Bootstrap::initApp();

Session::verifyUserIsLogged();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        
        $selectedCourseId = isset($_GET['id']) ? $_GET['id'] : null;
        
        $response = null;

        if ($selectedCourseId) {
            $response = CourseEndpointHandler::getCourseById($selectedCourseId);
        } else {
            $response = CourseEndpointHandler::getAllCourses();
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        break;
    }

}
