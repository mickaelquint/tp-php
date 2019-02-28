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
                <th scope="col">Action</th>

            </tr>
        </thead>

        <tbody>
            <?php $query = $db->query('SELECT * FROM voiture');
            $voitures = $query->fetchAll();
            
            foreach ($voitures as $voiture) {?>
            <tr>

                <div>
                    <th scope="row"> <?= $voiture['id']; ?> </th>
                </div>
                <div>
                    <td>
                        <div class="photo" style="background-image:url(assets/img/<?= $voiture['photo']; ?>)"> </div>
                    </td>
                </div>
                <div>
                    <td> <?= $voiture['marque']; ?></td>
                </div>
                <div>
                    <td> <?= $voiture['modele']; ?></td>
                </div>
                <div>
                    <td> <?=$nombre_format_francais = number_format($voiture['prix'], 2, ',', ' '); ?> € </td>
                </div>
                <div>
                    <td> <?= $voiture['annee_sortie']; ?></td>
                </div>

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