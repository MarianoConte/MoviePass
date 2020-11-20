<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-8">
                <h2 class="m-0">Administración de funciones</h2>
            </div>
            <div class="col-md-4 text-right position-relative">
                <a class="btn btn-primary btn-add mr-3"
                    href="<?php echo FRONT_ROOT . '/Show/ShowTicketsSelledView'; ?>">Entradas vendidas</a>
                <a class="btn btn-success btn-add" href="<?php echo FRONT_ROOT . '/Show/ShowAddView'; ?>">Agregar</a>
            </div>
        </div>

        <div class="table-container">
            <table id="show-list" class="w-100">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Fecha</th>
                    <th>Costo</th>
                    <th class="text-right">Acciones</th>
                </thead>
                <tbody>
                    <?php foreach ($shows as $show) { ?>
                    <tr>
                        <td><?php echo $show->getTheater(); ?></td>
                        <td><?php echo $show->getRoom(); ?></td>
                        <td><?php echo $show->getMovie(); ?></td>
                        <td><?php echo date_format(date_create($show->getDate()), 'd/m/Y H:i'); ?></td>
                        <td>$<?php echo $show->getPrice(); ?></td>
                        <td class="text-right">

                            <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Show/Delete'; ?>"
                                method="post">
                                <input type="hidden" name="show_id" value=<?php echo $show->getId(); ?>>
                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                            </form>

                            <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Show/ShowEditView'; ?>"
                                method="post">
                                <input type="hidden" name="show_id" value=<?php echo $show->getId(); ?>>
                                <button type="submit" class="btn btn-sm btn-dark">Editar</button>
                            </form>


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
    $('#show-list').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
});
</script>