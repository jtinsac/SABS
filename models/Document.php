<?php
require_once 'config/database.php';

function getOutgoingDocuments() {
    global $conn;
    $result = mysqli_query($conn, "SELECT transactionID, officeName, sender_name, document_title, document_type, delivery_status, created_at FROM documents WHERE delivery_status = 'sent'");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addDocument($officeName, $sender_name, $document_title, $email_address, $delivery_address, $document_type, $proof_of_document) {
    global $conn;
    
    $sql = "INSERT INTO documents (officeName, sender_name, document_title, email_address, delivery_address, document_type, proof_of_document, proof_of_document_filename, delivery_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'sent')";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssss', 
        $officeName, 
        $sender_name, 
        $document_title, 
        $email_address, 
        $delivery_address, 
        $document_type, 
        $proof_of_document['data'],
        $proof_of_document['filename']
    );
    
    return mysqli_stmt_execute($stmt);
}
