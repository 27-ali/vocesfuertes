<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $experiencia = htmlspecialchars(trim($_POST["experiencia"]));

    if (empty($experiencia)) {
        echo "<script>alert('No puedes enviar una historia vacía.'); window.location.href='../index.html';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO historias (experiencia) VALUES (?)");
        $stmt->bind_param("s", $experiencia);

        if ($stmt->execute()) {
            echo "<script>alert('Historia guardada correctamente.'); window.location.href='../index.html';</script>";
        } else {
            echo "<script>alert('Error al guardar la historia.'); window.location.href='../index.html';</script>";
        }
        $stmt->close();
    }
}

$conn->close();
