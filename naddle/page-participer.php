<?php 
    get_header(); 
	the_post();
	$imagePageParticiper = get_post_meta( get_the_ID(), 'image_entete', true);
	$imagePageParticiper = wp_get_attachment_image_url($imagePageParticiper, $default);
	$descPage = get_post_meta(get_the_ID(), 'description_page', true);
	$imgEtape1 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_etape_1', true));
	$imgEtape2 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_etape_2', true));
	$imgEtape3 = wp_get_attachment_image_url(get_post_meta( get_the_ID(), 'image_etape_3', true));
	$etape1 = get_post_meta( get_the_ID(), 'description_etape_1', true);
	$etape2 = get_post_meta( get_the_ID(), 'description_etape_2', true);
	$etape3 = get_post_meta( get_the_ID(), 'description_etape_3', true);
	$programme = get_post_meta( get_the_ID(), 'texte_programme', true);
	$conformite = get_post_meta( get_the_ID(), 'texte_conformite', true);
	$certificat = get_field('certificat_medecin');
	$autorisation = get_field('autorisation_parentale');
	$backgroundProgramme = wp_get_attachment_url(462);
?>
    <div class="row blocEnteteParticiper d-flex align-items-center justify-content-center" style="background-image: url('<?= $imagePageParticiper ?>')">
        <div class="sousBlocEnteteParticiper">
            <h1>participer</h1>
            <div class="descParticiper"><?= $descPage ?></div>
            <a href="#blocParticiperWeez">Participer</a>
        </div>
    </div>
	<div class="row blocEtapesParticiper justify-content-center">
		<div class="col-12">
			<div class="row justify-content-around">
				<div class="col-12 col-md-3 sousBlocEtapes">
					<img src="<?= $imgEtape1 ?>" alt="">
					<p><?= $etape1 ?></p>
				</div>
				<div class="col-12 col-md-3 sousBlocEtapes">
					<img src="<?= $imgEtape2 ?>" alt="">
					<p><?= $etape2 ?></p>
				</div>
				<div class="col-12 col-md-3 sousBlocEtapes">
					<img src="<?= $imgEtape3 ?>" alt="">
					<p><?= $etape3 ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row blocProgrammeParticiper" style="background-image: url('<?= $backgroundProgramme ?>');">
		<div class="col-12 blocblocProgrammeParticiper align-self-center">
			<div class="row sousblocProgrammeParticiper">
				<div class="textProgrammeParticiper">
					<?= $programme ?>
				</div>
			</div>
			<div class="row sousblocProgrammeParticiper2">
				<a class="boutonVersProgrammeParticiper" href="<?php bloginfo('url') ?>/programme">Voir le programme</a>
			</div>
		</div>
	</div>
	<div class="row justify-content-center blocParticipationWeez" id="blocParticiperWeez">
		<div class="col-12 titreWeez"><h2>Participer aux courses de paddle</h2></div>
		<div class="col-12 col-lg-10 blocWeezevent">
			<a title="Participer à Naddle" href="https://www.weezevent.com/widget_multi.php?220360.1.1.bo" class="weezevent-widget-integration" target="_blank" data-src="https://www.weezevent.com/widget_multi.php?220360.1.1.bo" data-width="100%" data-height="100%" data-id="multi" data-resize="1" data-npb="0" data-width_auto="1">S'inscrire aux courses de paddle</a>
			<div class="textConsentementParticiper">
				<?= $conformite ?>
			</div>
		</div>
	</div>
	<div class="row ligneDocsParticiper d-flex justify-content-around">
		<div class="col-12"><h3>Documents pour l'inscription</h3></div>
		<div class="col-12">
			<div class="row d-flex justify-content-center">
				<div class="blocDocsParticiper col-12 col-sm-3">
					<h4> Certificat médical </h4>
					<a target="_blank" href=" <?php echo $certificat ?> ">
						<i class="fas fa-file-pdf"></i>
					</a>
				</div>
				<div class="blocDocsParticiper col-12 col-sm-3">
					<h4> Autorisation parentale </h4>
					<a target="_blank" href=" <?php echo $autorisation ?> ">
						<i class="fas fa-file-pdf"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://www.weezevent.com/js/widget/min/widget.min.js"></script>
    <script>
		$('.weezevent-widget-integration').text('');
		// LIEN MENU EN VERT ET TITRE
		$(document).ready(function() {
			$('.sousBlocEnteteParticiper').css({
				'animation' : 'titleAccueil .5s',
				'animation-fill-mode' : 'forwards'
			});
			$('.navSecondMain > ul > li:nth-child(3) > a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
    </script>
<?php get_footer(); ?>