<?php 

class Session extends DatabaseObject {


    private $user_id;
    public  $username;
    private $last_login;

    public const MAX_LOGIN_AGE = 60*60*24; // 1 day;

    public function __construct()
    {
       session_start(); // turn on sessions if needed
       $this->check_stored_login();
    }

    public function login($user) {
        if($user) {
            // prevent session fixation attacks
            session_regenerate_id();

            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->last_login = $_SESSION['last_login'] = time();
            
            $sqlonline = ('UPDATE users SET online=1 WHERE id = ' . $_SESSION['user_id'] . ' ');
            DatabaseObject::$database->query($sqlonline);

            $last_session = date("Y-m-d H:i:s"); // update last activity time stamp
            $sqlsession = ('UPDATE users SET last_session="'. $last_session .'" WHERE id = ' . $_SESSION['user_id'] . ' ');
            DatabaseObject::$database->query($sqlsession);

            $sql = ('UPDATE users SET online = 0 WHERE online = 1 AND last_session <= NOW() - INTERVAL 20 MINUTE');
            DatabaseObject::$database->query($sql);
        }
        return true;
    }

    public function is_logged_in() {
       // return isset($this->admin_id);
       return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function logout() {

        $user = User::find_by_id($_SESSION['user_id']);

        $sqlsession = 'UPDATE users set online=0 where id = ' . $user->id . '';
        DatabaseObject::$database->query($sqlsession);

        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['last_login']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        session_destroy();
        return true;
    }

    private function check_stored_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    private function last_login_is_recent() {
        if(!isset($this->last_login)) {
            return false;
        } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }

}

?>