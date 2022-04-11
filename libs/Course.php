<?php

class Course implements JsonSerializable {

    private $id;

    private $name;

    private $lecturer;

    private $description;

    private $type;

    public function __construct(int $id, string $name, string $lecturer, string $description, string $type) {
        $this->id = $id;
        $this->name = $name;
        $this->lecturer = $lecturer;
        $this->description = $description;
        $this->type = $type;
    }

    public function getId(): int {
        return $this->id;
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

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }

    public static function createFromAssoc(array $assocCourse): Course {
        return new Course($assocCourse['id'], $assocCourse['name'], $assocCourse['lecturer'], $assocCourse['description'], $assocCourse['type']);
    }
}
