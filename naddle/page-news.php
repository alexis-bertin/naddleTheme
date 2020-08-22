<?php get_header(); ?>
    <?php
        $messageAlerteAvant = "";
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $argsAvant=array(
            'post_type' => 'actualite',
            'meta_key' => 'wpcf-mettre-en-avant',
            'meta_compare' => '==',
            'meta_value' => 1
        );
        $args=array(
                'post_type' => 'actualite',
                'posts_per_page' => 9,
                'paged' => $paged,
                'meta_key' => 'wpcf-mettre-en-avant',
                'meta_compare' => '!=',
                'meta_value' => 1
        );
        $actualites = new WP_Query($args);
        $actusAvant = new WP_Query($argsAvant);
        $x = 0;
        $y = 0;
        while($actualites->have_posts()) {
            $actualites->the_post();
            $imageActu = get_post_meta(get_the_ID(), 'wpcf-image-actualite', true);
            $styleImageActu = 'style="background-image: url(\''.$imageActu.'\');"';
            $affichage .= '<div class="col-12 col-lg-4 paddingNews"><div class="blocLargeNews"'.$styleImageActu.'><a class="blocActuPres d-flex align-items-center" href="'.get_the_permalink().'"><div class="jppJeSuisCreve"><div class="titleCardNews">'.get_the_title().'</div><div class="dateCardNews">le '.get_the_date().'</div></div></a></div></div>';
        }
        while($actusAvant->have_posts()) {
            $actusAvant->the_post();
            $y += 1;
        }
        while($actusAvant->have_posts() && $x < 1) {
            $actusAvant->the_post();
            $imageActu2 = get_post_meta(get_the_ID(), 'wpcf-image-actualite', true);
            $styleImageActu2 = 'style="background-image: url(\''.$imageActu2.'\');"';
            $affichage2 .= '<div class="col-12 paddingNews"><div class="blocLargeNews"'.$styleImageActu2.'><a class="blocActuPres d-flex align-items-center" href="'.get_the_permalink().'"><div class="jppJeSuisCreve"><div class="titleCardNews">'.get_the_title().'</div><div class="dateCardNews">le '.get_the_date().'</div></div></a></div></div>';
            $x += 1;
        }
        if($y > 1 && ($current_user->user_level==10 || $current_user->user_level==7)) {
            $messageAlerteAvant = '<div class="messagePenseBete">Attention, vous avez mis plusieurs actualités en avant. <a target="_blank" href="'.get_bloginfo('url').'/wp-admin/edit.php?post_type=actualite">Modifier</a></div>';
        }
    ?>
    <?= $messageAlerteAvant ?>
    <div class="row titrePageNews">
        <h1>news</h1>
    </div>
    <div class="row blocNewsAvant">
        <div class="row container-fluid blocLastNews">
            <div class="col-12">
                <div class="row justify-content-center grosBlocActus">
                    <?= $affichage2 ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row container-fluid blocLastNews">
        <div class="col-12">
            <h2>Les dernières actualités</h2>
            <div class="row justify-content-center grosBlocActus">
                <?= $affichage ?>
            </div>
        </div>
    </div>
    <div class="row blocPagination">
        <?php wpex_pagination(); ?>
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