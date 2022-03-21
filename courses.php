<?php

    class Course {

        private $name;

        private $lecturer;

        private $description;

        private $type;

        public function __construct(string $name, string $lecturer, string $description, string $type) {
            $this->name = $name;
            $this->lecturer = $lecturer;
            $this->description = $description;
            $this->type = $type;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getLecturer(): string {
            return $this->lecturer;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getType(): string {
            return $this->type;
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Курсове</title>
        <link href="./styles/courses.css" rel="stylesheet" />
    </head>
    <body>
        <header id="top-bar">
            <button>Вход</button>
            <button>Регистрация</button>
        </header>
        <div id="content-wrapper">
            <nav id="courses">
                <?php foreach ($courses as $index => $course):?>
                    <div class="course <?=$index == $selectedCourseId ? "selected" : ""?>" id="<?=$index?>">
                        <a href="./courses.php?id=<?=$index?>"><?= $course->getName() ?></a>
                    </div>
                <?php endforeach?>
            </nav>
            <section id="course-info">
                <header><?=$selectedCourse->getName()?></header>
                <article>
                    <div class="lecturer"><?=$selectedCourse->getLecturer()?></div>
                    <div class="description"><?=$selectedCourse->getDescription()?></div>
                    <div class="type"><span class="key">Тип:</span><span class="value"><?=$selectedCourse->getType()?></span></div>
                </article>
            </section>
        </div>
    </body>
</html>