<?php
    function removeBook($bookId){
        include '../dbConnectionFP.php';
        $conn = getDatabaseConnection();
        $sql = "DELETE FROM fp_csumblibrary WHERE fp_csumblibrary.bookId = '".$bookId."'";
        
        $books = array();
        $statement = $conn->prepare($sql);
        $statement->execute();
        //$books = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($books);
    
        //echo json_encode($books);
    }
    removeBook($_POST['bookId']); 
?>