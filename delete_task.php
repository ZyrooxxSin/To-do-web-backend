<?php
include 'db_todo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
header('Location: index.php');
exit();
?>
