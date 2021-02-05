<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';
    
    // ============================================================
    // INSERT FUNCTIONS
    // ============================================================

    function addLog($userid, $useraction){
        $db = dbConnect();
        $sql = 'INSERT INTO logs (userid, useraction) VALUES (:userid, :useraction)';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':useraction', $useraction, PDO::PARAM_STR);

        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }
    
    // ============================================================
    // READ FUNCTIONS
    // ============================================================

    function getAllLogs() {
        $db = dbConnect();
        $sql = 'SELECT * FROM logs';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }
    

?>