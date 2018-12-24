<?php
namespace app\models;
use config;
use Exception;

class Tree{

    private $host;
    private $name;
    private $password;
    private $database;
    public $db;
    public $query;

    public function __construct ($host, $user, $psw, $db)
    {
        $this->host=$host;
        $this->name=$user;
        $this->password=$psw;
        $this->database=$db;

        if (!($this->db=mysqli_connect($this->host,$this->name,$this->password))){
            throw new Exception ("Can't connect to the server.");
        }
        if (!mysqli_select_db($this->db, $this->database)){
            throw new Exception ("Can't connect to DB.");
        }
        return $this->db;
    }

    public function query($sqlQuery, $getType = "assoc")
    {
        if (!($result = mysqli_query($this->db, $sqlQuery))){
            throw new Exception ("Can't execute query.".mysql_error());
        }
        $resultType = MYSQL_NUM;
        if ("assoc" == $getType) {
            $resultType = MYSQL_ASSOC;
        }
        while ($row = mysqli_fetch_array($result, $resultType)){
            $res[] = $row;
        }
        return $res;
    }

    public function plantTree($dataTree){
        $this->query( "SET CHARSET utf8" );

        foreach($dataTree as $data){
            $sql = $sql . "\n" . '( "'. $data['nodeId'] . '" , "' . $data['parentId'] . '" , "' . $data['nodeName'] . '" ),' . "\n";
        }

        $sql = 'INSERT INTO `trees` (`id`, `parent_id`, `name`) VALUES' . substr($sql, 0, strrpos($sql, ','));

        return  $params = $this->query($sql);
    }

    public function getTree(){
        $this->query( "SET CHARSET utf8" );
        $sql = 'SELECT * FROM trees ORDER BY id';

        return  $params = $this->query($sql);
    }

    public function deleteTree(){
        $sql = 'DELETE FROM trees';

        return  $params = $this->query($sql);
    }

}
?>