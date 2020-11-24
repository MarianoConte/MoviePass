<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-9 form-container mx-auto">
                <h1>Registrar descuento</h1>
                <hr>
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

                <form action="<?php echo FRONT_ROOT ?>/Discount/Add" method="POST">
                    <div class="form-group">
                        <label for="percentaje">Porcentaje</label>
                        <input type="number" name="percentaje" class="form-control" id="percentaje" placeholder="25%"
                            min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="maximum">Tope</label>
                        <input type="number" name="maximum" class="form-control" id="maximum" placeholder="$2000">
                    </div>
                    <div class="form-group">
                        <label for="amount">Cantidad</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="$500">
                    </div>
                    <div class="form-group">
                        <label for="dateFrom">Desde el día</label>
                        <input type="date" name="dateFrom" class="form-control" id="dateFrom" required>
                    </div>
                    <div class="form-group">
                        <label for="dateTo">Hasta el día</label>
                        <input type="date" name="dateTo" class="form-control" id="dateTo" required>
                    </div>
                    <div class="form-group">
                        <label for="days[]">Días en los que aplica el descuento</label>
                        <select name="days[]" class="form-control" multiple required>
                            <option value="Monday">Lunes</option>
                            <option value="Tuesday">Martes</option>
                            <option value="Wednesday">Miercoles</option>
                            <option value="Thursday">Jueves</option>
                            <option value="Friday">Viernes</option>
                            <option value="Saturday">Sábado</option>
                            <option value="Sunday">Domingo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minTickets">Cantidad de tickets</label>
                        <input type="number" name="minTickets" class="form-control" id="minTickets" placeholder="2"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="textarea" name="description" class="form-control" id="description"
                            placeholder="Descripcion...">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-2">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#dateFrom').change(function() {
    $('#dateTo').attr('min', $(this).val());
});

$('#dateTo').change(function() {
    $('#dateFrom').attr('max', $(this).val());
});

$('#percentaje').change(function() {
    if ($('#percentaje').val()) {
        $('#amount').removeAttr('placeholder');
        $('#amount').attr('readonly', 'readonly');
        $('#amount').attr('value', '0');

    } else {
        $('#amount').prop("readonly", false);
        $('#amount').attr('placeholder', '$2000');
    }
});

$('#amount').change(function() {
    if ($('#amount').val()) {
        $('#percentaje').removeAttr('placeholder');
        $('#percentaje').attr('readonly', 'readonly');
        $('#percentaje').attr('value', '0');
        $('#maximum').removeAttr('placeholder');
        $('#maximum').attr('readonly', 'readonly');
        $('#maximum').attr('value', '0');
    } else {
        $('#percentaje').prop("readonly", false);
        $('#maximum').prop("readonly", false);
        $('#percentaje').attr('placeholder', '25%');
        $('#maximum').attr('placeholder', '$500');
    }
});
</script>