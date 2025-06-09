<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Verificar si el comentario existe
    $sqlCheck = "SELECT * FROM Recommendations WHERE recommendation_id = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param('i', $id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        // Eliminar el comentario
        $sql = "DELETE FROM Recommendations WHERE recommendation_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo "Comentario eliminado exitosamente.";
        } else {
            echo "Error al eliminar el comentario: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Comentario no encontrado.";
    }

    $stmtCheck->close();
    $conn->close();

    // Redirigir de nuevo a la página de administración de comentarios
    header("Location: reviews.php?status=success");
    exit();
} else {
    echo "ID de comentario no proporcionado o método no permitido.";
}
?>
