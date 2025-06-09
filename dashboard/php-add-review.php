<?php
include '../uixsoftware/config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $reviewText = $_POST['reviewText'];
    $userName = $_POST['userName'];
    $userRank = $_POST['userRank'];

    // Insertar los datos de la reseña
    $stmt = $conn->prepare("INSERT INTO Recommendations (recommendation_text, user_name, user_rank) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $reviewText, $userName, $userRank);

    if ($stmt->execute()) {
        // Redirigir con mensaje de éxito
        header("Location: reviews.php?status=success");
        exit();
    } else {
        // Redirigir con mensaje de error
        header("Location: reviews.php?status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
