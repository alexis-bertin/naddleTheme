<?php get_header(); ?>
<?php
	the_post();
	$imageActu = get_post_meta(get_the_ID(), 'wpcf-image-actualite', true);
	$mettreAvant = get_post_meta(get_the_ID(), 'wpcf-mettre-en-avant', true);
	$styleImageActu = 'style="background-image: url(\''.$imageActu.'\');"';
?>
	<div class="row">
		<div class="col-12 blocEnteteActu d-flex align-items-center" <?= $styleImageActu ?>>
			<div class="sousBlocEnteteActu">
				<div class="blocTitleActu"><h2><?php the_title(); ?></h2></div>
				<div class="blocTitleActu">le <?php the_date(); ?></div>
			</div>
		</div>
	</div>
    <div class="row justify-content-center">
		<div class="col-12 col-lg-8 blocContenuActu">
			<?php the_content(); ?>
		</div>
	</div>
	<div class="col-12 col-lg-4 blocTextRetourActus">
		<div class="textRetourActus">
			<a href="<?php bloginfo('url'); ?>/news"><i class="fas fa-arrow-left"></i> Retour aux actualités</a>
		</div>
	</div>
    <script>
		// LIEN MENU EN EVIDENCE
		$(document).ready(function() {
			$('.navSecondMain > ul > li:nth-child(5) a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
	</script>
<?php get_footer(); ?>