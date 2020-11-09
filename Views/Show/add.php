<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-9 form-container mx-auto">
                <h1>Registrar función</h1>
                <hr>
                <?php foreach ($responses as $response) { ?>
                <?php if ($response->isSuccess()) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $response->getMessage(); ?>
                </div>
                <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $response->getMessage(); ?>
                </div>
                <?php } ?>
                <?php } ?>
                <form action="<?php echo FRONT_ROOT . '/Show/Add'; ?>" method="POST">
                    <div class="form-group">
                        <label for="theater">Cine</label>
                        <select name="theater" class="form-control" required onchange="setRooms()" id="theatersSelect">
                            <option value="" selected>Elegir cine </option>
                            <?php foreach($theaters as $theater){
                              echo '<option value="'.$theater->getId().'">'.$theater->getName().'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room">Sala</label>
                        <select name="room" class="form-control" id="roomsSelect" required disabled>
                            <option value="" selected>Elegir sala </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="movie">Cine</label>
                        <select name="movie" class="form-control" required id="moviesSelect">
                            <option value="" selected>Elegir película </option>
                            <?php foreach($movies as $movie){
                              echo '<option value="'.$movie->getId().'">'.$movie->getName().'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Precio de la entrada</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="$" maxlength="150"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha y horario</label>
                        <input type="datetime-local" name="date" class="form-control" id="date" maxlength="150"
                            required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-2">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function setRooms() {
    var theaterSelected = document.querySelector('#theatersSelect').value;

    var roomsSelect = document.querySelector('#roomsSelect');
    while (roomsSelect.firstChild) {
        roomsSelect.removeChild(roomsSelect.lastChild);
    }

    if (theaterSelected !== "") {

        document.cookie = 'theater=' + theaterSelected;
        var theaters = [
            <?php foreach($theaters as $indextheater => $theater){
              $roomsjs = $theater->getRooms();
              echo '{id:'.json_encode($theater->getId()).', rooms:[';

              foreach($roomsjs as $indexroom => $room){
               echo '{room_id:'.json_encode($room->getId()).', name:'.json_encode($room->getName()).'}';
               if($indexroom != count($roomsjs)-1)echo ',';
              }
              echo ']}';
              if($indextheater != count($theaters)-1)echo ',';
        }?>
        ]

        var theaters = theaters.filter(function(theater) {
            return theater.id === theaterSelected
        });

        var rooms = theaters[0].rooms;

        roomsSelect.removeAttribute('disabled');

        rooms.map(room => {
            var option = document.createElement('option');
            option.value = room.room_id;
            option.innerHTML = room.name;
            roomsSelect.appendChild(option);
        })

    } else {

        roomsSelect.setAttribute('disabled', "");
        var option = document.createElement('option');
        option.value = "";
        option.innerHTML = "Elegir sala";
        roomsSelect.appendChild(option);
    }

}
</script>