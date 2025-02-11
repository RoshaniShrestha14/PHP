<?php

include 'Database.php';
include 'utils.php';

$db = new Database();

// ----Handles note creation----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Body = $_POST['Body'];

  $errors = [];

  if (empty($Body)) {
    $errors['Body'] = "Body is required";
  }
  if (empty($errors)) {
    $db->query("INSERT INTO note (Body) VALUES (:Body)", [':Body' => $Body]);

    header('Location: notes.php');
  }
}
$navTitle = "Create Note";
include 'views/note-create-update.view.php';