<?php 
	get_header(); 
	$mail = get_post_meta(136, 'mail_organisateur', true);
	$user = get_user_by('email', $mail);
	$prenom = $user->first_name;
	$nom = $user->last_name;
	$statut = get_user_meta($user->ID, 'wpcf-statut', true);
	$tel = get_user_meta($user->ID, 'wpcf-telephone-user', true);
	$imgProfil = get_user_meta($user->ID, 'wpcf-image-de-profil', true);
	$adresseAPT2N = get_post_meta(136, 'adresse_postale_organisateur', true);
	$horaires = get_post_meta(136, 'horaires_apt2n', true);
?>
	<div class="row">
        <div class="col-12 sousBlocEnteteContact">
            <h1>contact</h1>
        </div>
    </div>
	<div class="row justify-content-center blocParticipationWeez blocFormContact" id="blocParticiperWeez">
		<div class="col-12 titreWeez titreFormContact"><h2>Nous contacter</h2></div>
		<div class="col-12 col-lg-10">
			<?= do_shortcode('[ninja_form id=4]') ?>
		</div>
	</div>
	<div class="row blocUnPeuHaut">
		<div class="col-12">
			<div class="row pourTouteDemande">
				Pour toute demande professionnelle, contactez :
			</div>
			<div class="row d-flex justify-content-center align-items-center grosBlocDeOufMalade">
				<div class="col-12 col-md-3 blocImgProfilCompte d-flex align-items-center imgContact">
					<img src="<?= $imgProfil ?>">
				</div>
				<div class="col-12 col-md-3 partieContactOrga">
					<div class="nomPrenomContact">
						<?= $prenom ?> <?= $nom ?>
					</div>
					<div class="statutContact">
						<?= $statut ?>
					</div>
					<div class="telContact">
						<?= $tel ?>
					</div>
					<div class="mailContact">
						<?= $mail ?>
					</div>
					<div class="adresseContact">
						<?= $adresseAPT2N ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row lp-bloc-carte-contact">
		<div id="carte" class="lp-bloc-map col-12"></div>
		<div class="col-12 col-lg-12 bloc-contact-map">
			<h3>Horaires</h3>
			<div class="blocHoraires">
				<?= $horaires ?>
			</div>
		</div>
	</div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjz8nPtnvwXIxFjgpsfaqRRF86PFZKE8E&libraries=geometry&libraries=places"></script>
    <script>
		// LIEN MENU EN VERT
		$(document).ready(function() {
			var zoneAdresse="<?= $adresseAPT2N ?>";
			var zoneMap="carte";
			var icon = {
				url: "<?php echo bloginfo('template_url') ?>/images/marker2.png",
				scaledSize: new google.maps.Size(100, 100),
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(50, 100)
			};
			var zoom=14;
			createMapIcon(zoneAdresse,zoneMap,icon,zoom);

			$('.navSecondMain > ul > li:nth-child(7) > span').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
    </script>
<?php get_footer(); ?>