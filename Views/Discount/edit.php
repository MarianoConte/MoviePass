<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-9 form-container mx-auto">
                <h1>Editar Descuento</h1>
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
                <form action="<?php echo FRONT_ROOT ?>/Discount/Edit" method="POST">
                    <input type="hidden" name="id" value="<?php echo $discount->getId(); ?>">
                    <div class="form-group">
                        <label for="percentaje">Porcentaje</label>
                        <input type="number" name="percentaje" value="<?php echo $discount->getPercentaje(); ?>"
                            <?php echo ($discount->getPercentaje() == 0) ? " readonly" : "" ?> class="form-control"
                            id="percentaje" placeholder="25%" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="maximum">Tope</label>
                        <input type="number" name="maximum" value="<?php echo $discount->getMaximum(); ?>"
                            <?php echo ($discount->getPercentaje() == 0) ? " readonly" : "" ?> class="form-control"
                            id="maximum" placeholder="$2000">
                    </div>
                    <div class="form-group">
                        <label for="amount">Cantidad</label>
                        <input type="number" name="amount" value="<?php echo $discount->getAmount(); ?>"
                            <?php echo ($discount->getAmount() == 0) ? " readonly" : "" ?> class="form-control"
                            id="amount" placeholder="$500">
                    </div>
                    <div class="form-group">
                        <label for="dateFrom">Desde el día</label>
                        <input type="date" name="dateFrom" value="<?php echo $discount->getDateFrom(); ?>"
                            class="form-control" id="dateFrom" required>
                    </div>
                    <div class="form-group">
                        <label for="dateTo">Hasta el día</label>
                        <input type="date" name="dateTo" value="<?php echo $discount->getDateTo(); ?>"
                            class="form-control" id="dateTo" required>
                    </div>

                    <?php
                      $weekendArr = array(); 
                      $weekendArr = explode(" ",$discount->getDays()) ;
                    ?>
                    <div class="form-group">
                        <label for="days[]">Días en los que aplica el descuento</label>
                        <select name="days[]" class="form-control" multiple required>
                            <option value="Monday"
                                <?php echo (isset($weekendArr) && in_array('Monday', $weekendArr) ) ? "selected" : "" ?>>
                                Lunes</option>
                            <option value="Tuesday"
                                <?php echo (isset($weekendArr) && in_array('Tuesday', $weekendArr) ) ? "selected" : "" ?>>
                                Martes</option>
                            <option value="Wednesday"
                                <?php echo (isset($weekendArr) && in_array('Wednesday', $weekendArr) ) ? "selected" : "" ?>>
                                Miercoles</option>
                            <option value="Thursday"
                                <?php echo (isset($weekendArr) && in_array('Thursday', $weekendArr) ) ? "selected" : "" ?>>
                                Jueves</option>
                            <option value="Friday"
                                <?php echo (isset($weekendArr) && in_array('Friday', $weekendArr) ) ? "selected" : "" ?>>
                                Viernes</option>
                            <option value="Saturday"
                                <?php echo (isset($weekendArr) && in_array('Saturday', $weekendArr) ) ? "selected" : "" ?>>
                                Sábado</option>
                            <option value="Sunday"
                                <?php echo (isset($weekendArr) && in_array('Sunday', $weekendArr) ) ? "selected" : "" ?>>
                                Domingo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minTickets">Cantidad de tickets</label>
                        <input type="number" name="minTickets" value="<?php echo $discount->getMinTickets(); ?>" class="
                            form-control" id="minTickets" placeholder="2" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="textarea" name="description" value="<?php echo $discount->getDescription(); ?>"
                            class="form-control" id="description" placeholder="Descripcion...">
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