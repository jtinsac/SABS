<?php
require_once 'models/Document.php';

function add_document() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        return;
    }

    $officeName       = $_POST['officeName'];
    $sender_name      = $_POST['sender_name'];
    $document_title   = $_POST['document_title'];
    $email_address    = $_POST['email_address'];
    $delivery_address = $_POST['delivery_address'];
    $document_type    = $_POST['document_type'];

    if (empty($officeName) || empty($sender_name) || empty($document_title) || empty($email_address) || empty($delivery_address) || empty($document_type)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        return;
    }

    if (!isset($_FILES['proof_of_document']) || $_FILES['proof_of_document']['error'] != 0) {
        echo json_encode(['success' => false, 'message' => 'Proof of document is required.']);
        return;
    }

    $proof_of_document = [
        'data'     => file_get_contents($_FILES['proof_of_document']['tmp_name']),
        'filename' => $_FILES['proof_of_document']['name']
    ];

    $result = addDocument($officeName, $sender_name, $document_title, $email_address, $delivery_address, $document_type, $proof_of_document);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Document added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add document.']);
    }
}
