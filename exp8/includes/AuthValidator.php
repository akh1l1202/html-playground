<?php
namespace App;

class AuthValidator {
    public function validateRegistration($full_name, $email, $phone, $password) {
        $errors = [];

        if (strlen(trim($full_name)) < 2) {
            $errors['reg_name'] = 'Name too short.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['reg_email'] = 'Invalid email.';
        }
        if (!preg_match('/^(\+91)?[6-9]\d{9}$/', $phone)) {
            $errors['reg_phone'] = 'Invalid Indian mobile number.';
        }
        if (strlen($password) < 8) {
            $errors['reg_pass'] = 'Password must be 8+ characters.';
        }

        return $errors;
    }

    public function validateLoginEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}