<?php
$servername = "localhost";
$username = "root"; // Asegúrate de usar el nombre de usuario correcto
$password = ""; // Asegúrate de usar la contraseña correcta
$dbname = "carrito_compras";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$carrito = json_decode($_POST['carrito'], true);

// Insertar datos en la tabla de compras
$sql = "INSERT INTO compras (nombre, apellido, correo, telefono) VALUES ('$nombre', '$apellido', '$correo', '$telefono')";

if ($conn->query($sql) === TRUE) {
    $compra_id = $conn->insert_id; // Obtener el ID de la compra insertada

    // Insertar cada producto en la tabla de detalles de compra
    foreach ($carrito as $producto) {
        $producto_nombre = $producto['producto'];
        $producto_precio = $producto['precio'];
        $sql_detalle = "INSERT INTO detalles_compra (compra_id, producto, precio) VALUES ('$compra_id', '$producto_nombre', '$producto_precio')";
        $conn->query($sql_detalle);
    }

    $response = array("success" => true, "message" => "Compra guardada exitosamente.");
} else {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

// Enviar respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
