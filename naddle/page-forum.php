<?php 
    $action = $_GET['action'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if($action == 'ajoutSujet' && !is_user_logged_in()) {
            wp_redirect(home_url());
    }
    if($action == 'newSujet') {
        $messageNouveauSujet = '<div class="messageReussiteModifProfil">Votre sujet a bien été posté.</div>';
    }
    if($action != "ajoutSujet") {
        $args=array(
            'post_type' => 'sujet',
            'posts_per_page' => 9,
            'paged' => $paged
        );
        $sujets = new WP_Query($args);
        $ilYaUnMois = date('Y-m-d', strtotime('-1 months'));
        $args2 = array( 'post_type' => 'sujet',
                        'meta_key'			=> 'nb_likers',
                        'orderby'			=> 'meta_value',
                        'order'				=> 'DESC',
                        'posts_per_page' => 3,
                        'date_query'    => array(
                            'column'  => 'post_date',
                            'after'   => '- 30 days'
                        ),
                        'meta_query' => array(
                            array(
                                'key' => 'nb_likers',
                                'value' => 0,
                                'compare' => '>' 
                            )
                        )    
        );
        $sujetsPop = new WP_Query($args2);
    }    
    $postTitre = $_POST['titre'];
    $postCorps = $_POST['corps'];
    $postCategories = $_POST['categorie'];
    if(isset($_POST['envoiSujet'])) {
        if (empty($postTitre) || empty($postCorps) || count($postCategories) > 2) {
            //AIE
        }
        else {
            $nouveauSujet = wp_insert_post( 
                array(
                    'post_title'=>$postTitre,
                    'post_content'=>nl2br(htmlspecialchars($postCorps)),
                    'post_status'=>'publish',
                    'post_type'=>'sujet'
                )
            );
            update_post_meta($nouveauSujet, 'nb_likers', 0);
            wp_set_post_terms($nouveauSujet, array_slice($postCategories, 0, 2), 'categorie');
            wp_redirect(get_bloginfo('url').'/forum/?action=newSujet');
        }
    }
    get_header(); 
    the_post();
    $imagePageForum = get_post_meta( get_the_ID(), 'image_entete_forum', true);
    $descriptionPageForum = get_post_meta( get_the_ID(), 'description_page_forum', true);
?>
<?php
    global $current_user;
    //RECUPERE LES TERMES DE LA TAXO CATEGORIE
    $taxonomie= get_check_terms_taxo_post('','categorie');
    //AJOUT D'UN SUJET
    if($action == "ajoutSujet") {
        if(is_user_logged_in()) {
            $affichageAjout = '<div class="row">
                                <h2>Poster un sujet</h2>
                            </div>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-8 blocInputSujMess">';
            $champTitreSujet = '<div><label for="sujetTitre">Titre du sujet</label><input required id="sujetTitre" class="form-control" name="titre" type="text" value="'.$postTitre.'"></div>';
            $champCorpsSujet = '<div><label for="sujetCorps">Votre message</label><textarea required id="sujetCorps" class="form-control" name="corps" type="text">'.$postCorps.'</textarea></div>';
            $affichage2 = '<input type="hidden" name="envoiSujet" value="envoi">
                                </div>
                                <div class="col-12 col-lg-4 blocInputCategories">
                                    <h3>Catégories</h3>
                                    <div class="listCategoriesPost">'.$taxonomie.'</div>
                                </div>
                                <button class="boutonAjoutSujet2" name="action" type="submit" value="poster">Poster</button>
                            </div>
                        </form>';
        }
    }
    //PAGE DE FORUM AVEC LES SUJETS
    else {
        if(is_user_logged_in()) {
            $boutonAjoutSujet = '<div class="boutonAjoutSujet"><a href="'.get_bloginfo('url').'/forum/?action=ajoutSujet">Poster un sujet</a></div>';
        }
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
        while($sujetsPop->have_posts()) {
            $sujetsPop->the_post();
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
            $affichagePop .= '<div class="blocSingleSujetPop">
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
                                        <div class="row basSujetForum d-flex align-items-end">
                                            <div class="catSujets">
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
    }

    //GERE LES CHAMPS EN ROUGE ET LES MESSAGE DERREUR
    if(isset($_POST['envoiSujet'])) {
        if (empty($postTitre) || empty($postCategories)) {
            if (empty($postTitre) && !empty($postCorps)) {
                $champTitreSujet = '<div><label for="sujetTitre">Titre du sujet</label><input style="border-color: red;" required id="sujetTitre" class="form-control" name="titre" type="text"></div>';
                $messageErreur = '<div class="messageErreurModifProfil">Veuillez entrer un titre de sujet.</div>';
            }
            elseif (!empty($postTitre) && empty($postCorps)) {
                $champCorpsSujet = '<div><label for="sujetCorps">Votre message</label><textarea style="border-color: red;" required id="sujetCorps" class="form-control" name="corps" type="text"></textarea></div>';
                $messageErreur = '<div class="messageErreurModifProfil">Veuillez entrer un message pour le sujet.</div>';
            }
            else {
                $champTitreSujet = '<div><label for="sujetTitre">Titre du sujet</label><input style="border-color: red;" required id="sujetTitre" class="form-control" name="titre" type="text"></div>';
                $champCorpsSujet = '<div><label for="sujetCorps">Votre message</label><textarea style="border-color: red;" required id="sujetCorps" class="form-control" name="corps" type="text"></textarea></div>';
                $messageErreur = '<div class="messageErreurModifProfil">Veuillez entrer un titre de sujet et un message.</div>';
            }
        }
        elseif(count($postCategories) > 2) {
            $champTitreSujet = '<div><label for="sujetTitre">Titre du sujet</label><input required id="sujetTitre" class="form-control" name="titre" type="text" value="'.$postTitre.'"></div>';
            $champCorpsSujet = '<div><label for="sujetCorps">Votre message</label><textarea required id="sujetCorps" class="form-control" name="corps" type="text">'.$postCorps.'</textarea></div>';
            $messageErreur = '<div class="messageErreurModifProfil">Veuillez choisir au maximum 2 catégories.</div>';
        }
    }
?>
    <div class="blocEnteteForum  d-flex align-items-center justify-content-center" style="background-image: url('<?= wp_get_attachment_url($imagePageForum) ?>')">
        <div class="sousBlocEnteteForum">
            <h1>forum</h1>
            <div class="descForum"><?= $descriptionPageForum ?></div>
            <?= $boutonAjoutSujet ?>
        </div>
    </div>
    <?= $messageNouveauSujet ?>
    <?= $messageErreur ?>
    <div class="blocPopForum">
        <?php 
           if($action !== "ajoutSujet") {
                if($sujetsPop->have_posts() && $action !== 'ajoutSujet') {
                    echo '<div class="lesPlusPopulaires"><h2>Les plus populaires</h2></div>';
                }
            }
        echo $affichagePop;
        ?>
    </div>
    <div class="blocBlocBloc">
        <?php
            if($action !== "ajoutSujet") {
                if($sujets->have_posts() && $action !== 'ajoutSujet') {
                    $taxonomie= get_check_terms_taxo_post('','categorie');
                    echo   '<div class="col-12 col-lg-4 blocFiltreCategories">
                                <div class="iconFiltre"><i class="fas fa-filter"></i></div>
                                <h3>Filtrer par...</h3>
                                <div class="listCategoriesFiltre" id="checkedCategories">'.$taxonomie.'</div>
                                <input type="submit" id="submit" value="Filtrer" />';
                    if (is_user_logged_in()) { echo '<input type="submit" id="submit2" value="Mes derniers likes" />'; }
                    echo '</div>';
                }
            } 
        ?>          
        <div class="blocCorpsForum">
            <?php 
            if($action !== "ajoutSujet") {
                    if($sujets->have_posts() && $action !== 'ajoutSujet') {
                        echo '<div class="lesPlusRecents"><h2>Les plus récents</h2></div>';
                    }
                    elseif($action !== 'ajoutSujet') {
                        echo '<div class="noPosts">Il n\'y a pas de sujet pour le moment.</div>';
                    }
                }
            ?>
            <?= $affichageAjout ?>
            <?= $champTitreSujet ?>
            <?= $champCorpsSujet ?>
            <?= $affichage2 ?>
            <?= $affichage ?>
        </div>
        <div class="row blocPagination">
            <?php if($action !== "ajoutSujet") { wpex_pagination_sujets(); } ?>
        </div>
    </div>
    <script>
        //AJAX FILTRE
        $(document).ready(function(){
            $(document).click(function(event) { 
                if(!$(event.target).closest('.blocFiltreCategories').length){
                    $('.blocFiltreCategories').removeClass("ouvert");
                }
            });
            $("#checkedCategories input:checked").prop("checked", false);
            $("#submit").click(function(e){
                $('.blocFiltreCategories').removeClass("ouvert");
                var catSelected = [];
                $.each($("#checkedCategories input[name='categorie[]']:checked"), function(){
                    catSelected.push($(this).val());
                });
                jQuery.ajax({
                    url:  ajaxurl.ajax_url,
                    type: 'post',
                    data: 'action=filtreSujets' + '&filtreCat=' + catSelected,
                    complete: function ( response ) {  

                    }, 
                    success: function ( response ) {  
                        var recuperation = jQuery.parseJSON(response);
                        console.log(recuperation);
                        $('.blocCorpsForum').html(recuperation.html);
                        if(recuperation.filtrage) {
                            $('.blocPagination').hide();
                        }
                        else {
                            $('.blocPagination').show();
                        }
                    },
                    error: function ( errorThrown ) {

                    }, 
                });
            });
            $("#submit2").click(function(e){
                $('.blocFiltreCategories').removeClass("ouvert");
                var user = <?php echo $current_user->ID ?>;
                jQuery.ajax({
                    url:  ajaxurl.ajax_url,
                    type: 'post',
                    data: 'action=filtreSujets' + '&filtreLike=' + user,
                    complete: function ( response ) {  

                    }, 
                    success: function ( response ) {  
                        var recuperation = jQuery.parseJSON(response);
                        console.log(recuperation);
                        $('.blocCorpsForum').html(recuperation.html);
                        if(recuperation.filtrage) {
                            $('.blocPagination').hide();
                        }
                        else {
                            $('.blocPagination').show();
                        }
                    },
                    error: function ( errorThrown ) {

                    }, 
                });
            });
        });

		// LIEN MENU EN EVIDENCE
		$(document).ready(function() {
            $('.sousBlocEnteteForum').css({
				'animation' : 'titleAccueil .5s',
				'animation-fill-mode' : 'forwards'
			});
            $('.iconFiltre').click(function() {
                $('.blocFiltreCategories').toggleClass("ouvert");
            });
			$('.navSecondMain > ul > li:nth-child(6) a').css({
				'padding-bottom' : '10px',
				'border-bottom' : '5px solid white'
			})
		});
	</script>
<?php get_footer(); ?>