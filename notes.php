<?php
include 'Database.php'; 
include 'utils.php';

$db = new Database();
// ----Handles note deletion----
$method = $_POST['_method'] ?? '';

if ($method === 'DELETE') {
  $id = $_POST['Id'];

  $db->query("DELETE FROM note WHERE Id = :Id", [':Id' => $id]);

  header('Location: notes.php');
}

$statement =$db->query("SELECT * FROM note");


$notes=$statement->fetchAll();
// dd($notes);


$navTitle="Notes";
include 'views/notes.view.php';

