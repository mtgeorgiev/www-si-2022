<?php

class Session {

    /**
     * @throws AccessDeniedException when the current user is not logged
     * @return logged user info
     */
    public static function verifyUserIsLogged(): array {

        $logged = isset($_SESSION['user_id']);

        if (!$logged) {
            throw new AccessDeniedException();
        }

        return $_SESSION;
    }

    public static function logUser(string $username, string $password): bool {

        // check if username/password is correct
        $userId = 5;

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $username;

        return true;
    }

    public static function logout(): void {
        session_destroy();
    }

}