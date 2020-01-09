<?php
require_once 'header.php';
?>

<div class="popup <?php
                    if (!isset($_POST['emailExp'])) {
                        echo "none";
                    } ?>">
    <p>Vos fichiers ont bien été transférés !</p>
    <p>X</p>
</div>

<div class="container">
    <!-- INTRO -->
       <div class="col">
           <div class="intro">
            <a href="https://jordanm.promo-31.codeur.online/ouitransfer/"><img id="logo_titre" src="assets/images/titre-white.svg"></a>
            <p>Envoyez vos fichiers les plus volumineux en toute légèreté</p>
        </div>
    </div>
    <div class="col">
        <div class="formulaire">
            <h1>Partagez ce que vous voulez !</h1>
            <form id="formulaire" action="" method="post" enctype="multipart/form-data">
                <input type="file" id="file" name="img[]" multiple>
                <label for="file" class="bouton" id="upload">Sélectionnez le(s) fichier(s)</label>
                <div id="items"></div>
                <input type="text" name="emailExp" placeholder="Votre Adresse e-mail" />
                <input type="email" name="emailDest" placeholder="L'adresse mail du destinataire" />
                <textarea name="message" placeholder="Ecrivez votre message (facultatif)" id="message"></textarea>
                <input id="myBtn" type="submit" value="Envoyez" />
            </form>
        </div>
    </div>
</div>


<?php
require_once 'footer.php';
?>