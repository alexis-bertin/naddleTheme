<?php get_header(); ?>
<?php
	global $current_user;
	//PARAMETRAGE UTILISATEUR
	if (is_user_logged_in()) {
		$imgProfil = get_user_meta($current_user->ID, 'wpcf-image-de-profil', true);
		$statut = get_user_meta($current_user->ID, 'wpcf-statut', true);
		if (empty($imgProfil)) {
			update_user_meta($current_user->ID, 'wpcf-image-de-profil', get_bloginfo('template_url').'/images/avatar.png');
		}
		if (empty($statut)) {
			update_user_meta($current_user->ID, 'wpcf-statut', 'Internaute');
		}
	}

	//RECUPERATION DONNEES
	$imageEntete = get_post_meta(80, 'image_entete_accueil', true);
	$imageEntete = wp_get_attachment_image_url($imageEntete, $default);
	$descriptionEntete = get_post_meta(80, 'description_entete', true);
	$presentation1 = get_post_meta(80, 'presentation_evenement_1', true);
	$imagePresentation1 = get_post_meta(80, 'image_presentation_1', true);
	$imagePresentation1 = wp_get_attachment_image_url($imagePresentation1, $default);
	$presentation2 = get_post_meta(80, 'presentation_evenement_2', true);
	$imagePresentation2 = get_post_meta(80, 'image_presentation_2', true);
	$imagePresentation2 = wp_get_attachment_image_url($imagePresentation2, $default);
	$presentation3 = get_post_meta(80, 'presentation_evenement_3', true);
	$imagePresentation3 = get_post_meta(80, 'image_presentation_3', true);
	$imagePresentation3 = wp_get_attachment_image_url($imagePresentation3, $default);
	$texteOrga = get_post_meta(136, 'texte_organisateur', true);
	$logoOrga = wp_get_attachment_image_url(get_post_meta(136, 'logo_organisateur', true), $default);
	$texteBenevoles = get_post_meta(80, 'texte_benevoles', true);
	$backgroundForum = wp_get_attachment_url(419);
	$backgroundBenevoles = wp_get_attachment_url(448);
	
	//DONNES NEWS
	$args=array(
		'post_type' => 'actualite',
		'posts_per_page' => 4
	);
	$actualites = new WP_Query($args);
	while($actualites->have_posts()) {
		$actualites->the_post();
		$imageActu = get_post_meta(get_the_ID(), 'wpcf-image-actualite', true);
		$styleImageActu = 'style="background-image: url(\''.$imageActu.'\');"';
		$affichageNews .= '<div class="col-12 col-lg-6 paddingNews"><div class="blocLargeNews"'.$styleImageActu.'><a class="blocActuPres d-flex align-items-center" href="'.get_the_permalink().'"><div class="jppJeSuisCreve"><div class="titleCardNews">'.get_the_title().'</div><div class="dateCardNews">le '.get_the_date().'</div></div></a></div></div>';
	}

	//DONNEES FORUM
	$args2=array(
		'post_type' => 'sujet',
		'posts_per_page' => 3
	);
	$sujets = new WP_Query($args2);
	while($sujets->have_posts()) {
		$sujets->the_post();
		$nbLikers = get_post_meta(get_the_ID(), 'nb_likers', true);
		$tabTerms = getTermTaxo(get_the_ID(), 'categorie');
		if(!empty($tabTerms)) {
			$termesSujet = '<div class="termesSujet">';
			foreach($tabTerms as $term) {
				$termesSujet .= '<div class="termeSujet">'.$term->name.'</div>';
			}
			$termesSujet .= '</div>';
		}
		else {
			$termesSujet = '';
		}
		if ((get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)) == (get_bloginfo('template_url').'/images/avatar.png')) {
			$lienImageAuteurTaVu = get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true);
		}
		else {
			$lienImageAuteurTaVu = wp_get_attachment_image_src(attachment_url_to_postid(get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)), 'thumbnail');
			$lienImageAuteurTaVu = $lienImageAuteurTaVu[0];
		}
		$affichage .= '<div class="blocSingleSujet">
							<a class="row" href="'.get_the_permalink().'">
								<div class="col-12 col-lg-2 blocImgDateSujet">
									<div class="imgAuteurSujet">
										<img src="'.$lienImageAuteurTaVu.'">
									</div>
									<div class="dateBlocSujet">
										'.get_the_date().'
									</div>
								</div>
								<div class="col-12 col-lg-10 blocTitreComSujet">
									<div class="row hautSujetForum">
										<div>
											'.get_the_title().'
										</div>
									</div>
									<div class="row basSujetForum">
										<div class="catSujets d-flex align-items-end">
											'.$termesSujet.'
										</div>
										<div class="commentsLike d-flex align-items-end justify-content-end">
											<div>
												<i class="fas fa-comment"></i> '.get_comments_number().'
											</div>
											<div>
												<i class="fas fa-heart"></i> '.$nbLikers.'
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>';
		}

	//DONNEES PARTENAIRES
	$logoPartenaire1 = get_post_meta(136, 'logo_partenaire_1', true);
    $logoPartenaire2 = get_post_meta(136, 'logo_partenaire_2', true);
    $logoPartenaire3 = get_post_meta(136, 'logo_partenaire_3', true);
    $logoPartenaire4 = get_post_meta(136, 'logo_partenaire_4', true);
    $logoPartenaire5 = get_post_meta(136, 'logo_partenaire_5', true);
    $logoPartenaire6 = get_post_meta(136, 'logo_partenaire_6', true);
    $logoPartenaire7 = get_post_meta(136, 'logo_partenaire_7', true);
    $logoPartenaire8 = get_post_meta(136, 'logo_partenaire_8', true);
    $logoPartenaire9 = get_post_meta(136, 'logo_partenaire_9', true);
    $logoPartenaire10 = get_post_meta(136, 'logo_partenaire_10', true);

	//RECUPERATION FAQ
	$contentFAQ = apply_filters('the_content', get_post(311)->post_content);
	
?>
	<div class="row contenuPageAccueil">
	

		<div class="row enteteHomepage" style="background-image: url('<?= $imageEntete ?>');">
			<div class="col-12 align-self-center" style="padding: 0">
				<div class="row sousEnteteHomepage d-flex align-content-center flex-wrap">
					<div class="col-12">
						<div class="titreHomepage">
							<h1>naddle</h1>
						</div>
					</div>
					<div class="col-12">
						<div class="descEnteteHomepage">
							<?= $descriptionEntete ?>
						</div>
					</div>
					<div class="col-12">
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="boutonEnteteEvenement">
									<a href="<?php bloginfo('url') ?>/programme">L'événement</a>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="boutonEnteteParticiper">
									<a href="<?php bloginfo('url') ?>/participer">Participer</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row blocDescEvenement">
			<div class="col-12">
				<div class="row d-flex justify-content-lg-around justify-content-md-center">
					<div class="col-12 col-md-5 col-lg-3 singleBlocPresentationAccueil">
						<h2>Courses de paddle</h2>
						<div class="imgPresentationAccueil">
							<img src="<?= $imagePresentation1 ?>">
						</div>
						<div class="textPresentationAccueil">
							<?= $presentation1 ?>
						</div>
					</div>
					<div class="col-12 col-md-5 col-lg-3 singleBlocPresentationAccueil songoku2">
						<h2>Événement à Caen</h2>
						<div class="imgPresentationAccueil">
							<img src="<?= $imagePresentation2 ?>">
						</div>
						<div class="textPresentationAccueil">
							<?= $presentation2 ?>
						</div>
					</div>
					<div class="col-12 col-md-5 col-lg-3 singleBlocPresentationAccueil songoku3">
						<h2>Environnement</h2>
						<div class="imgPresentationAccueil">
							<img src="<?= $imagePresentation3 ?>">
						</div>
						<div class="textPresentationAccueil">
							<?= $presentation3 ?>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row blocEspaceAssociation">
			<div class="col-12 align-self-center sousBlocEspaceAssociation">
				<div class="row">
					<div class="col-12 col-lg-4 align-self-center sousBlocLogoAPT2N">
						<img src="<?= $logoOrga ?>" alt="logo-apt2n">
					</div>
					<div class="col-12 col-lg-8 align-self-center sousBlocTextAPT2N">
						<div><?= $texteOrga ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row blocEspaceBenevoles" style="background-image: url('<?= $backgroundBenevoles ?>');">
			<div class="col-12 blocblocEspaceBenevoles align-self-center">
				<div class="row sousblocEspaceBenevoles">
					<div class="textBenevolesAccueil">
						<?= $texteBenevoles ?>
					</div>
				</div>
				<div class="row sousblocEspaceBenevoles2">
					<a class="boutonVersBenevolesAccueil" href="<?php bloginfo('url') ?>/benevoles">Devenir bénévole</a>
				</div>
			</div>
		</div>
		<?php
			if($actualites->have_posts()) {
				echo '<div class="row container-fluid blocLastNews">
						 <div class="col-12">
							<h2>Les dernières actualités</h2>
							<div class="row justify-content-center grosBlocActus">';
						echo $affichageNews;
						echo '</div>
							<a class="boutonVersNewsAccueil" href="'.get_bloginfo('url').'/news">Voir les news</a>
					  </div></div>';
			}
		?>
		<?php
			if($sujets->have_posts()) {
				echo '<div class="blocCorpsForum" style="background-image: url('.$backgroundForum.');">
						<h2>Sujets de discussion</h2>';
				echo $affichage;
				echo '<a class="boutonVersForumAccueil" href="'.get_bloginfo('url').'/forum">Aller sur le forum</a>
				</div>';
			}
		?>
		<div class="row lp-bloc-partenaires justify-content-center">
			<div class="col-10" id="partenaires">
				<h2>Nos partenaires</h2>
				<div class="row justify-content-center">
					<?php
						if($logoPartenaire1) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire1, $default).'"></div>';
						}
						if($logoPartenaire2) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire2, $default).'"></div>';
						}
						if($logoPartenaire3) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire3, $default).'"></div>';
						}
						if($logoPartenaire4) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire4, $default).'"></div>';
						}
						if($logoPartenaire5) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire5, $default).'"></div>';
						}
						if($logoPartenaire6) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire6, $default).'"></div>';
						}
						if($logoPartenaire7) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire7, $default).'"></div>';
						}
						if($logoPartenaire8) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire8, $default).'"></div>';
						}
						if($logoPartenaire9) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire9, $default).'"></div>';
						}
						if($logoPartenaire10) {
							echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><img src="'.wp_get_attachment_image_url($logoPartenaire10, $default).'"></div>';
						}
					?>
				</div>
			</div>
		</div>
		<div class="pageFAQ">
			<div class="row justify-content-center">
				<div class="col-10 div_faq_accordion accordion" data-speed="150">
					<?= $contentFAQ; ?>
				</div>
			</div>
		</div>
	</div>
	<script>
		//ACCORDION FAQ
		$('.accordion td').addClass('accordion-item');
		$('.accordion h3').addClass('accordion-title');
		$('.accordion p').addClass('accordion-content');
		$('.accordion').each(function(e) {
			var accordion = $(this);
			var toggleSpeed = accordion.attr('data-speed') || 100;
			function open(item, speed) {
				accordion.find('.accordion-item').not(item).removeClass('active')
					.find('.accordion-content').slideUp(speed);
				item.addClass('active')
					.find('.accordion-content').slideDown(speed);
			}
			open(accordion.find('.active:first'), 0);
			accordion.on('click', '.accordion-title', function(ev) {
				ev.preventDefault();
				open($(this).closest('.accordion-item'), toggleSpeed);
			});
		});

		// LIEN MENU EN EVIDENCE ET ANIMATION TITRE
		$(document).ready(function() {
			$('.navSecondMain > ul > li:nth-child(1) a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			});
		});
	</script>
<?php get_footer();  ?>