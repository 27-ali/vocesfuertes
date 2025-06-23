<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $edad = intval($_POST["edad"]);
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $estado = htmlspecialchars(trim($_POST["estado"]));
    $municipio = htmlspecialchars(trim($_POST["municipio"]));
    $colonia = htmlspecialchars(trim($_POST["colonia"]));
    $tipo_violencia = htmlspecialchars(trim($_POST["tipo_violencia"]));
    $fecha_suceso = $_POST["fecha_suceso"];
    $descripcion = htmlspecialchars(trim($_POST["descripcion"]));
    $conoce_agresor = $_POST["conoce_agresor"];

    if (empty($nombre) || empty($estado) || empty($municipio) || empty($colonia) || empty($tipo_violencia) || empty($descripcion)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.location.href='../index.html';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO denuncias (nombre, edad, fecha_nacimiento, estado, municipio, colonia, tipo_violencia, fecha_suceso, descripcion, conoce_agresor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissssssss", $nombre, $edad, $fecha_nacimiento, $estado, $municipio, $colonia, $tipo_violencia, $fecha_suceso, $descripcion, $conoce_agresor);

        if ($stmt->execute()) {
            echo "<script>alert('Denuncia guardada correctamente.'); window.location.href='../index.html';</script>";
        } else {
            echo "<script>alert('Error al guardar la denuncia.'); window.location.href='../index.html';</script>";
        }
        $stmt->close();
    }
}

$conn->close();
