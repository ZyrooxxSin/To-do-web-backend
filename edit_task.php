<?php
include 'db_todo.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        echo "Tugas tidak ditemukan!";
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTask = trim($_POST['task']);
    if (!empty($newTask)) {
        $stmt = $pdo->prepare("UPDATE tasks SET task = :task WHERE id = :id");
        $stmt->execute(['task' => $newTask, 'id' => $id]);
    }
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>
    <form action="" method="post">
        <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Kembali ke daftar tugas</a>
</body>
</html>
