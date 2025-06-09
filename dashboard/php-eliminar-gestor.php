<?php
include '../uixsoftware/config/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Verificar si el gestor está activo
    $sqlCheck = "SELECT activo FROM Gestores WHERE id = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param('i', $id);
    $stmtCheck->execute();
    $stmtCheck->bind_result($activo);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($activo) {
        echo "No se puede eliminar un gestor activo. Cambia a otro gestor antes de eliminarlo.";
        // Redirigir de nuevo a la página de administración de gestores
        header("Location: gestores.php?status=error&message=active_gestor");
        exit();
    } else {
        $sql = "DELETE FROM Gestores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo "Gestor eliminado exitosamente.";
        } else {
            echo "Error al eliminar el gestor: " . $conn->error;
        }

        $stmt->close();
        $conn->close();

        // Redirigir de nuevo a la página de administración de gestores
        header("Location: reservas.php?status=success");
        exit();
    }
}
?>
