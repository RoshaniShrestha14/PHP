<?php

include 'Database.php';
include 'utils.php';

$db = new Database();

$note = null;

$method = $_POST['_method'] ?? '';

// ----Handles fetching note to update----
$Id = $_GET['Id'];

$note = $db->query("SELECT * FROM note WHERE Id = :Id", [':Id' => $Id])->find();

if (!$note) {
  header('Location: notes.php');
}
// ---------------------------------------

// ----Handles note update----
if ($method === 'PUT') {
  $Id = $_POST['Id'];
  $Body = $_POST['Body'];

  $errors = [];

  if (empty($Body)) {
    $errors['Body'] = "Body is required";
  }

  if (empty($errors)) {
    $db->query("UPDATE note SET Body = :Body WHERE Id = :Id", [':Body' => $Body, ':Id' => $Id]);

    header('Location: notes.php');
  }
}
// ----------------------------

$navTitle = "Update Note";

include 'views/note-create-update.view.php';