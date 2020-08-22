<?php 
    if (!is_user_logged_in()) {
        wp_redirect(home_url());
    }
    get_header(); 
?>
<?php
    global $current_user;
    $modifProfil = $_GET['modificationProfil'];
    $mdpReinitialise = $_GET['mdpReinitialise'];
    $manqueObligatoires = $_GET['cestunescroc'];
    $erreurChamp = $_GET['erreur-champ'];
    $modificationReussi = $_GET['modifie'];
    $retourErreur = $_GET['retourValeurs'];
    $affichage = '';
    $blocMessagesErreur = '';
    $blocMessageReussite = '';
    $messagePenseBete = '';
    $nom = $current_user->last_name;
    $prenom = $current_user->first_name;
    $pseudo = $current_user->display_name;
    $mail = $current_user->user_email;
    $tel = get_user_meta($current_user->ID, 'wpcf-telephone-user', true);
    $imgProfil = get_user_meta($current_user->ID, 'wpcf-image-de-profil', true);
    $statut = get_user_meta($current_user->ID, 'wpcf-statut', true);
    $desc = $current_user->description;
    $ville = get_user_meta($current_user->ID, 'wpcf-adresse-ville', true);
    $cp = get_user_meta($current_user->ID, 'wpcf-adresse-cp', true);
    $rue = get_user_meta($current_user->ID, 'wpcf-adresse-rue', true);
    $asterix = '<span class="asterixForm"> *</span>';
    $nomInput = 'class="input" value="'.$nom.'">';
    $prenomInput = 'class="input" value="'.$prenom.'">';
    $telInput = 'class="input" value="'.$tel.'">';
    $villeInput = 'class="input" value="'.$ville.'">';
    $cpInput = 'class="input" value="'.$cp.'">';
    $rueInput = 'class="input" value="'.$rue.'">';

    // AJOUT DU MESSAGE PENSEZ A REMPLIR VOS INFORMATION
    if(empty($nom) || empty($prenom) || empty($ville)) {
        $messagePenseBete = '<div class="messagePenseBete">Pensez à remplir toutes les informations de votre profil.</div>';
    }

    //AJOUT DE LA MORT QUI TUE
    if($retourErreur == 'yep') {
        $nbErreurs = $_GET['nbErreurs'];
        $retourPrenom = $_GET['retourPrenom'];
        $retourNom = $_GET['retourNom'];
        $retourTel = $_GET['retourTel'];
        $retourRue = $_GET['retourRue'];
        $retourCp = $_GET['retourCp'];
        $retourVille = $_GET['retourVille'];
        if($retourPrenom) { $prenomInput = 'class="input" value="'.$retourPrenom.'">'; }
        if($retourNom) { $nomInput = 'class="input" value="'.$retourNom.'">'; }
        if($retourTel) { $telInput = 'class="input" value="'.$retourTel.'">'; }
        if($retourRue) { $rueInput = 'class="input" value="'.$retourRue.'">'; }
        if($retourCp) { $cpInput = 'class="input" value="'.$retourCp.'">'; }
        if($retourVille) { $villeInput = 'class="input" value="'.$retourVille.'">'; }
    }
    if($modifProfil == "allezcestparti") {
        $messagePenseBete = '';
        $affichage .= 
        '<div class="row topModifInfosCompte justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row titleModifProfil">
                    <h2>modifier mon profil</h2>
                </div>
                <div class="row">
                    <div class="col blocModifInfos1">
                        <form id="formModifInfosCompte" action="#" method="post" enctype="multipart/form-data">';
        $affichage .= wp_nonce_field('changer-infos', 'changement-compte-verif');
        $affichage .=       '<div class="row d-flex align-items-center inputPrenomModif"><label for="user_prenom">Prénom'.$asterix.'</label><input required type="text" name="user_prenom" id="user_prenom" '.$prenomInput.'</div>
                            <div class="row d-flex align-items-center inputNomModif"><label for="user_nom">Nom'.$asterix.'</label><input required type="text" name="user_nom" id="user_nom" '.$nomInput.'</div>
                            <div class="row inputImgModif justify-content-center">
                                <div class="col ancienneImageModif"><img src="'.$imgProfil.'"></div>
                                <div class="col colImgModif"><input class="input-file" type="file" name="user_pdp" id="user_pdp">
                                <label class="input-file-trigger" for="user_pdp">Changer de photo...</label>
                                <p class="file-return"></p></div>
                            </div>
                            <div class="row d-flex align-items-center inputTelModif"><label for="user_tel">Numéro de téléphone'.$asterix.'</label><input required type="tel" name="user_tel" id="user_tel" '.$telInput.'</div>
                            <div class="row d-flex align-items-center inputDescModif"><label for="user_desc">Description</label><textarea name="user_desc" id="user_desc" class="">'.$desc.'</textarea></div>
                            <div class="row d-flex align-items-center inputRueModif"><label for="user_rue">Adresse'.$asterix.'</label><input required type="text" name="user_rue" id="user_rue" '.$rueInput.'</div>
                            <div class="row d-flex align-items-center inputCpModif"><label for="user_cp">Code postal'.$asterix.'</label><input required type="text" name="user_cp" id="user_cp" size="5" '.$cpInput.'</div>
                            <div class="row d-flex align-items-center inputVilleModif"><label for="user_ville">Ville'.$asterix.'</label><input required type="text" name="user_ville" id="user_ville" '.$villeInput.'</div>
                            <div class="row"><input type="hidden" name="user_id" value="'.$current_user->ID.'"><input type="hidden" name="user_linkPdp" value="'.$imgProfil.'"></div>';
                            if ($nom) { $affichage .=  '<div class="row boutonModifInfos"><input class="ahCestChiantLeCss" type="submit" name="modifier-infos-compte" value="Modifier mes infos"></div>'; }
                            else { $affichage .=  '<div class="row boutonModifInfos"><input class="ahCestChiantLeCss" type="submit" name="modifier-infos-compte" value="Valider mes infos"></div>'; }
                        $affichage .=  '</form>
                    </div>
                </div>

            </div>
        </div>
        <div class="row bottomModifInfosCompte">
            <div class="col-12">
            <form name="lostpasswordform" id="lostpasswordform" action="'.get_bloginfo("url").'/wp-login.php?action=lostpassword" method="post">
                <input type="hidden" name="user_login" id="user_login" class="input" value="'.$mail.'">
                <input type="hidden" name="redirect_to" value="'.get_bloginfo("url").'/mon-compte/?mdpReinitialise=ahouiouioui">
                <p class="submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="buttonChangeMdp" value="Recevoir un nouveau mot de passe">
                </p>
            </form>
            </div>
        </div>';
    } 
    else {
        $affichage .= '<div class="row topProfil justify-content-center">';
        $affichage .= '<div class="col-12 col-lg-10 ententeCompteProfil">';
        $affichage .= '<div class="row">
                            <div class="col-12 blocImgProfilCompte d-flex align-items-center">
                                <img src="'.$imgProfil.'">
                            </div>
                        </div>';
        if (!empty($nom) && !empty($prenom)) {
            $affichage .= '<div class="row">
                                <div class="col-12 nomPrenomCompte">
                                    '.$prenom.' <span class="nomCompte">'.$nom.'</span>
                                </div>
                            </div>';
        }
        $affichage .= '<div class="row">
                            <div class="col-12 statutCompteProfil">
                                '.$statut.'
                            </div>
                        </div>';
        if (!empty($desc)) {
            $affichage .= '<div class="row"> 
                                <div class="col-12 descUserProfil">
                                    '.$desc.'
                                </div>
                            </div>';               
        }
        $affichage .= '</div></div>';
        $affichage .= '<div class="row bottomProfil justify-content-center">
            <div class="col-10 col-lg-12 informationsCompteProfil">
                <div class="row titleBottomProfil">
                    <h2>mes informations</h2>
                </div>
                <div class="row pseudoBottomProfil">
                    <div class="labelStyleInfos">Pseudo</div>
                    <span class="valeurInfos">'.$pseudo.'</span>
                </div>
                <div class="row mailBottomProfil">
                    <div class="labelStyleInfos">Adresse mail</div>
                    <span class="valeurInfos">'.$mail.'</span>
                </div>';
        if (!empty($tel)) {
            $affichage .= '<div class="row telBottomProfil">
                                <div class="labelStyleInfos">Téléphone</div>
                                <span class="valeurInfos">'.$tel.'</span>
                            </div>';
        }
        if (!empty($rue) && !empty($cp) && !empty($ville)) {
            $affichage .= '<div class="row adresseBottomProfil">
                                <div class="labelStyleInfos">Adresse postale</div>
                                <span class="valeurInfos">'.$rue.' '.$cp.' '.$ville.'</span>
                            </div>';
        }
        $affichage .= '</div>
                    </div>';
        if ($nom) { $affichage .= '<div class="row blocBoutonModifProfil justify-content-center"><a href="'.get_bloginfo('url').'/mon-compte/?modificationProfil=allezcestparti">Modifier mon profil</a></div>'; }
        else { $affichage .= '<div class="row blocBoutonModifProfil justify-content-center"><a href="'.get_bloginfo('url').'/mon-compte/?modificationProfil=allezcestparti">Compléter mon profil</a></div>'; }
    }
    if($mdpReinitialise == "ahouiouioui") {
        $blocNouveauMotDePasse = '<div class="messageNewMdpProfil"><p>Un lien vous a été envoyé par mail afin de modifier votre mot de passe.</p></div>';
    }
    if($manqueObligatoires == 'oui') {
        $blocMessagesErreur .= '<div class="messageErreurModifProfil">Veuillez remplir tous les champs obligatoires.</div>';
    }
    if($modificationReussi == "oui") {
        $blocMessageReussite .= '<div class="messageReussiteModifProfil">Bravo, vous avez bien modifié vos informations.</div>';
    }
    if (isset($erreurChamp)) {
        $blocMessagesErreur = '<div class="messageErreurModifProfil">';
            switch ($erreurChamp) {
                case 'prenom' :
                    $blocMessagesErreur .= 'Le prénom entré est invalide.';
                    break;
                case 'nom' :
                    $blocMessagesErreur .= 'Le nom entré est invalide.';
                    break;
                case 'tel' :
                    $blocMessagesErreur .= 'Le numéro de téléphone entré est invalide.';
                    break;
                case 'ville' :
                    $blocMessagesErreur .= 'La ville entrée est invalide.';
                    break;
                case 'cp' :
                    $blocMessagesErreur .= 'Le code postal entré est invalide.';
                    break;
                case 'rue' :
                    $blocMessagesErreur .= 'L\'adresse entrée est invalide.';
                    break;
                case 'desc' :
                    $blocMessagesErreur .= 'La description entrée est trop longue (maximum 500 caractères).';
                    break;
                case 'file' :
                    $blocMessagesErreur .= 'L\'image est trop volumineuse (maximum 1 MB).';
                    break;
                default :
                    $blocMessagesErreur .= 'Une erreur est survenue.';
                    break;
            }
        if($nbErreurs > 1) { $blocMessagesErreur .= ' (+'.($nbErreurs-1).')'; }
        $blocMessagesErreur .= '</div>';
    } 
?>
    <?php
        echo $messagePenseBete;
        echo $blocMessageReussite;
        echo $blocMessagesErreur;
        echo $blocNouveauMotDePasse;
        echo $affichage;
    ?>
    <script>
        //FONCTIONS POUR L'INPUT DE FICHIER ET IMAGES
        document.querySelector("html").classList.add('js');
        
        var fileInput  = document.querySelector( ".input-file" ),  
            button     = document.querySelector( ".input-file-trigger" ),
            the_return = document.querySelector(".file-return");
        
        button.addEventListener( "keydown", function( event ) {
            if ( event.keyCode == 13 || event.keyCode == 32 ) {
                fileInput.focus();
            }
        });
        
        button.addEventListener( "click", function( event ) {
            fileInput.focus();
            return false;
        });
        
        fileInput.addEventListener( "change", function( event ) {  
            the_return.innerHTML = this.value;  
        });
    </script>
<?php get_footer();  ?>