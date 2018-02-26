<?php

require_once("../../connect.php");
require_once('../../services/DocService.php');

if (isset($_POST['doc-id'])) {
    $docID = $_POST['doc-id'];

    DocService::Instance()->deleteDoc($docID);
} else {
    $_SESSION['error'] = 'Please enter a Doctor ID';
}

// Redirect where needed
if (isset($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
}