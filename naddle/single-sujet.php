<?php get_header(); ?>
<?php
    the_post();
    global $current_user;

    $likers = get_post_meta(get_the_ID(), 'likers', true);
    $titre = get_the_title();
    $contenu = get_the_content();
    $idPage = get_the_ID();
    if ((get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)) == (get_bloginfo('template_url').'/images/avatar.png')) {
        $lienImageAuteurTaVu = get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true);
    }
    else {
        $lienImageAuteurTaVu = wp_get_attachment_image_src(attachment_url_to_postid(get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)), 'thumbnail');
        $lienImageAuteurTaVu = $lienImageAuteurTaVu[0];
    }
    $imageAuteur = '<img class="" src="'.$lienImageAuteurTaVu.'">';
    $pseudoAuteur = get_the_author_meta('nickname');
    $statutAuteur = get_the_author_meta('wpcf-statut');
    $tabTerms = getTermTaxo(get_the_ID(), 'categorie');
    $nbLikers = get_post_meta(get_the_ID(), 'nb_likers', true);
    if(!empty($tabTerms)) {
        $termesSujet = '<div class="termesSujet2">Catégories : ';
        foreach($tabTerms as $term) {
            $termesSujet .= '<div class="termeSujet2">'.$term->name.'</div>';
        }
        $termesSujet .= '</div>';
    }
    $date = get_the_date();
    $likers = get_post_meta_json($idPage, 'likers');
    if (!in_array($current_user->ID, $likers)) {
        $styleCoeurCheck = 'coldHeart';
    }
    else {
        $styleCoeurCheck = 'fireHeart';
    }
?>


    <div class="blocPageSujet">
        <div class="row enteteBlocSujet">
            <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center blocAuteurPageSujet">
                <div>
                    <div class="postePar">Posté par :</div>
                    <div class="imgAuteurPageSujet"><?= $imageAuteur ?></div>
                    <div class="pseudoAuteurSujet"><?= $pseudoAuteur ?></div>
                    <div class="statutAuteurSujet"><?= $statutAuteur ?></div>
                </div>
            </div>
            <div class="col-12 col-lg-8 blocContenuSujetAuteur">
                <div class="titrePageSujet"><?= $titre ?></div>
                <div class="datePageSujet"><?= $date ?></div>
                <div class="contenuPageSujet"><?= $contenu ?></div>
                <div class="catPageSujet"><?= $termesSujet ?></div>
            </div>
            <div class="col-12 likePageSujet">
                <?php
                    if(is_user_logged_in()) {
                        echo '<div class="blocCoeur"><div class="like '.$styleCoeurCheck.'" id="coeurLike"><i class="fas fa-heart"></i></div></div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-none d-lg-block col-lg-3 blocTextRetourForum">
            <div class="textRetourForum">
                <a href="<?php bloginfo('url'); ?>/forum"><i class="fas fa-arrow-left"></i> Retour au forum</a>
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-12">
            <?php comments_template(); ?>
        </div>
    </div>
    <div class="col-12 d-lg-none blocTextRetourForum">
        <div class="textRetourForum">
            <a href="<?php bloginfo('url'); ?>/forum"><i class="fas fa-arrow-left"></i> Retour au forum</a>
        </div>
    </div>    

<!-- DEBUT DES SCRIPTS -->
    <script>
        jQuery(document).ready(function ($) {
                //SCRIPTS AJAX AJOUT LIKES
                $('#coeurLike').on( 'click', function () {
                    var post = <?php the_ID() ?>; 
                    var user = <?php echo $current_user->ID ?>;
                    var nbLikers = <?php echo $nbLikers ?>;
                        jQuery.ajax({
                            url:  ajaxurl.ajax_url,
                            type: 'post',
                            data: 'action=ajoutLikePost' + '&userID=' + user + '&postID=' + post + '&nbLikes=' + nbLikers,
                            complete: function ( response ) {  

                            }, 
                            success: function ( response ) {  
                                if (Object.keys(response).length == 4) {
                                    $('#coeurLike').addClass("coldHeart");
                                    $('#coeurLike').removeClass("fireHeart");
                                    $('#coeurLike').append('<div class="disparitionCoeur">-1</div>');
                                    setTimeout(function(){ $('.disparitionCoeur').remove(); }, 1000);
                                } 
                                else {
                                    $('#coeurLike').addClass("fireHeart");
                                    $('#coeurLike').removeClass("coldHeart");
                                    $('#coeurLike').append('<div class="apparitionCoeur">+1</div>');
                                    setTimeout(function(){ $('.apparitionCoeur').remove(); }, 1000);
                                }
                            },
                            error: function ( errorThrown ) {

                            }, 
                        });
                });
            
            $('.logged-in-as a:first-child').removeAttr("href");

		    // LIEN MENU EN EVIDENCE
			$('.navSecondMain > ul > li:nth-child(6) a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
	</script>
<?php get_footer(); ?>