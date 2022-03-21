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
