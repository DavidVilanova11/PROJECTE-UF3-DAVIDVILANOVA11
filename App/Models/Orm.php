<?php

// include_once(__DIR__ . "/../Services/Database.php");

// class Orm
// {

//     protected $model;

//     public function __construct($model)
//     {

//         $this->model = $model;
//         if (!isset($_SESSION[$model])) {
//             $_SESSION[$model] = [];
//         }
//     }

//     public function getById($id)
//     {
//         foreach ($_SESSION[$this->model] as $item) {
//             if ($item['id'] == $id) {
//                 return $item;
//             }
//         }
//     }


//     public function removeItemById($id)
//     {
//         foreach ($_SESSION[$this->model] as $key => $item) {
//             if ($item['id'] == $id) {
//                 unset($_SESSION[$this->model][$key]);
//                 return $item;
//             }
//         }
//         return null;
//     }

//     public function create($item)
//     {
//         // CREATE TABLE `des-extincio`.`recuperades` (`id` INT NOT NULL AUTO_INCREMENT , 
//         // `nom` VARCHAR(250) NOT NULL , `especie` INT NOT NULL , 
//         // `naixement` TIMESTAMP NOT NULL , `img` VARCHAR(250) NOT NULL , 
//         // `id_usuari` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


//         $sql = "INSERT INTO recuperades(nom, especie, naixement, img, id_usuari) VALUES (:nom, :especie, :naixement, :img, :id_usuari)";

//         $params = array(
//             ":nom" => $item['nom'],
//             ":especie" => $item['especie'],
//             ":naixement" => $item['naixement'],
//             ":img" => $item['img'],
//             ":id_usuari" => $item['id_usuari']
//         );

//         $db = new Database();
//         $db->queryDatabase($sql, $params);

//         return $item;
//     }

//     public function getAll()
//     {

//         return $_SESSION[$this->model];
//     }

//     public function update($itemUpdated)
//     {
//         foreach ($_SESSION[$this->model] as $key => $item) {
//             if ($item['id'] == $itemUpdated['id']) {
//                 $_SESSION[$this->model][$key] = $itemUpdated;
//             }
//         }
//         return null;
//     }

//     public function reset()
//     {
//         unset($_SESSION[$this->model]);
//     }
// }


include_once(__DIR__ . "/../Services/Database.php");

class Orm
{
    protected $model;

    public function __construct($model)
    {   
        if (!isset($_SESSION[$model])) {
            $_SESSION[$model] = [];
        }
        $this->model = $model;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->model;
        $params = null;
        $db = new Database();
        $result = $db->queryDataBase($sql,$params)->fetchAll();
        return $result;
    }
    public function getById($id){
        $sql = "SELECT * FROM " . $this->model . " WHERE id = :id";
        $params = array(
            ":id" => $id
        );
        $db = new Database();
        $result = $db->queryDataBase($sql,$params)->fetch();
        return $result;
    }
    public function insert($data){
        $params = array();
        foreach($data as $key => $value){
            $params[":" . $key] = $value;
        }
        if(!isset($data['id'])){
            $columns = implode(", ",array_keys($data));
            $values = ":" . implode(", :",array_keys($data));
    
            $sql = "INSERT INTO " . $this->model . " ($columns) VALUES ($values)";
            $db = new Database();
            $data = $db->queryDataBase($sql,$params,true);
            // echo '<pre>';
            // var_dump($sql);
            // // echo '</pre>'; 
            // die();
            return $data;
        } else{
            $values_sql_update="";
            foreach($data as $key => $value){
                if($key != "id"){
                $values_sql_update .= $key . " = :" . $key . ", ";
            }
            }
            $values_sql_update = substr($values_sql_update,0,-2);
            $sql = "UPDATE  $this->model  SET $values_sql_update WHERE id = :id";

            $db = new Database();
            $result = $db->queryDataBase($sql,$params)->fetch();
            return $result;
        }
       
    
    }

    public function removeItemById($id)
    {
        $sql = "DELETE FROM " . $this->model . " WHERE id = :id";
        $params = array(
            ":id" => $id
        );
        $db = new Database();
        $result = $db->queryDataBase($sql,$params);
        return $result;
    }
}