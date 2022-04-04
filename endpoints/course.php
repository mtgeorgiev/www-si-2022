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

        $courses = [
            new Course(1, 'Компютърна графика с WebGl', 'доц. П. Бойчев', 'Текст текст тест', 'Задължително избираем'),
            new Course(2, 'Програмиране на Go', 'доц. Непознатко', 'Текст текст тест', 'Задължително избираем'),
            new Course(3, 'Програмиране на Ruby', 'доц. П. Бойчев', 'Друг текст', 'Свободно избираем'),
            new Course(4, 'Agile', 'проф. Калинка Калоянова', 'Текст текст тест', 'Задължително избираем'),
        ];
        
        $selectedCourseId = isset($_GET['id']) ? $_GET['id'] : null;
        
        $response = null;

        if ($selectedCourseId) {
            // return the selected course
            $response = $courses[$selectedCourseId];
        } else {
            // return all courses
            $response = $courses;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        break;
    }

}