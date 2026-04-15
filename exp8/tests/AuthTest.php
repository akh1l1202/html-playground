<?php
use PHPUnit\Framework\TestCase;
use App\AuthValidator;

class AuthTest extends TestCase {
    private $validator;

    protected function setUp(): void {
        $this->validator = new AuthValidator();
    }

    public function testValidRegistration() {
        $errors = $this->validator->validateRegistration("Priya Sharma", "priya@example.com", "9876543210", "password123");
        $this->assertEmpty($errors);
    }

    public function testEmptyFields() {
        $errors = $this->validator->validateRegistration("", "", "", "");
        $this->assertArrayHasKey('reg_name', $errors);
        $this->assertArrayHasKey('reg_email', $errors);
        $this->assertArrayHasKey('reg_phone', $errors);
    }

    public function testNameTooShort() {
        $errors = $this->validator->validateRegistration("A", "test@test.com", "9876543210", "password123");
        $this->assertEquals('Name too short.', $errors['reg_name']);
    }

    public function testInvalidEmailFormat() {
        $errors = $this->validator->validateRegistration("John Doe", "john@com", "9876543210", "password123");
        $errors = $this->validator->validateRegistration("John Doe", "john@", "9876543210", "password123");
        $this->assertArrayHasKey('reg_email', $errors);
    }

    public function testInvalidIndianPhoneNumberStart() {
        $errors = $this->validator->validateRegistration("John Doe", "john@example.com", "5555555555", "password123");
        $this->assertArrayHasKey('reg_phone', $errors, "Indian numbers must start with 6, 7, 8, or 9.");
    }

    public function testPasswordBoundaryValue() {
        $errors = $this->validator->validateRegistration("John Doe", "john@example.com", "9876543210", "12345678");
        $this->assertArrayNotHasKey('reg_pass', $errors, "8 characters should be accepted.");
    }
    
}