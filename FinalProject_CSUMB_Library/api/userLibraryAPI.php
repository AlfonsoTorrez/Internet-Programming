<?php
    function books($userId){
        include '../dbConnectionFP.php';
        $conn = getDatabaseConnection();
        
        $sql = "SELECT * FROM fp_userlibrary NATURAL JOIN fp_csumblibrary WHERE userId='".$userId."'";
        
        $books = array();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($books);
    
        echo json_encode($books);
    }
    books($_POST['userId']); 
?>