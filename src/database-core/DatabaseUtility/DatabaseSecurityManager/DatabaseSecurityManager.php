<?php

namespace Devinci\DatabaseCore\DatabaseSecurityManager;

class DatabaseSecurityManager
{
    /**
     * Sanitize input to prevent SQL injection.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeInput(string $input): string
    {
        // Implement your sanitization logic here
        // Example: using mysqli_real_escape_string
        // Note: It's recommended to use prepared statements and parameterized queries instead of manual sanitization
        $sanitizedInput = mysqli_real_escape_string($input);

        return $sanitizedInput;
    }

    /**
     * Hash a password using a secure hashing algorithm.
     *
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        // Implement your password hashing logic here
        // Example: using password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $hashedPassword;
    }

    /**
     * Verify a password against its hashed version.
     *
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public static function verifyPassword(string $password, string $hashedPassword): bool
    {
        // Implement your password verification logic here
        // Example: using password_verify
        $isPasswordValid = password_verify($password, $hashedPassword);

        return $isPasswordValid;
    }

    /**
     * Generate a secure random token.
     *
     * @param int $length
     * @return string
     */
    public static function generateRandomToken(int $length = 32): string
    {
        // Implement your random token generation logic here
        // Example: using random_bytes
        $randomBytes = random_bytes($length);
        $randomToken = bin2hex($randomBytes);

        return $randomToken;
    }
}
