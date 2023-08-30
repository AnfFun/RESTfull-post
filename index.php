<?php
require_once 'connect.php';
require_once 'functions.php';

header("Content-type: json/application");


$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
if (isset($params[1])){
    $id = $params[1];
}


$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {

    if ($type === 'posts') {

        if (isset($id)) {
            getPost($connect, $id);
        } else
            getPosts($connect);
    }
} elseif ($method === 'POST') {
    if ($type === 'posts'){
        addPost($connect,$_POST);
    }
} elseif ($method === 'PATCH'){
    if ($type === 'posts'){
        if (isset($id)){
            $data = file_get_contents('php://input');
            $data = json_decode($data,'true');
            print_r($data['title']);
            updatePost($connect,$id,$data);
        }
    }
}



