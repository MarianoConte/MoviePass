<div class="dark-background section-container">
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h2 class="text-white m-0">Historial de compras</h2>
                </div>
            </div>
            <div class="table-container">
                <?php foreach($responses as $response) { ?>
                <?php if($response->isSuccess()) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $response->getMessage(); ?>
                </div>
                <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $response->getMessage(); ?>
                </div>
                <?php } ?>
                <?php } ?>
                <table id="tickets-list" class="w-100">
                    <thead>
                        <th>Fecha</th>
                        <th>Película</th>
                        <th>Cine</th>
                        <th>Sala</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket) { ?>
                        <tr>
                            <td><?php echo date_format(date_create($ticket->getDate()), 'd/m/Y H:i'); ?></td>
                            <td><?php echo $ticket->getShow()->getMovie()->getName(); ?></td>
                            <td><?php echo $ticket->getShow()->getTheater()->getName(); ?></td>
                            <td><?php echo $ticket->getShow()->getRoom()->getName(); ?></td>
                            <td>$<?php echo $ticket->getPrice(); ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-view-token w-100"
                                    data-token="<?php echo $ticket->getToken(); ?>">Ver código</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-token" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Código de entrada</h5>
            </div>
            <div class="modal-body">
                <div id="qr-token"></div>
                <p id="token" class="mt-3 text-center"></p>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo JS_PATH ?>/plugins/qrcode.min.js"></script>
<script>
$(document).ready(function() {
    $('#tickets-list').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "order": [
            [0, 'desc']
        ]
    });
});

$('.btn-view-token').click(function() {
    document.getElementById("qr-token").innerHTML = '';
    document.getElementById("token").innerText = $(this).data('token');
    new QRCode(document.getElementById("qr-token"), $(this).data('token'));
    $('#modal-token').modal();
});
</script>