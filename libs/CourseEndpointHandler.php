<?php

class CourseEndpointHandler {

    public static function getCourseById(string $courseId): Course {

        $sql   = "SELECT * FROM `courses` WHERE id = :course_id";
        $selectStatement = (new Db())->getConnection()->prepare($sql);

        $selectStatement->execute(['course_id' => $courseId]);

        $courseDbRow = $selectStatement->fetch();

        if (!$courseDbRow) {
            throw new NotFoundException("Course with id $courseId not found");
        }

        return Course::createFromAssoc($courseDbRow);
    }

    public static function getAllCourses(): array {

        $sql   = "SELECT * FROM `courses` ORDER BY id ASC";
        $selectStatement = (new Db())->getConnection()->prepare($sql);
        $selectStatement->execute();

        $allCourses = [];
        foreach ($selectStatement->fetchAll() as $course) {
            $allCourses[] = Course::createFromAssoc($course);
        }

        return $allCourses;
    }
}
