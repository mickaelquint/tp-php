<?php

// On inclus le fichier header.php sur la page
require_once __DIR__ . '/../partials/header.php';





?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Marque</th>
                <th scope="col">Modèle</th>
                <th scope="col">Prix</th>
                <th scope="col">Année de sortie</th>

            </tr>
        </thead>

        <tbody>
            <?php $query = $db->query('SELECT * FROM voiture');
            $voitures = $query->fetchAll();
            
            foreach ($voitures as $voiture) {?>
            <tr>


                <th scope="row"> <?= $voiture['id']; ?> </th>
                <td>
                    <div class="photo" style="background-image:url(assets/img/<?= $voiture['photo']; ?>)"> </div>
                </td>
                <td> <?= $voiture['marque']; ?></td>
                <td> <?= $voiture['modele']; ?></td>
                <td> <?= $voiture['prix']; ?></td>
                <td> <?= $voiture['annee_de_sortie']; ?></td>

            </tr>
</div>
<?php } ?>

</tbody>
</table>



<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>

</html>