<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';
    
    // ============================================================
    // READ FUNCTIONS
    // ============================================================

    function getAllFrequency() {
        $db = dbConnect();
        $sql = 'SELECT * FROM frequency';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }

?>