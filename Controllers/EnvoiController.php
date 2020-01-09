<?php
require "Models/Envoi.php";
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx
// XXXXXXXXXXXXXX PSEUDO - CRON XXXXXXXXXXXXXXXXXXXXXXXX
$hour = strtotime('10h00');
$hourMin = date('H:i');
if (strtotime($hourMin) >= strtotime($hour)) {
    include_once("./Models/cron.php");
}
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx
// XXXXXXXXXXXXXX ENVOI TRANSFERT XXXXXXXXXXXXXXXXXXXXXXXX
if (isset($_POST['message'])) {
    $message = $_POST['message'];
} else {
    $message = null;
};
if (isset($_POST['emailExp'])) {
    $mailExp = $_POST['emailExp'];
}
if ($_FILES && $_FILES['img']) {
    if (!empty($_FILES['img']['name'][0])) {
        $zip = new ZipArchive();
        $zip_name = getcwd() . "/assets/transferts/oui_transfer_" . time() . ".zip";
        // Create a zip target
        if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
            $error .= "Sorry ZIP creation is not working currently.<br/>";
        }
        $imageCount = count($_FILES['img']['name']);
        for ($i = 0; $i < $imageCount; $i++) {

            if ($_FILES['img']['tmp_name'][$i] == '') {
                continue;
            }
            // $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
            // Moving files to zip.
            $zip->addFromString($_FILES['img']['name'][$i], file_get_contents($_FILES['img']['tmp_name'][$i]));
            // moving files to the target folder.
            //move_uploaded_file($_FILES['img']['tmp_name'][$i], './uploads/' . $newname);
        }
        $zip->close();
        // Create HTML Link option to download zip
        $success = basename($zip_name);
    } else {
        $error = '<strong>Error!! </strong> Please select a file.';
    }
    ajouterTransfert($success, $message, $mailExp);
};

// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   ENVOI MAIL XXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

if (isset($_POST['emailExp']) && isset($_POST['emailDest'])) {

    $emailExp = $_POST['emailExp']; // Déclaration de l'adresse de destination.
    $emailDest = $_POST['emailDest'];

    // On filtre les serveurs qui présentent des bogues.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $emailDest)) {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }

    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "";

    $message_html = '<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><title></title><!--[if !mso]><!-- --><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style type="text/css">#outlook a { padding:0; }
body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
p { display:block;margin:13px 0; }</style><!--[if mso]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]--><!--[if lte mso 11]>
<style type="text/css">
.mj-outlook-group-fix { width:100% !important; }
</style>
<![endif]--><!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
.mj-column-per-100 { width:100% !important; max-width: 100%; }
}</style><style type="text/css">@media only screen and (max-width:480px) {
table.mj-full-width-mobile { width: 100% !important; }
td.mj-full-width-mobile { width: auto !important; }
}</style></head><body><div><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#FB6C1F;background-color:#FB6C1F;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#FB6C1F;background-color:#FB6C1F;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:300px;"><img height="auto" src="https://jordanm.promo-31.codeur.online/ouitransfer/assets/images/titre-white.png" alt="nuage" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="300"></td></tr></tbody></table></td></tr><tr><td style="font-size:0px;padding:10px 25px;word-break:break-word;"><p style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:100%;"></p><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:550px;" role="presentation" width="550px" ><tr><td style="height:0;line-height:0;"> &nbsp;
</td></tr></table><![endif]--></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:40px;font-weight:bold;line-height:1;text-align:center;color:#FFFFFF;">OUI TRANSFER</div></td></tr><tr><td style="font-size:0px;padding:10px 25px;word-break:break-word;"><p style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:100%;"></p><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:550px;" role="presentation" width="550px" ><tr><td style="height:0;line-height:0;"> &nbsp;</td></tr></table><![endif]--></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:20px;font-weight:bold;line-height:1;text-align:center;color:#FFFFFF;"><p>' . $emailExp . '<br><br>Vous a envoyé un fichier :</p></div></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:15px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tr><td align="center" bgcolor="#FD940A" role="presentation" style="border:4px solid #FFFFFF;border-radius:13px;cursor:auto;mso-padding-alt:10px 25px;background:#FD940A;" valign="middle"><a href="https://jordanm.promo-31.codeur.online/ouitransfer/index.php?page=Reception&transfert=' . $success . '" style="display:inline-block;background:#FD940A;color:#FFFFFF;font-family:arial;font-size:20px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:13px;" target="_blank">Télécharger</a></td></tr></table></td></tr><tr><td style="font-size:0px;padding:10px 25px;word-break:break-word;"><p style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:100%;"></p><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 4px #FFFFFF;font-size:1;margin:0px auto;width:550px;" role="presentation" width="550px" ><tr><td style="height:0;line-height:0;"> &nbsp; </td></tr></table><![endif]--></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><p style="font-family: `Montserrat`, sans-serif;font-size:12px;font-style:italic;line-height:1;text-align:center;color:#FFFFFF;"><br>&#169; OuiTransfer 2019 - Tous droits réservés<br></p></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body></html>';

    //=====Création de la boundary.
    $boundary = "-----=" . md5(rand());
    $boundary_alt = "-----=" . md5(rand());

    //=====Définition du sujet.
    $sujet = "Vous avez reçu des fichier via OuiTransfer";

    //=====Création du header de l'e-mail.
    $header = "From: <contact@ouitransfer.com>" . $passage_ligne;

    $header .= "Reply-to: <contact@ouitransfer.com>" . $passage_ligne;

    $header .= "MIME-Version: 1.0" . $passage_ligne;

    $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;

    //=====Création du message.
    $message = $passage_ligne . "--" . $boundary . $passage_ligne;

    $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;

    $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;

    //=====Ajout du message au format texte.
    $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $message_txt . $passage_ligne;
    $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;


    //=====Ajout du message au format HTML.
    $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $message_html . $passage_ligne;

    //=====On ferme la boundary alternative.
    $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;

    //==========
    $message .= $passage_ligne . "--" . $boundary . $passage_ligne;

    //=====Envoi de l'e-mail.
    mail($emailDest, $sujet, $message, $header);
}
require "Views/EnvoiView.php";
