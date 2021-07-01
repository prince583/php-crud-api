<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/Tutorials.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Tutorial($db);

    $stmt = $items->getTutorials();
    $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $TutorialArr = array();
        $TutorialArr["body"] = array();
        $TutorialArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "title" => $title,
                "description" => $description,
               // "age" => $age,
               // "designation" => $designation,
               // "created" => $created
            );

            array_push($TutorialArr["body"], $e);
        }
        echo json_encode($TutorialArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>