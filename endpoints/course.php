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
            new Course('Компютърна графика с WebGl', 'доц. П. Бойчев', 'Текст текст тест', 'Задължително избираем'),
            new Course('Програмиране на Go', 'доц. Непознатко', 'Текст текст тест', 'Задължително избираем'),
            new Course('Програмиране на Ruby', 'доц. П. Бойчев', 'Друг текст', 'Свободно избираем'),
            new Course('Agile', 'проф. Калинка Калоянова', 'Текст текст тест', 'Задължително избираем'),
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


$courses = [
    new Course('Компютърна графика с WebGl', 'доц. П. Бойчев', 'Текст текст тест', 'Задължително избираем'),
    new Course('Програмиране на Go', 'доц. Непознатко', 'Текст текст тест', 'Задължително избираем'),
    new Course('Програмиране на Ruby', 'доц. П. Бойчев', 'Друг текст', 'Свободно избираем'),
    new Course('Agile', 'проф. Калинка Калоянова', 'Текст текст тест', 'Задължително избираем'),
];

$selectedCourseId = isset($_GET['id']) ? $_GET['id'] : 0;

$selectedCourse = $courses[$selectedCourseId];
