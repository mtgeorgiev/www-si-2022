<?php

spl_autoload_register(function($className) {
    $paths = [
        "../libs",
    ];

    foreach ($paths as $path) {
        $classPath = "$path/$className.php";
        if (file_exists($classPath)) {
            require_once $classPath;
        }
    }
});

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        
        $selectedCourseId = isset($_GET['id']) ? $_GET['id'] : null;
        
        $response = null;

        if ($selectedCourseId) {
            // return the selected course
            $sql   = "SELECT * FROM `courses` WHERE id = " . $selectedCourseId;
            $query = (new Db())->getConnection()->query($sql);
            $dbRow = $query->fetch();

            if ($dbRow) {
                $response = Course::createFromAssoc($dbRow);
            } else {
                http_response_code(404);
                $response = ["error" => "Course with id $selectedCourseId not found"];
            }
        } else {
            // return all courses
            $sql   = "SELECT * FROM `courses` ORDER BY id ASC";
            $query = (new Db())->getConnection()->query($sql);

            $courses = [];
            while($dbRow = $query->fetch()) {
                $courses[] = $dbRow;
            }
            $response = $courses;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        break;
    }

}