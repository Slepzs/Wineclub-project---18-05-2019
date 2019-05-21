<?php 

class User extends DatabaseObject {

    static protected $table_name = 'users';
    static protected $db_columns = ['id', 'username', 'hashed_password', 'email', 'title', 'admin', 'banned', 'last_session', 'online', 'token'];

    public $id;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $hashed_password;
    public $password_required = true;
    public $token;

    public function __construct($args=[])
    {
    $this->username = $args['username'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';

    $this->last_session = $args['last_session'] ?? '';
    $this->online = $args['online'] ?? '';

    $this->token = $args['token'] ?? '';
    }

    public function username() {
        return "{$this->first_name} {$this->last_name}";
      }
    
      protected function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
      }
    
      public function verify_password($password) {
        return password_verify($password, $this->hashed_password);
      }
    
      protected function create() {
         $this->set_hashed_password();
         return parent::create();
      }
    
      protected function update() {
        if($this->password != '') {
          // validate password
          $this->set_hashed_password();
        } else {
          // password not being updated, skip validation
          $this->password_required = false;
        } 
        return parent::update();
      }
    
      protected function validate() {
        $this->errors = [];
      
        if(is_blank($this->email)) {
          $this->errors[] = "Email cannot be blank.";
        } elseif (!has_length($this->email, array('max' => 255))) {
          $this->errors[] = "Last name must be less than 255 characters.";
        } elseif (!has_valid_email_format($this->email)) {
          $this->errors[] = "Email must be a valid format.";
        }
      
        if(is_blank($this->username)) {
          $this->errors[] = "Username cannot be blank.";
        } elseif (!has_length($this->username, array('min' => 2, 'max' => 255))) {
          $this->errors[] = "Username must be between 8 and 255 characters.";
        } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
          $this->errors[] = "Username not allowed try another.";
        }

        if($this->password_required) { 
          if(is_blank($this->password)) {
            $this->errors[] = "Password cannot be blank.";
          } elseif (!has_length($this->password, array('min' => 2))) {
            $this->errors[] = "Password must contain 12 or more characters";
          } 
        
          if(is_blank($this->confirm_password)) {
            $this->errors[] = "Confirm password cannot be blank.";
          } elseif ($this->password !== $this->confirm_password) {
            $this->errors[] = "Password and confirm password must match.";
          }
        }
      
        return $this->errors;
      }
    
      static public function find_by_username($username) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

      static public function update_token($token, $email) {
        $sql = "UPDATE " . static::$table_name . " ";
        $sql .=  "SET token = '" . $token . "' WHERE email='". $email . "' ";
        $result = static::$database->query($sql);
      }

      static public function find_by_token($token) {
        $sql = "SELECT token FROM " . static::$table_name . " ";
        $sql .= "WHERE token='" . self::$database->escape_string($token) . "' LIMIT 1";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

      
      static public function update_password($password, $token) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE " . static::$table_name . " ";
        $sql .=  "SET hashed_password = '". $hashed_password ."' WHERE token='". $token . "' LIMIT 1"; 
        $result = static::$database->query($sql);
       
      }
    

}



?>