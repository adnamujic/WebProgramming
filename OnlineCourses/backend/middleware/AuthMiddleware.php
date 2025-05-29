<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    public function verifyToken($token){
        if(!$token)
            Flight::halt(401, "Missing authentication header");

        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        Flight::set('user', $decoded_token->user);
        Flight::set('jwt_token', $token);
        return TRUE;
    }

    public function authorizeRole($requiredRole) {
        $user = Flight::get('user');
        if ($user->role !== $requiredRole) {
            Flight::halt(403, 'Access denied: insufficient privileges');
        }
    }

    public function authorizeRoles($roles) {
        $user = Flight::get('user');
        if (!in_array($user->role, $roles)) {
            Flight::halt(403, 'Forbidden: role not allowed');
        }
    }

    public function authorizePermission($permission) {
        $user = Flight::get('user');
        require_once __DIR__ . '/../data/rolesPermissions.php';

        $role = $user->role;

        if (!isset($rolesPermissions[$role])) {
            Flight::halt(403, 'Access denied: unknown role');
        }

        if (!in_array($permission, $rolesPermissions[$role])) {
            Flight::halt(403, 'Access denied: permission missing');
        }
    }

    //Dodatna funkcija za rad sa Middleware-om
    public static function verifyTokenFromHeader() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            Flight::halt(401, "Missing Authorization header");
        }
    
        $authHeader = $headers['Authorization'];
        if (strpos($authHeader, 'Bearer ') !== 0) {
            Flight::halt(401, "Invalid Authorization header format");
        }
    
        $token = substr($authHeader, 7); // ukloni "Bearer "
    
        try {
            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
        } catch (Exception $e) {
            Flight::halt(401, "Invalid or expired token");
        }
    
        Flight::set('user', $decoded_token->user);
        Flight::set('jwt_token', $token);
        return true;
    }

}
