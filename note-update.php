<?php

include 'Database.php';
include 'utils.php';

$db = new Database();

$note = null;

$method = $_POST['_method'] ?? '';


// ----Handles fetching note to update----
$id = $_GET['id'];


$note = $db->query("SELECT * FROM note WHERE Id = :id", [':id' => $id])->find();

if (!$note) {
  header('Location: notes.php');
}
// ---------------------------------------

// ----Handles note update----
if ($method === 'PUT') {
  $id = $_POST['Id'];
  $body = $_POST['body'];

  $errors = [];

  if (empty($body)) {
    $errors['body'] = "Body is required";
  }

  if (empty($errors)) {
    $db->query("UPDATE note SET body = :body WHERE Id = :Id", [':body' => $body, ':Id' => $id]);

    header('Location: notes.php');
  }
}
// ----------------------------

$navTitle = "Update Note";

include 'views/note-create-update.view.php';