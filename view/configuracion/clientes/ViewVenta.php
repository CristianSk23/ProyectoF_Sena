<div class="container rounded bg-white mt-5 mb-5">
    <div class="col-md-8">
        <div class="border p-3 py-5" id="historial">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Historial de compras</h4>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <table class="table table-responsive">
                        <thead> 
                            <tr>
                                <th scope="col">Código de Venta</th>
                                <th>Nombre cliente</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($historial)) : ?>
                                <?php foreach ($historial as $venta) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($venta['idVenta']); ?></td>
                                        <td><?= htmlspecialchars($venta['usu_nombre']); ?></td>
                                        <td><?= htmlspecialchars($venta['totalVenta']); ?></td>
                                        <td><a target="_blank" href="<?= getUrl("CarroDeCompras", "Venta", "imprimir", array("idVenta" => $venta['idVenta']), 'ajax'); ?>" class="btn btn-primary"><i class="fa-solid fa-print" style="color: #74C0FC;"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4">No hay compras registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
