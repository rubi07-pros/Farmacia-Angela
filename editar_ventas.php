<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: vender.php");

$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";
$producto = obtenerventasPorId($id);
?>

<div class="container">
    <h3>Editar producto</h3>
    <form method="post">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código de barras</label>
            <input type="text" name="codigo" class="form-control" value="<?php echo $producto->codigo;?>" id="codigo" placeholder="Escribe el código de barras del producto">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o descripción</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $producto->nombre;?>" id="nombre" placeholder="Ej. Papas">
        </div>
        <div class="row">
            <div class="col">
                <label for="venta" class="form-label">Precio</label>
                <input type="number" name="precio" step="any" value="<?php echo $producto->precio;?>" id="compra" class="form-control" placeholder="Precio de compra" aria-label="">
            </div>
            <div class="col">
                <label for="existemcia" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" step="any" value="<?php echo $producto->cantidad;?>" id="venta" class="form-control" placeholder="Precio de venta" aria-label="">
            </div>
            <div class="col">
                <label for="subtotal" class="form-label">Subtotal</label>
                <input type="number" name="subtotal" step="any" value="<?php echo $producto->subtotal;?>" id="existencia" class="form-control" placeholder="Existencia" aria-label="">
            </div>
            
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            
            </input>
            <a href="productos.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['registrar'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $subtotal = $_POST['subtotal'];
    if(empty($codigo) 
    || empty($nombre) 
    || empty($precio) 
    || empty($cantidad)
    || empty($subtotal)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = editarventas($codigo, $nombre, $precio, $cantidad, $subtotal, $id);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del producto registrada con éxito.
        </div>';
    }
    
}
?>