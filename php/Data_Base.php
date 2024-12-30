<?php
class Data_Base {
    private $mysqli;

    public function __construct($server, $user, $password, $data_base) {
        $this->mysqli = new mysqli($server, $user, $password, $data_base);
        if ($this->mysqli->connect_errno) {
            printf(
                "Failed to connect with server\n"
            );
            exit();
        }
        if ($this->mysqli->set_charset("utf8")) {
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function my_query($query) {
        return $this->mysqli->query($query);
    }

    public function get_mysqli() {
        return $this->mysqli;
    }
}
