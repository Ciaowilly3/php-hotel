<?php
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    $filteredHotels = $hotels;

    $filtersOn = isset($_GET['parkRequired']) || isset($_GET['rating']);

    if($filtersOn){
        $filteredHotels = [];
        foreach ($hotels as $hotel) {
            $toPush = true;
            if (isset($_GET['parkRequired']) && $_GET['parkRequired'] === 'false') {
                if ($hotel['parking']) {
                    $toPush = false;
                }
            }
            if(isset($_GET['parkRequired']) && $_GET['parkRequired'] === 'true'){
                if (!$hotel['parking']){
                    $toPush = false;
                }
            }
            
            if(isset($_GET['rating']) && $_GET['rating'] > $hotel['vote']){
                $toPush = false;
            }
            if ($toPush){
                $filteredHotels[] = $hotel;
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP-hotel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
    </head>
    <body class="bg-dark">
        <div class="container">
            <h1 class="text-center text-primary my-5">HOTEL? <del>TriVaGo</del> Boolean! </h1>
            <form method="GET" class="mb-3 border border-secondary p-3">
                <div class="mb-4 text-white d-flex justify-content-start gap-5">
                    <div>
                        <h5>Necessiti del parcheggio?</h5>
                        <input type="radio" name="parkRequired" value="true" id="yes">
                        <label for="yes" class="me-3">Yes</label>
                        <input type="radio" name="parkRequired" value="false" id="no">
                        <label for="no">No</label>
                    </div>
                    <div>
                        <h5>Inserisci il minimo di stelle che vuoi, da 1 a 5</h5>
                        <input type="number" name='rating' class="form-control" value="<?php echo $_GET["rating"] ?? ''?>">
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn-lg me-3">Invia</button>
                    <button class="btn btn-warning btn-lg" href="index.php">Annulla</button>
                </div>
            </form>
            <table class="table text-white">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Parcheggio</th>
                        <th>Voto</th>
                        <th>Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($filteredHotels as $hotel) {
                
                ?>
                <tr>
                    <td> <?php echo $hotel['name'] ?></td >
                    <td> <?php echo $hotel['description']?></td >
                    <td>
                        <!-- con una condizione stampo presente nel caso in cui ci sia parcheggio, per evitare il true o false stampato -->
                        <?php 
                            if($hotel['parking']){
                            echo 'presente';
                            }else{
                                echo 'assente';
                            }
                        ?>
                    </td>
                    <td> <?php echo $hotel['vote']?></td >
                    <td> <?php echo $hotel['distance_to_center']?></td >
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>