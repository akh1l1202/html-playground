<?php
use PHPUnit\Framework\TestCase;
use App\CookieValidator;

class StateTest extends TestCase {
    private $cookieValidator;

    protected function setUp(): void {
        $this->cookieValidator = new CookieValidator();
    }

    public function testSessionExpiryLogic() {
        $now = time();
        $oldActivity = $now - 2000; // 2000 seconds ago ( > 1800s limit)
        
        $this->assertTrue(
            $this->cookieValidator->isSessionExpired($oldActivity, $now),
            "Logic should flag activity older than 1800s as expired."
        );
    }

    public function testCookieFormatValidation() {
        $validCookie = "10:" . bin2hex(random_bytes(32));
        $this->assertTrue($this->cookieValidator->isValidCookieFormat($validCookie));
        $this->assertFalse($this->cookieValidator->isValidCookieFormat("10:"));
        $this->assertFalse($this->cookieValidator->isValidCookieFormat("10:abc123"));
    }

    public function testCookieExpirationDuration() {
        $expiryDate = time() + (30 * 24 * 60 * 60);
        $this->assertTrue(
            $this->cookieValidator->isExpirationValid($expiryDate),
            "Cookie must be set for a 30-day duration."
        );
    }

    public function testTokenIsHexadecimal() {
        $secureToken = bin2hex(random_bytes(32));
        $maliciousToken = "token-with-special-chars-!@#";

        $this->assertTrue($this->cookieValidator->isTokenSecure($secureToken));
        $this->assertFalse($this->cookieValidator->isTokenSecure($maliciousToken));
    }

    public function testEmptyCookieHandling() {
        $this->assertFalse($this->cookieValidator->isValidCookieFormat(""));
        $this->assertFalse($this->cookieValidator->isValidCookieFormat(null));
    }
}