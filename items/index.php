<?php
require_once "connect.php";
require_once "functions.php";
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');

header("Content-type: application/json");
$q = $_GET['q'];
$method = $_SERVER['REQUEST_METHOD'];
$params = explode('/', $q);

$type = $params[0];
$id = $params[1];

if($method === "GET"){
if($type == "posts"){
    if(isset($id)){
        getPostById($connection, $id);
    }
    getPosts($connection);
}
} else if($method === "POST"){
    if($type == "posts"){
  
        addPosts($connection, $_POST);
    }
} else if($method === "PATCH"){
    if($type === "posts" && isset($id)){
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        updatePost($connection, $data, $id);
    }
} else if($method === "DELETE"){
   if($type === 'posts' && isset($id)){
        deletePosts($connection, $id);
   }
}


?>