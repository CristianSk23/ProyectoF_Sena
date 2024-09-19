<table class="table-shopping-cart">
    <tr class="table_head">
        <th class="column-1">Producto</th>
        <th class="column-2"></th>
        <th class="column-3">Precio</th>
        <th class="column-4">Cantidad</th>
        <th class="column-5">Total</th>
    </tr>

    <?php
    $total = 0;
    foreach ($productoDetalle as $item) {
        $producto = $item['producto'];
        $cantidad = $item['cantidad'];

        if (isset($item['stock']) && is_array($item['stock']) && count($item['stock']) > 0) {
            $stock = $item['stock'][0];
            $precio = $stock['stock_precio'];
        } else {
            $precio = 0;
        }

        if (isset($item['fotosProd']) && is_array($item['fotosProd']) && count($item['fotosProd']) > 0) {
            $foto = end($item['fotosProd'])['foto_img'];
        }

        $totalProducto = $precio * $cantidad;
        $total += $totalProducto;
        ?>

        <tr class="table_row">
            <td class="column-1">
                <div class="how-itemcart1">
                    <img src="<?php echo $foto; ?>" alt="IMG">
                </div>
            </td>
            <td class="column-2"><?php echo htmlspecialchars($producto['product_nombre']); ?></td>
            <td class="column-3">$ <span class="precio"
                    data-precio="<?php echo $precio; ?>"><?php echo number_format($precio); ?></span></td>
            <td class="column-4">
                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m reducir-carro">
                        <i class="fs-16 zmdi zmdi-minus"></i>
                    </div>


                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                        data-cantidad="<?php echo $cantidad; ?>" value="<?php echo htmlspecialchars($cantidad) ?>"
                        data-producto-id="<?php echo $producto['product_id']; ?>" min="1"
                        max="<?php echo $stock['stock_cantidad']; ?>">

                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m aumentar-carro">
                        <i class="fs-16 zmdi zmdi-plus"></i>
                    </div>
                </div>
            </td>
            <td class="column-5">$ <span class="total-producto"><?php echo number_format($totalProducto); ?></span></td>
            <td>
                <div>
                    <a>
                        <button class="btn btn-danger eliminar-producto"
                            data-url="<?php echo getUrl("CarroDeCompras", "CarroDeCompras", "eliminarProd", false, 'ajax') ?>"
                            data-url-carro="<?php echo getUrl('CarroDeCompras', 'CarroDeCompras', 'obtenerCarroDetalle', array("usu_id" => $_SESSION['usu_id']), 'ajax'); ?>"
                            data-id="<?php echo $producto['product_id']; ?>"
                            data-id-usuario="<?php echo $_SESSION['usu_id']; ?>">
                            <i class="fa-sharp fa-solid fa-trash-can fa-lg" style="color: #fb6a6a;"></i>
                        </button>
                    </a>
                </div>
            </td>
        </tr>
        <input type="hidden" name="producto_ids[]" value="<?php echo $producto['product_id']; ?>">
    <?php } ?>
</table>