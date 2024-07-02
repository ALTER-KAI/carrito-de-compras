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
</head>

<body>
    <header id="header">
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="#">Inicio</a></li>
                <li class="nav-item"><a href="#">Productos</a></li>
                <li class="nav-item"><a href="#">Contacto</a></li>
                <li class="nav-item"><a href="2.php" id="nav-carrito">Carrito</a></li>
                <li class="nav-item search-bar">
                    <input type="text" placeholder="Buscar...">
                </li>
            </ul>
        </nav>
        <h1>Shopping Car</h1>
        <img class="carrito" src="img/carrito-de-compras.png" alt="carrito">
    </header>
    <div id="contenedor" class="contenedor">
        <div>
            <img src="img/imagen1.webp" alt="producto 1">
            <div class="informacion">
                <p>Producto 1</p>
                <p class="precio">$199<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 1', 199.99, 'img/imagen1.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen2.webp" alt="producto 2">
            <div class="informacion">
                <p>Producto 2</p>
                <p class="precio">$299<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 2', 299.99, 'img/imagen2.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen3.webp" alt="producto 3">
            <div class="informacion">
                <p>Producto 3</p>
                <p class="precio">$399<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 3', 399.99, 'img/imagen3.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen4.webp" alt="producto 4">
            <div class="informacion">
                <p>Producto 4</p>
                <p class="precio">$499<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 4', 499.99, 'img/imagen4.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen5.webp" alt="producto 5">
            <div class="informacion">
                <p>Producto 5</p>
                <p class="precio">$599<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 5', 599.99, 'img/imagen5.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen6.webp" alt="producto 6">
            <div class="informacion">
                <p>Producto 6</p>
                <p class="precio">$699<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 6', 699.99, 'img/imagen6.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen7.webp" alt="producto 7">
            <div class="informacion">
                <p>Producto 7</p>
                <p class="precio">$799<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 7', 799.99, 'img/imagen7.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen8.webp" alt="producto 8">
            <div class="informacion">
                <p>Producto 8</p>
                <p class="precio">$899<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 8', 899.99, 'img/imagen8.webp')">Comprar</button>
            </div>
        </div>
        <div>
            <img src="img/imagen9.webp" alt="producto 9">
            <div class="informacion">
                <p>Producto 9</p>
                <p class="precio">$999<span>.99</span></p>
                <button onclick="agregarAlCarrito('Producto 9', 999.99, 'img/imagen9.webp')">Comprar</button>
            </div>
        </div>
    </div>

    <script>
        function agregarAlCarrito(producto, precio, imagen) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito.push({ producto, precio, imagen });
            localStorage.setItem('carrito', JSON.stringify(carrito));
            window.location.href = '2.php';
        }
    </script>
</body>

</html>
