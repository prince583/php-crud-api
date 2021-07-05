<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Tutorials.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Tutorial($db);

    $data = json_decode(file_get_contents("php://input"));
   // echo json_encode("data");
    // echo json_encode($data->title); die;

    //return json_encode($data);

    $item->title = $data->title;
    $item->description = $data->description;
    //$item->age = $data->age;
    //$item->designation = $data->designation;
    //$item->created = date('Y-m-d H:i:s');
    
    if($item->createTutorial()){
        //echo 'Tutorial created successfully.';
        http_response_code(200);
        echo json_encode(
            array("message" => 'Tutorial created successfully.')
        );
    } else{
        http_response_code(422);
        echo 'Tutorial could not be created.';
    }
?>