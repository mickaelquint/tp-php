<?php require_once __DIR__ . '/../partials/header.php';

// On déclare toutes les variables
$photo = null;
$marque = null;
$modele = null;
$prix = null;
$annee_sortie = null;

// Traitement du formulaire
if (!empty($_POST)) {   
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $annee_sortie = $_POST['annee_sortie'];
    $photo = $_FILES['photo'];

// Un tableau avec les erreurs potentielles du formulaire
     $errors = [];

      // Vérifier la marque
    if (empty($marque)) {
        $errors['marque'] = 'La marque n\'est pas valide';
    }

    // Vérifier le modele
    if (empty($modele)) {
        $errors['modele'] = 'Le modele de la voiture n\'est pas valide';
    }

    // Vérifier le modele
    if (empty($prix)) {
        $errors['prix'] = 'Le prix de la voiture n\'est pas valide';
    }
     // Vérifier l'année de sortie'
     if (empty($annee_sortie)) {
        $errors['annee_sortie'] = 'L \' année de sortie de la voiture n\'est pas valide';
    }
    // if(exif_imagetype($photo)) {
    //    $errors['photo'] = ' La photo n\'est pas valide';
   // }
     

     // Upload de la photo
     if ($photo['error'] === 0) {
        // On récupére le fichier temporaire
        $tmpFile = $photo['tmp_name'];
        // On récupére le nom du fichier
        $fileName = $photo['name'];
        // Générer un nom de fichier unique
        $fileName = substr(md5(time()), 0, 8) . '_' . $fileName;
        // On déplace le fichier à l'endroit désiré
        move_uploaded_file($tmpFile, __DIR__.'/assets/img/'.$fileName);
        // On récupère le nom du fichier pour le mettre dans la bdd
        $photo = $fileName;
    } else { // S'il n'y a pas d'upload
        $photo = null;
    }

   // Si le formulaire est valide
   if (empty($errors)) {
    $query = $db->prepare('INSERT INTO voiture (marque, modele, prix, annee_sortie, photo) VALUES (:marque, :modele, :prix, :annee_sortie, :photo)');
    $query->bindValue(':marque', $marque);
    $query->bindValue(':modele', $modele);
    $query->bindValue(':prix', $prix);
    $query->bindValue(':annee_sortie', $annee_sortie);
    $query->bindValue(':photo', $photo);
    
    if ($query->execute()) {
        echo '<div class="alert alert-success">La voiture a bien été ajouté.</div>';
    }
}

}

?>
<div class="container my-5">
    <?php
        // S'il y a des erreurs
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            echo '<p>Le formulaire contient des erreurs</p>';
            echo '<ul>';
            foreach ($errors as $field => $error) {
                echo '<li>'.$field.' : '.$error.'</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
//formulaire 
    ?>
    <div class="row">
        <div class="col-md-6 offset-3">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="marque">Marque*</label>
                    <input type="text" name="marque" id="marque" class="form-control">
                </div>

                <div class="form-group">
                    <label for="modele">Modèle*</label>
                    <input type="text" name="modele" id="modele" class="form-control">
                </div>

                <div class="form-group">
                    <label for="prix">Prix*</label>
                    <input type="number" name="prix" id="prix"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="annee_sortie">Année de sortie*</label>
                    <select id="annee_sortie" name="annee_sortie" id="annee_sortie" class="form-control">
                    <?php
                    for($annee=1969 ; $annee <= date('Y'); $annee++){?>
                        <option value="<?= $annee ?>"><?= $annee ?></option>
                        
                    <?php }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="photo">Photo*</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>


                <button class="btn btn-primary btn-block">Ajouter une voiture</button>
            </form>
        </div>
    </div>
</div>