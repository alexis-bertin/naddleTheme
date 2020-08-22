<?php 
	get_header(); 
	the_post();
	$video = get_post_meta(get_the_ID(), 'iframe_video', true);
?>
	<div class="row blocTitreGalerie">
        <div class="col-12 titreGalerie">
            <h1>galerie</h1>
        </div>
    </div>
	<div class="row videoYouTubeGalerie">
		<?= $video ?>
	</div>
	<?php if ( function_exists( 'envira_gallery' ) ) { envira_gallery( '497' ); } ?>
    <script>
		// LIEN MENU EN VERT
		$(document).ready(function() {
			$('.navSecondMain > ul > li:nth-child(2) > a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
    </script>
<?php get_footer(); ?>