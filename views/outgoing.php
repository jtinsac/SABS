<?php if (!isset($_SESSION['username'])) { header('Location: index.php?page=login'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outgoing Documents</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-file-label { display: block; text-align: left; margin: 0.5rem 1.5rem 0.25rem; font-size: 0.9rem; }
        input[type="file"].swal2-input { padding: 0.3rem; cursor: pointer; }
        #addDocForm { text-align: left; }
        #addDocForm input, #addDocForm select { display: block; width: 90%; margin: 0.4rem auto; }
    </style>
</head>
<body>
    <header class="header">
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="index.php?page=logout">Logout</a>
    </header>
    <div class="layout">
        <?php require_once 'includes/sidebar.php'; ?>
        <main class="main">
            <h2>Outgoing Documents</h2>
            <br>
            <button class="btn-add" onclick="openAddDocument()">+ Add Document</button>
            <br><br>
            <?php
                require_once 'models/Document.php';
                $documents = getOutgoingDocuments();
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Office</th>
                        <th>Sender</th>
                        <th>Document Title</th>
                        <th>Document Type</th>
                        <th>Status</th>
                        <th>Date Sent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($documents)): ?>
                        <tr><td colspan="7">No outgoing documents found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($documents as $doc): ?>
                            <tr>
                                <td><?= $doc['transactionID'] ?></td>
                                <td><?= htmlspecialchars($doc['officeName']) ?></td>
                                <td><?= htmlspecialchars($doc['sender_name']) ?></td>
                                <td><?= htmlspecialchars($doc['document_title']) ?></td>
                                <td><?= htmlspecialchars($doc['document_type']) ?></td>
                                <td><?= htmlspecialchars($doc['delivery_status']) ?></td>
                                <td><?= $doc['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>

    <script>
        function openAddDocument() {
            Swal.fire({
                title: 'Add Document',
                width: 600,
                html: `
                    <form id="addDocForm" enctype="multipart/form-data">
                        <input class="swal2-input" type="text" name="officeName" placeholder="Office Name" required><br>
                        <input class="swal2-input" type="text" name="sender_name" placeholder="Sender Name" required><br>
                        <input class="swal2-input" type="text" name="document_title" placeholder="Document Title" required><br>
                        <input class="swal2-input" type="email" name="email_address" placeholder="Email Address" required><br>
                        <input class="swal2-input" type="text" name="delivery_address" placeholder="Delivery Address" required><br>
                        <select class="swal2-input" name="document_type" required>
                            <option value="" disabled selected>Select Document Type</option>
                            <option value="memo">Memo</option>
                            <option value="letter">Letter</option>
                            <option value="report">Report</option>
                            <option value="form">Form</option>
                            <option value="other">Other</option>
                        </select><br>
                        <label class="swal2-file-label">Proof of Document</label>
                        <input class="swal2-input" type="file" name="proof_of_document" accept="image/*,.pdf" required><br>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                preConfirm: () => {
                    const form = document.getElementById('addDocForm');
                    const formData = new FormData(form);

                    return fetch('index.php?page=add_document', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.showValidationMessage(data.message);
                        }
                        return data;
                    });
                }
            }).then(result => {
                if (result.isConfirmed && result.value.success) {
                    Swal.fire('Success', 'Document added successfully!', 'success');
                }
            });
        }
    </script>
</body>
</html>
