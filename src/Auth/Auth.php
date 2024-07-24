<?php 
namespace App\Auth;

use Exception;
use Firebase\JWT\JWT;

class Auth{
    private $secret;
    
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    function generateToken($user_id){
        $issued_at = time();
        $experitation_time = $issued_at + 3600; // valido por una hora
        $payload = array(
            'user_id'   => $user_id,
            'iat'       => $issued_at,
            'exp'       => $experitation_time
        );

        return JWT::encode($payload, $this->secret);
    }

    function verifyToken($token){
        try {
            $payload = JWT::decode($token, $this->secret, array('HS256'));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}