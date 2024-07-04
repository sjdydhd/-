<?php  
class Mysql{  
    private $host;  
    private $root;  
    private $passwords;  
    private $database;  
    private $conn;  // 修正了这里，使其成为类属性  
  
    function __construct($host,$root,$passwords,$database){  
        $this->host = $host;  
        $this->root = $root;  
        $this->passwords = $passwords;  
        $this->database = $database;  
        $this->connect();  
    }  
  
    function connect(){  
        $this->conn=mysqli_connect($this->host,$this->root,$this->passwords);  
        mysqli_query($this->conn,"set names utf8");  
        mysqli_select_db($this->conn,$this->database);  
    }  
  
    function query($sql){  
        // 可以进一步加入预准备语句和绑定参数以增加安全性  
        return mysqli_query($this->conn,$sql);  
    }  
  
    function rows($result){  
        return mysqli_num_rows($result);  
    }  
  
    function selectbyUser($table,$username){  
        // 修正了参数名称，使其更清晰  
        return $this->query("SELECT * FROM `$table` where `username`='$username'");  
    }  
  
    function insert($table,$username,$password){  
        // 返回插入的行数或false（根据实际需求）  
        return mysqli_query($this->conn,"INSERT INTO `$table` (username,password) VALUES ('$username','$password')") ? mysqli_insert_id($this->conn) : false;  
    }  
  
    function assoc($result){  
        return mysqli_fetch_assoc($result);  
    }  
  
    function dbClose(){  
        mysqli_close($this->conn);  
    }  
}  
$db = new Mysql("localhost","root","123456","test");  
?>