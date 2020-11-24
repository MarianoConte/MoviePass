<div class="dark-background section-container">
    <div class="container-fluid buy-tickets py-3">
        <div class="container">
            <h1>
                <strong>Reserva de asientos</strong>
            </h1>
            <div class="row">
                <div class="col-md-6 pr-2">
                    <div class="card-movie-details py-2 px-3 mt-2">
                        <h3 class="m-0">Película</h3>
                        <hr class="my-2">
                        <h3 class="mt-0 mb-2">
                            <strong><?php echo $show->getMovie()->getName(); ?></strong>
                        </h3>
                        <p>
                            <?php echo $show->getMovie()->getDescription(); ?>
                        </p>
                        <p>
                            Género: <?php echo $show->getMovie()->getGenre(); ?>.
                        </p>
                        <p>
                            Duración: <?php echo $show->getMovie()->getDuration(); ?> minútos.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 pl-2">
                    <div class="card-movie-details py-2 px-3 mt-2">
                        <h3 class="m-0">Función</h3>
                        <hr class="my-2">
                        <h3 class="mt-0 mb-2">
                            <strong><?php echo $show->getTheater()->getName(); ?></strong>
                        </h3>
                        <h5>
                            Fecha y horario: <?php echo date("d/m/Y H:i", strtotime($show->getDate())); ?>
                        </h5>
                        <h5>
                            Dirección: <?php echo $show->getTheater()->getAddress(); ?>
                        </h5>
                        <h5>
                            Sala: <?php echo $show->getRoom()->getName(); ?>
                        </h5>
                        <h5>
                            Asientos: <?php echo $show->getRoom()->getSeats(); ?>
                        </h5>
                    </div>
                </div>
            </div>
            <?php if($show->getAvailableTickets() > 0) { ?>
            <?php if(isset($_SESSION['user'])) { ?>
            <form action="<?php echo FRONT_ROOT ?>/Home/BuyTickets" method="POST" id="form-payment"
                class="row payment-info mt-3 m-0">
                <input type="hidden" name="show_id" value="<?php echo $show->getId(); ?>">
                <div class="col-12">
                    <h3 class="mt-3 mb-0">Datos de compra</h3>
                    <hr class="my-2">
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
                </div>
                <div class="col-md-2 my-3">
                    <div class="form-group">
                        <label for="quantity" class="w-100 text-center">Entradas</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            placeholder="Max: <?php echo $show->GetAvailableTickets(); ?>" onchange="setPrice()" min="1"
                            max="<?php echo $show->GetAvailableTickets(); ?>" required>

                    </div>
                    <div class="form-group">
                        <label for="discount">Descuento</label>
                        <select name="discount" class="form-control" onchange="setPrice()" id="discountSelect">
                            <option value="" selected>Elegir descuento </option>
                            <?php foreach($discounts as $discount){
                              if($discount->getPercentaje()>0){
                                echo '<option value="'.$discount->getId().'">'.$discount->getPercentaje().'%. '.$discount->getDescription().
                                ' Min. Entradas: '.$discount->getMinTickets().'. Tope: '.(($discount->getMaximum()>0)? '$'.$discount->getMaximum().'. ' : 'Sin tope. ').'</option>';
                              }
                              else{
                                echo '<option value="'.$discount->getId().'">$'.$discount->getAmount().'. '.$discount->getDescription().' Min. Entradas:'.$discount->getMinTickets().'.</option>';
                              }
                            }
                        ?>
                        </select>
                    </div>
                    <h1 id="total-price" class="tickets-total-price text-center mt-2">$0</h1>
                </div>
                <div class="col-md-6 my-3">
                    <div class="row card-details">
                        <div class="form-group col-md-9">
                            <label for="number">Número de tarjeta</label>
                            <input type="text" name="number" id="number" class="form-control" placeholder="Número"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="expiry">Vencimiento</label>
                            <input type="text" name="expiry" id="expiry" class="form-control" placeholder="Vencimiento"
                                required>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="name">Nombre y apellido</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Nombre y apellido" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cvc">CVC</label>
                            <input type="text" name="cvc" id="cvc" class="form-control" placeholder="CVC" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 card-wrapper my-3"></div>
                <div class="col-12">
                    <button type="submit" class="btn btn-confirm-payment">Comprar</button>
                </div>
            </form>
            <?php } else { ?>
            <form action="<?php echo FRONT_ROOT ?>/User/ShowLoginView" id="form-payment"
                class="row payment-info mt-3 m-0">
                <div class="col-12">
                    <h3 class="mt-3 mb-0">Datos de compra</h3>
                    <hr class="my-2">
                    <h5 class="mb-2">Debes iniciar sesión para realizar la reserva</h5>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-confirm-payment">Iniciar sesión</button>
                </div>
            </form>
            <?php } ?>
            <?php } else { ?>
            <div class="row payment-info mt-3 m-0">
                <h3 class="my-3 w-100 text-center">Entradas agotadas</h3>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="<?php echo JS_PATH ?>/plugins/jquery.card.js"></script>
<script>
$('#form-payment').card({
    container: '.card-wrapper'
});

/*$('#quantity').change(() => {
    $('#total-price').html('$' + $('#quantity').val() * <?php echo $show->getPrice(); ?>);
});*/

function setPrice() {

    var discountSelect = document.querySelector('#discountSelect').value;

    var quantity = document.querySelector('#quantity').value;

    if (discountSelect !== "") {

        document.cookie = 'discount=' + discountSelect;
        var discounts = [
            <?php foreach($discounts as $indexdiscount => $discount){
          echo '{id:'.json_encode($discount->getId()).', ';
          echo 'percentaje:'.json_encode($discount->getPercentaje()).', ';
          echo 'maximum:'.json_encode($discount->getMaximum()).', ';
          echo 'amount:'.json_encode($discount->getAmount()).', ';
          echo 'minTickets:'.json_encode($discount->getMinTickets());
          echo '}';
          if($indexdiscount != count($discounts)-1)echo ',';
    }?>
        ]

        var discount = discounts.filter(function(discount) {
            return discount.id === discountSelect
        });

        discount = discount[0];

        if (discount.minTickets > quantity) {
            document.querySelector('#discountSelect').value = '';
            document.querySelector("#total-price").innerHTML = '$' + document.querySelector("#quantity").value *
                <?php echo $show->getPrice(); ?>;
        } else {

            var finalDiscount;

            if (discount.percentaje > 0) {
                var discountAmount = <?php echo $show->getPrice(); ?> * quantity * discount.percentaje / 100
                if (discount.maximum != 0 && discount.maximum < discountAmount) {

                    finalDiscount = <?php echo $show->getPrice(); ?> * quantity - discount.maximum;
                    document.querySelector("#total-price").innerHTML = '$' + finalDiscount;
                } else {

                    finalDiscount = <?php echo $show->getPrice(); ?> * quantity - discountAmount;
                    document.querySelector("#total-price").innerHTML = '$' + finalDiscount;
                }
            } else {
                finalDiscount = <?php echo $show->getPrice(); ?> * quantity - discount.amount;
                document.querySelector("#total-price").innerHTML = '$' + finalDiscount;
            }

        }


    } else {
        var finalDiscount = <?php echo $show->getPrice(); ?> * quantity;
        document.querySelector("#total-price").innerHTML = '$' + finalDiscount;
    }

}

$('#quantity').keyup(() => {
    $('#total-price').html('$' + $('#quantity').val() * <?php echo $show->getPrice(); ?>);
});
</script>