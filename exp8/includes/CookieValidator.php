<?php
namespace App;

class CookieValidator {
    public function isSessionExpired($lastActivity, $currentTime, $timeoutLimit = 1800) {
        if ($lastActivity === 0) return true;
        return ($currentTime - $lastActivity) > $timeoutLimit;
    }

    public function isValidCookieFormat($cookieValue) {
        if (empty($cookieValue) || !str_contains($cookieValue, ':')) {
            return false;
        }
        $parts = explode(':', $cookieValue);
        
        if (count($parts) !== 2 || !is_numeric($parts[0])) {
            return false;
        }
        if (strlen($parts[1]) !== 64) {
            return false;
        }
        if (!$this->isTokenSecure($parts[1])) {
            return false;
        }

        return true;
    }

    public function isExpirationValid($expiryTimestamp, $days = 30) {
        $expected = time() + ($days * 24 * 60 * 60);    
        return abs($expected - $expiryTimestamp) < 10;
    }

    public function isTokenSecure($token) {
        return ctype_xdigit($token);
    }
}