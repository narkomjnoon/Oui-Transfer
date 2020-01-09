<?php
require_once 'header.php';
?>
<div class="container centrage">
    <div class="col">
        <div class="intro introreception">
            <a href="https://jordanm.promo-31.codeur.online/ouitransfer/"><img id="logo_titre" src="assets/images/titre-white.svg"></a>
            <p>Réceptionnez vos fichiers les plus volumineux en toute légèreté</p>
        </div>
    </div>
    <div class="col">
        <!-- FORMULAIRE -->
        <div class="retour">
            <h1 class="titre-retour"><?php echo $message['expediteur']; ?><br>vous a envoyé un transfert</h1>
            <p><?php echo $message['message']; ?></p>
            <a href="https://jordanm.promo-31.codeur.online/ouitransfer/assets/transferts/<?php echo $transfert ?>">Téléchargez ici</a>
            <p>Téléchargement disponible jusqu'au :<br><?php echo $dateFin; ?></p>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>