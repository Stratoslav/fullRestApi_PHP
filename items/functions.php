<?php
function getPosts($connection){
    $posts = mysqli_query($connection, "SELECT * FROM `posts`");


$postLists = []; 

while($post = mysqli_fetch_assoc($posts)){
    $postLists[] = $post;
}
echo  json_encode($postLists);
}
function getPostById($connection, $id){
    
    $post = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$id'");
 if(mysqli_num_rows($post) < 1){
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "not found",
        ];
        echo json_encode($res);
 }else {
  $post =  mysqli_fetch_assoc($post);
   echo json_encode($post);
 }
  
}

function addPosts($connection, $data){
 
    $title = $data["title"];
     $body = $data["body"];

    mysqli_query($connection, "INSERT INTO `posts` (`id`, `title`, `body`) VALUES (NULL, '$title', '$body');");
    http_response_code(201);

    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connection)
    ];
   echo json_encode($res);
}
; 
function updatePost($connection, $data, $id){
$title = $data["title"];
$body = $data['body'];
    mysqli_query($connection, "UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `posts`.`id` = '$id';");

       http_response_code(200);

    $res = [
        "status" => true,
        "message" => "post updated"
    ];
   echo json_encode($res);

};

function deletePosts($connection, $id){
    mysqli_query($connection, "DELETE FROM `posts` WHERE `posts`.`id` = '$id';");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "post was deleted"
    ];
    echo json_encode($res);
}