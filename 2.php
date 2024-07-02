<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>Carrito de compras</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-body {
            padding: 10px 16px;
        }

        .modal-footer {
            padding: 10px 16px;
            background-color: #f1f1f1;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: right;
        }

        /* Estilos adicionales */
        .input-field {
            margin-bottom: 10px;
        }

        .input-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-field input {
            width: calc(100% - 20px); /* Considerando el padding de 8px */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }

        .input-field input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .input-field input[type="submit"]:hover {
            background-color: #4caf50;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid #000; /* Borde de la tabla */
            background-color: #000; /* Fondo negro */
            color: #fff; /* Texto blanco */
        }

        th, td {
            border: 1px solid #fff; /* Borde de las celdas */
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333; /* Fondo gris oscuro para las cabeceras */
        }

        /* Alternar color de fondo de filas */
        tr:nth-child(even) {
            background-color: #222; /* Fondo gris oscuro para filas pares */
        }

        /* Centrar texto de las celdas */
        th, td {
            text-align: center;
        }
    </style>
</head>
<body>
    <header id="header">
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="index.php">Inicio</a></li>
                <li class="nav-item"><a href="#">Productos</a></li>
                <li class="nav-item"><a href="#">Contacto</a></li>
                <li class="nav-item"><a href="2.php" id="nav-carrito">Carrito</a></li>
                <li class="nav-item search-bar">
                    <input type="text" placeholder="Buscar...">
                </li>
            </ul>
        </nav>
        <h1>Factura</h1>
    </header>
    <div id="contenedor" class="contenedor">
        <h2>Carrito de compras</h2>
        <table id="tabla-carrito">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h3 id="total"></h3>

        <button id="btnAbrirModal">Finalizar Compra</button>
    </div>
    
    <div id="miModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Confirmar Compra</h2>
            </div>
            <div class="modal-body">
                <form id="formularioCompra" action="guardar_compra.php" method="POST">
                    <div class="input-field">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Nombre">
                    </div>
                    <div class="input-field">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" required placeholder="Apellido">
                    </div>
                    <div class="input-field">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" required placeholder="Correo electrónico">
                    </div>
                    <div class="input-field">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" required placeholder="Teléfono">
                    </div>

                    <!-- Campo oculto para enviar el carrito como JSON -->
                    <input type="hidden" id="carritoInput" name="carrito">

                    <div class="input-field">
                        <input type="submit" value="Confirmar Compra">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Obtén el carrito de compras desde localStorage
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Función para mostrar los productos en la tabla
        function mostrarProductos() {
            const tablaCarrito = document.getElementById('tabla-carrito').getElementsByTagName('tbody')[0];
            tablaCarrito.innerHTML = ''; // Limpiar tabla
            let subtotal = 0;

            carrito.forEach((producto, index) => {
                const row = tablaCarrito.insertRow();
                const cellProducto = row.insertCell(0);
                const cellPrecio = row.insertCell(1);
                cellProducto.textContent = producto.producto;
                cellPrecio.textContent = `$${producto.precio.toFixed(2)}`;

                // Sumar al subtotal
                subtotal += producto.precio;
            });

            const iva = subtotal * 0.15;
            const total = subtotal + iva;

            const totalElement = document.getElementById('total');
            totalElement.innerHTML = `
                Subtotal: $${subtotal.toFixed(2)}<br>
                IVA (15%): $${iva.toFixed(2)}<br>
                Total: $${total.toFixed(2)}
            `;
        }

        // Función para abrir el modal
        function abrirModal() {
            const modal = document.getElementById('miModal');
            modal.style.display = 'block';
        }

        // Función para cerrar el modal
        function cerrarModal() {
            const modal = document.getElementById('miModal');
            modal.style.display = 'none';
        }

        // Mostrar productos al cargar la página
        mostrarProductos();

        // Agregar event listeners para abrir y cerrar el modal
        document.getElementById('btnAbrirModal').addEventListener('click', abrirModal);
        document.querySelector('.close').addEventListener('click', cerrarModal);

        // Enviar el formulario de compra
        document.getElementById('formularioCompra').addEventListener('submit', function(event) {
            event.preventDefault();
            carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Rellenar el campo oculto con el carrito como JSON
            document.getElementById('carritoInput').value = JSON.stringify(carrito);

            // Enviar el formulario
            fetch('guardar_compra.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    localStorage.removeItem('carrito'); // Limpiar carrito
                    window.location.reload(); // Recargar la página
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Cerrar el modal cuando el usuario haga clic fuera del contenido del modal
        window.onclick = function(event) {
            const modal = document.getElementById('miModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    </script>
</body>
</html>
