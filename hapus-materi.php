<?php
session_start();
require "Database/database.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM materials WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $deleteSuccess = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    if ($deleteSuccess) {
        header('Location: materi.php?status=success');
    } else {
        header('Location: materi.php?status=error');
    }
} else {
    header('Location: materi.php?status=error');
}
?>
