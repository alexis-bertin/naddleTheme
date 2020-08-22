<?php 
    get_header(); 
	the_post();
	global $current_user;
	$statut = get_user_meta($current_user->ID, 'wpcf-statut', true);
	$imagePageBenevole = get_post_meta( get_the_ID(), 'image_entete', true);
	$imagePageBenevole = wp_get_attachment_image_url($imagePageBenevole, $default);
	$soustitre = get_post_meta( get_the_ID(), 'sous_titre_entete', true);
	$texte1 = get_post_meta( get_the_ID(), 'texte_1', true);
	$texte2 = get_post_meta( get_the_ID(), 'texte_2', true);
    $nomUser = get_user_meta( $current_user->ID, 'last_name', true );
    $prenomUser = get_user_meta( $current_user->ID, 'first_name', true );
    $villeUser = get_user_meta($current_user->ID, 'wpcf-adresse-ville', true);
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args=array(
			'post_type' => 'annonce',
			'posts_per_page' => 9,
			'paged' => $paged
	);
	$annonces = new WP_Query($args);

	if (!is_user_logged_in()) {
		$affichage = '	<div id="blocPostuler" class="row blocPasConnecteBenevole">
							<div class="col-12">
								<div class="messagePasPossible">
									<p>Vous devez être connecté pour pouvoir postuler.</p>
								</div>
								<div class="boutonPasPossible">
									<a href="'.get_bloginfo('url').'/?login=connect">Se connecter</a>
								</div>
							</div>
						</div>';
	}
	elseif(empty($nomUser) || empty($prenomUser) || empty($villeUser)) {
		$affichage = '<div id="blocPostuler" class="row blocPasConnecteBenevole">
							<div class="col-12">
								<div class="messagePasPossible">
									<p>Vous devez remplir les informations de votre compte pour postuler.</p>
								</div>
								<div class="boutonPasPossible">
									<a href="'.get_bloginfo('url').'/mon-compte/?modificationProfil=allezcestparti">Mon compte</a>
								</div>
							</div>
						</div>';

	}
	elseif($statut !== 'Bénévole') {
		$affichage = '	<div id="blocPostuler" class="row justify-content-center blocParticipationWeez" id="blocParticiperWeez">
							<div class="col-12 titreWeez"><h2>Postuler pour être bénévole</h2></div>
							<div class="col-12 col-lg-10">
								'.do_shortcode('[ninja_form id=3]').'
							</div>
						</div>';
	}
	else {
		$affichage .= '<div class="grosBlocAnnonces">';
		$affichage .= '<h3>Annonces pour les bénévoles</h3>';
		while($annonces->have_posts()) {
			$annonces->the_post();
			$content = apply_filters('the_content',$post->post_content);
            $affichage .= '<div class="col-12 annonceBenevole"><div class="blocAnnonceBenevole"><div class="dateAnnonceBenevole">le '.get_the_date().'</div><div class="contenuAnnonceBenevole">'.$content.'</div></div></div>';
		}
		$affichage .= '</div>';
	}
?>
	<div class="row blocEnteteParticiper blocEnteteBenevole d-flex align-items-center justify-content-center" style="background-image: url('<?= $imagePageBenevole ?>')">
        <div class="sousBlocEnteteParticiper">
            <h1>bénévoles</h1>
			<div class="descParticiper descBenevoles"><?= $soustitre ?></div>
			<?php if($statut !== 'Bénévole') {
					echo '<a href="#blocPostuler">Postuler</a>';
				  }
			?> 
        </div>
    </div>
	<div class="row blocTexte1Benevole justify-content-center">
		<div class="col-12">
			<p><?= $texte1 ?></p>
		</div>
	</div>
	<div class="row blocTexte2Benevole justify-content-center">
		<div class="col-12">
			<p><?= $texte2 ?></p>
		</div>
	</div>
	<?= $affichage ?>
	<div class="row blocPagination">
        <?php if($statut == 'Bénévole') { wpex_pagination_annonces(); } ?>
    </div>
    <script>
		// LIEN MENU EN VERT
		$(document).ready(function() {
			$('.sousBlocEnteteParticiper').css({
				'animation' : 'titleAccueil .5s',
				'animation-fill-mode' : 'forwards'
			});
			$('.navSecondMain > ul > li:nth-child(4) > a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
    </script>
<?php get_footer(); ?>