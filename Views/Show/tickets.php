<div class="container-fluid white-background section-container py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-9 form-container mx-auto">
                <h1>Entradas vendidas</h1>
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
                <form action="<?php echo FRONT_ROOT . '/Show/GetTicketsSelled'; ?>" method="POST">
                    <div class="form-group">
                        <label for="movie">Pelicula</label>
                        <select name="movie" class="form-control" required onchange='setTheaters()' id="moviesSelect">
                            <option value="" selected>Elegir película </option>
                            <?php foreach($movies as $movie){
                              echo '<option value="'.$movie->getId().'">'.$movie->getName().'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="theater">Cine</label>
                        <select name="theater" class="form-control" id="theatersSelect" onchange="setSchedules()"
                            required disabled>
                            <option value="" selected>Elegir cine </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schedule">Horario</label>
                        <select name="schedule" class="form-control" id="schedulesSelect" required disabled>
                            <option value="" selected>Elegir horario </option>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-2">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function setTheaters() {

    var movieSelected = document.querySelector('#moviesSelect').value;

    console.log(movieSelected);
    var theatersSelect = document.querySelector('#theatersSelect');

    var schedulesSelect = document.querySelector('#schedulesSelect');

    while (theatersSelect.firstChild) {
        theatersSelect.removeChild(theatersSelect.lastChild);
    }

    var option = document.createElement('option');
    option.value = "";
    option.innerHTML = "Elegir cine";
    theatersSelect.appendChild(option);

    while (schedulesSelect.firstChild) {
        schedulesSelect.removeChild(schedulesSelect.lastChild);
    }

    var option = document.createElement('option');
    option.value = "";
    option.innerHTML = "Elegir horario";
    schedulesSelect.appendChild(option);

    if (movieSelected !== "") {

        document.cookie = 'movie=' + movieSelected;
        var shows = [
            <?php foreach($shows as $indexshows => $show){
              $theater = $show->getTheater();
              $movie = $show->getMovie();
              echo '{idMovie:'.json_encode($show->getMovie()->getId()).', 
                idTheater:'.json_encode($theater->getId()).',
                theaterName:'.json_encode($theater->getName()).'}';
                if($indexshows != count($shows)-1){
                    echo ',';
                  }
        }?>
        ]

        console.log(shows);

        shows = shows.filter(function(show) {
            return show.idMovie === movieSelected
        });

        console.log(shows);

        jsonObject = shows.map(JSON.stringify);

        showsFiltered = new Set(jsonObject);
        uniqueArray = Array.from(showsFiltered).map(JSON.parse);

        theatersSelect.removeAttribute('disabled');

        uniqueArray.map(show => {
            var option = document.createElement('option');
            option.value = show.idTheater;
            option.innerHTML = show.theaterName;
            theatersSelect.appendChild(option);
        })

    } else {

        theatersSelect.setAttribute('disabled', "");
        schedulesSelect.setAttribute('disabled', "");

    }

}

function setSchedules() {

    var movieSelected = document.querySelector('#moviesSelect').value;

    var theatersSelect = document.querySelector('#theatersSelect').value;

    var schedulesSelect = document.querySelector('#schedulesSelect');

    while (schedulesSelect.firstChild) {
        schedulesSelect.removeChild(schedulesSelect.lastChild);
    }

    var option = document.createElement('option');
    option.value = "";
    option.innerHTML = "Elegir horario";
    schedulesSelect.appendChild(option);

    if (theatersSelect !== "") {
        var shows = [
            <?php foreach($shows as $indexshows => $show){
              $theater = $show->getTheater();
              $movie = $show->getMovie();
              $date = $show->getDate();
              echo '{idMovie:'.json_encode($show->getMovie()->getId()).', 
                idTheater:'.json_encode($theater->getId()).',
                schedule:'.json_encode($date).'}';
                if($indexshows != count($shows)-1){
                    echo ',';
                  }
        }?>
        ]

        shows = shows.filter(function(show) {
            return show.idMovie === movieSelected
        });

        shows = shows.filter(function(show) {
            return show.idTheater === theatersSelect
        });


        jsonObject = shows.map(JSON.stringify);

        showsFiltered = new Set(jsonObject);
        uniqueArray = Array.from(showsFiltered).map(JSON.parse);

        schedulesSelect.removeAttribute('disabled');

        uniqueArray.map(show => {
            var option = document.createElement('option');
            option.value = show.schedule;
            option.innerHTML = show.schedule;
            schedulesSelect.appendChild(option);
        })

    } else {

        schedulesSelect.setAttribute('disabled', "");

    }
}
</script>