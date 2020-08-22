<?php 
    get_header(); 
    the_post();
    $date = get_post_meta(get_the_ID(), 'date_evenement', true);
    $horaire1 = get_post_meta( get_the_ID(), 'horaire_1', true);
    $horaire2 = get_post_meta( get_the_ID(), 'horaire_2', true);
    $horaire3 = get_post_meta( get_the_ID(), 'horaire_3', true);
    $horaire4 = get_post_meta( get_the_ID(), 'horaire_4', true);
    $horaire5 = get_post_meta( get_the_ID(), 'horaire_5', true);
    $horaire6 = get_post_meta( get_the_ID(), 'horaire_6', true);
    $descriptionHoraire1 = get_post_meta( get_the_ID(), 'description_horaire_1', true);
    $descriptionHoraire2 = get_post_meta( get_the_ID(), 'description_horaire_2', true);
    $descriptionHoraire3 = get_post_meta( get_the_ID(), 'description_horaire_3', true);
    $descriptionHoraire4 = get_post_meta( get_the_ID(), 'description_horaire_4', true);
    $descriptionHoraire5 = get_post_meta( get_the_ID(), 'description_horaire_5', true);
    $descriptionHoraire6 = get_post_meta( get_the_ID(), 'description_horaire_6', true);
    $imageHoraire1 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_1', true), $default);
    $imageHoraire2 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_2', true), $default);
    $imageHoraire3 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_3', true), $default);
    $imageHoraire4 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_4', true), $default);
    $imageHoraire5 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_5', true), $default);
    $imageHoraire6 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_horaire_6', true), $default);
    $phrase = get_post_meta( get_the_ID(), 'phrase_complementaire', true);
    $activite1 = get_post_meta( get_the_ID(), 'titre_activite_1', true);
    $activite2 = get_post_meta( get_the_ID(), 'titre_activite_2', true);
    $activite3 = get_post_meta( get_the_ID(), 'titre_activite_3', true);
    $activite4 = get_post_meta( get_the_ID(), 'titre_activite_4', true);
    $activite5 = get_post_meta( get_the_ID(), 'titre_activite_5', true);
    $activite6 = get_post_meta( get_the_ID(), 'titre_activite_6', true);
    $activite7 = get_post_meta( get_the_ID(), 'titre_activite_7', true);
    $activite8 = get_post_meta( get_the_ID(), 'titre_activite_8', true);
    $texteActivite1 = get_post_meta( get_the_ID(), 'texte_activite_1', true);
    $texteActivite2 = get_post_meta( get_the_ID(), 'texte_activite_2', true);
    $texteActivite3 = get_post_meta( get_the_ID(), 'texte_activite_3', true);
    $texteActivite4 = get_post_meta( get_the_ID(), 'texte_activite_4', true);
    $texteActivite5 = get_post_meta( get_the_ID(), 'texte_activite_5', true);
    $texteActivite6 = get_post_meta( get_the_ID(), 'texte_activite_6', true);
    $texteActivite7 = get_post_meta( get_the_ID(), 'texte_activite_7', true);
    $texteActivite8 = get_post_meta( get_the_ID(), 'texte_activite_8', true);
    $imageActivite1 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_1', true), $default);
    $imageActivite2 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_2', true), $default);
    $imageActivite3 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_3', true), $default);
    $imageActivite4 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_4', true), $default);
    $imageActivite5 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_5', true), $default);
    $imageActivite6 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_6', true), $default);
    $imageActivite7 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_7', true), $default);
    $imageActivite8 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_activite_8', true), $default);
    $pourquoiNaddle = get_post_meta( get_the_ID(), 'pourquoi_naddle', true);
    $carte = get_post_meta( get_the_ID(), 'adresse_carte', true);
    $infosPratiques = get_post_meta( get_the_ID(), 'infos_pratiques', true);
?>
	<div class="row blocTitreGalerie blocTitreGrandProg">
        <div class="col-12 titreGalerie">
            <h1>programme</h1>
        </div>
    </div>
    <div class="row blocDateEvent">
        <div class="col-12 dateEvent">
            <div class="col-12 titreSectionProg">
                <h3>Date de l'événement</h3>
            </div>
            <div class="texteDateEvent"><div class="dateDate"><?= $date ?></div></div>
        </div>
    </div>
    <div class="row d-flex justify-content-center blocHorairesDeroulProg">
        <div class="col-12 titreSectionProg">
            <h3>Horaires et déroulement</h3>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire1) { echo '<div class="heureHoraire">'.$horaire1.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire1 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire1 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire2) { echo '<div class="heureHoraire">'.$horaire2.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire2 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire2 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire3) { echo '<div class="heureHoraire">'.$horaire3.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire3 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire3 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire4) { echo '<div class="heureHoraire">'.$horaire4.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire4 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire4 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire5) { echo '<div class="heureHoraire">'.$horaire5.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire5 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire5 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
            <div class="blocHoraire">
                <?php if ($horaire6) { echo '<div class="heureHoraire">'.$horaire6.'</div>'; } ?>
                <div class="sousBlocHoraire" style="background-image: url('<?= $imageHoraire6 ?>')">
                    <div class="DescHoraireProg">
                        <?= $descriptionHoraire6 ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="phraseCompProg">
                <?= $phrase ?>
            </div>
        </div>
        <div class="col-12 boutonParticiperProgramme">
            <a href="<?php bloginfo('url'); ?>/participer">Participer</a>
        </div>
    </div>
    <div class="row blocActivitesProg d-flex justify-content-center">
        <div class="col-12 titreSectionProg">
            <h3>Activités</h3>
        </div>
        <?php 
            if ($activite1) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite1.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite1.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite1.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite2) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite2.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite2.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite2.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite3) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite3.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite3.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite3.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite4) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite4.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite4.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite4.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite5) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite5.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite5.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite5.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite6) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite6.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite6.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite6.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite7) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite7.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite7.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite7.'
                        </div>
                    </div>
                </div>';
            }
        ?>
        <?php 
            if ($activite8) {
                echo '<div class="col-12 col-lg-5 d-flex justify-content-center grosGrosGrosBlocActivite">
                    <div class="sousBlocActiviteProg">
                        <div class="titreActivite">
                            '.$activite8.'
                        </div>
                        <div class="imageActivite">
                            <img src="'.$imageActivite8.'" alt="">
                        </div>
                        <div class="texteActiviteProg">
                            '.$texteActivite8.'
                        </div>
                    </div>
                </div>';
            }
        ?>
    </div>
    <div class="row blocPourquoiNaddle d-flex justify-content-center">
        <div class="col-12 col-md-10">
            <div class="titreSectionProg">
                <h3>Pourquoi Naddle ?</h3>
            </div>
            <div class="pourquoiNaddleText">
                <?= $pourquoiNaddle ?>
            </div>
            <div class="boutonParticiperProgramme">
                <a href="<?php bloginfo('url'); ?>/benevole">Devenir bénévole</a>
            </div>
        </div>
    </div>
    <div class="row blocCarteProgramme">
        <div class="col-12 carteCourseProg">
            <div class="titreSectionProg">
                <h3>Naddle, c'est où ?</h3>
            </div>
            <div id="carte" class="lp-bloc-map"></div>
        </div>
    </div>
    <div class="row d-flex justify-content-center blocInfosPratiques">
        <div class="col-12 col-md-8">
            <div class="titreSectionProg">
                <h3>Infos pratiques</h3>
            </div>
            <div class="infosPratiquesProg">
                <?= $infosPratiques ?>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjz8nPtnvwXIxFjgpsfaqRRF86PFZKE8E&libraries=geometry&libraries=places"></script>
    <script>
		// LIEN MENU EN VERT
		$(document).ready(function() {
            var zoneAdresse="<?= $carte ?>";
			var zoneMap="carte";
			var icon = {
				url: "<?php echo bloginfo('template_url') ?>/images/marker.png",
				scaledSize: new google.maps.Size(100, 100),
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(50, 100)
			};
			var zoom=14;
			createMapIcon(zoneAdresse,zoneMap,icon,zoom);
			$('#menuTopSticky > ul > li:nth-child(2) > a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
    </script>
<?php get_footer(); ?>