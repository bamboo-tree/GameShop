<?php
class User {
    private $first_name;
    private $last_name;
    private $user_name;
    private $email;
    private $hashed_password;

    public function __construct($first_name, $last_name, $user_name, $email, $text_password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->hashed_password = password_hash($text_password, PASSWORD_DEFAULT);
    }

    public function show_user_info() {
        echo "FIRST NAME : " . $this->first_name . "<br>";
        echo "LAST NAME : " . $this->last_name . "<br>";
        echo "USER NAME : " . $this->user_name . "<br>";
        echo "EMAIL : " . $this->email . "<br>";
        echo "PASSWORD : " . $this->hashed_password . "<br>";
    }

    public function set_first_name($first_name) {
        $this->first_name = $first_name;
    }
    public function set_last_name($last_name) {
        $this->last_name = $last_name;
    }
    public function set_user_name($user_name) {
        $this->user_name = $user_name;
    }
    public function set_email($email) {
        $this->email = $email;
    }
    public function set_password($text_password) {
        $this->hashed_password = password_hash($text_password, PASSWORD_DEFAULT);
    }

    public function get_first_name() {
        return $this->first_name;
    }
    public function get_last_name() {
        return $this->last_name;
    }
    public function get_user_name() {
        return $this->user_name;
    }
    public function get_email() {
        return $this->email;
    }
    public function get_password() {
        return $this->hashed_password;
    }
}
