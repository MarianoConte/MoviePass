<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-9">
                <h2 class="m-0">Administración de descuentos</h2>
            </div>
            <div class="col-md-3 text-right position-relative">
                <a class="btn btn-success btn-add"
                    href="<?php echo FRONT_ROOT . '/Discount/ShowAddView'; ?>">Agregar</a>
            </div>
        </div>

        <div class="table-container">
            <table id="discount-list" class="w-100">
                <thead>
                    <th>Porcentaje</th>
                    <th>Tope</th>
                    <th>Cantidad</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Días de la semana</th>
                    <th>Estado</th>
                    <th class="text-right">Acciones</th>
                </thead>
                <tbody>
                    <?php foreach ($discounts as $discount) { ?>
                    <tr class="<?php if (!$discount->getState()) echo 'disabled-row'; ?>">
                        <td><?php echo $discount->getPercentaje(); ?>%</td>
                        <td>$<?php echo $discount->getMaximum(); ?></td>
                        <td>$<?php echo $discount->getAmount(); ?></td>
                        <td><?php echo $discount->getDateFrom(); ?></td>
                        <td><?php echo $discount->getDateTo(); ?></td>
                        <td><?php echo $discount->getDays(); ?></td>
                        <td><?php echo $discount->getState() ? "Habilitado" : "Deshabilitado"; ?></td>
                        <td class="text-right">

                            <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Discount/ShowEditView'; ?>"
                                method="post">
                                <input type="hidden" name="discount_id" value=<?php echo $discount->getId(); ?>>
                                <button type="submit" class="btn btn-sm btn-dark">Editar</button>
                            </form>

                            <?php if ($discount->getState()) { ?>
                            <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Discount/Desactivate'; ?>"
                                method="post">
                                <input type="hidden" name="discount_id" value=<?php echo $discount->getId(); ?>>
                                <button type="submit" class="btn btn-sm btn-danger">Deshabilitar</button>
                            </form>
                            <?php } else { ?>
                            <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Discount/Activate'; ?>"
                                method="post">
                                <input type="hidden" name="discount_id" value=<?php echo $discount->getId(); ?>>
                                <button type="submit" class="btn btn-sm btn-success">Activar</button>
                            </form>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#discount-list').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
});
</script>