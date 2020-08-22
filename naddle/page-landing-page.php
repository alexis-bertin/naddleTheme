<?php get_header(); ?>
<?php
    the_post();
    $backgroundEntete = get_post_meta( get_the_ID(), 'image_entete', true);
    $backgroundEntete = wp_get_attachment_image_url($backgroundEntete, $default);
    $sousTitreEntete = get_post_meta( get_the_ID(), 'sous-titre_principal', true);
    $iconePres1 = get_post_meta( get_the_ID(), 'icone_presentation_1', true);
    $iconePres1 = wp_get_attachment_image_url($iconePres1, $default);
    $iconePres2 = get_post_meta( get_the_ID(), 'icone_presentation_2', true);
    $iconePres2 = wp_get_attachment_image_url($iconePres2, $default);
    $iconePres3 = get_post_meta( get_the_ID(), 'icone_presentation_3', true);
    $iconePres3 = wp_get_attachment_image_url($iconePres3, $default);
    $textePres1 = get_post_meta( get_the_ID(), 'texte_presentation_1', true);
    $textePres2 = get_post_meta( get_the_ID(), 'texte_presentation_2', true);
    $textePres3 = get_post_meta( get_the_ID(), 'texte_presentation_3', true);
    $texteOrga = get_post_meta(136, 'texte_organisateur', true);
    $logoOrga = get_post_meta(136, 'logo_organisateur', true);
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
    $adresse = get_post_meta(136, 'adresse_postale_organisateur', true);
    $mail = get_post_meta(136, 'mail_organisateur', true);
    $telephone = get_post_meta(136, 'telephone_organisateur', true);
    $adresseCarte = get_post_meta( get_the_ID(), 'adresse_carte', true);
    $facebook = get_post_meta(136, 'lien_facebook_naddle', true);
    $twitter = get_post_meta(136, 'lien_twitter_naddle', true);
    $instagram = get_post_meta(136, 'lien_instagram_naddle', true);
?>
<div class="landing-page">
<div class="row">
    <div id="entete-landing-page" class="col-12 lp-entete" style="background-image: url('<?php echo $backgroundEntete; ?>'); background-color: black;">
        <div class="row lp-menu">
            <div class="col-12 col-lg-2 lp-logo-menu d-flex justify-content-center">
                <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url');  ?>/images/logo-naddle-white.png" alt=""></a>
            </div>
            <div class="d-none col-lg-10 d-lg-inline-block lp-menu-entete">
                <nav class="navbar navbar-expand-lg navbar-light navbar-right">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="#evenement">L'événement</a></li>
                        <li class="nav-item"><a href="#organisateur">L'organisateur</a></li>
                        <li class="nav-item"><a href="#partenaires">Les partenaires</a></li>
                        <li class="nav-item"><a href="#sabonner">S'abonner</a></li>
                        <li class="nav-item"><a href="#carte">Où ?</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center lp-entete-bloc-formulaire">
            <div class="col-10 col-lg-8 lp-infosentete">
                <h1>Naddle</h1>
                <p class="lp-desc-soustitre"><?= $sousTitreEntete ?></p>
            </div>
            <div class="col-10 col-lg-6 lp-form-entete">
                <?php echo do_shortcode('[mc4wp_form id="73"]'); ?>
            </div>
        </div>
    </div>
</div>
<div class="row lp-bloc-evenement justify-content-center">
    <div class="col-10" id="evenement">
        <h2>L'événement</h2>
        <div class="row justify-content-around">
            <div class="col-12 col-lg-3 lp-carte-levenement">
                <img src="<?= $iconePres1 ?>" alt="">
                <p><?= $textePres1 ?></p>
            </div>
            <div class="col-12 col-lg-3 lp-carte-levenement">
                <img src="<?= $iconePres2 ?>" alt="">
                <p><?= $textePres2 ?></p>
            </div>
            <div class="col-12 col-lg-3 lp-carte-levenement">
                <img src="<?= $iconePres3 ?>" alt="">
                <p><?= $textePres3 ?></p>
            </div>
        </div>
    </div>
</div>
<div class="row lp-bloc-organisateur justify-content-around" id="organisateur">
    <div class="order-2 order-lg-1 col-12 col-sm-10 col-lg-7 orga-text">
        <p><?= $texteOrga ?></p>
    </div>
    <div class="order-1 order-lg-2 col-12 col-sm-5 col-lg-3 orga-image">
        <?= '<img src="'.wp_get_attachment_image_url($logoOrga, $default).'">' ?>
    </div>
</div>
<div class="row lp-bloc-partenaires justify-content-center">
    <div class="col-10" id="partenaires">
        <h2>Les partenaires</h2>
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
<div class="row lp-bloc-sabonner justify-content-center">
    <div class="col-10" id="sabonner">
        <h2>S'abonner</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-lg-8 lp-form-entete">
                <?php echo do_shortcode('[mc4wp_form id="73"]'); ?>
            </div>
        </div>
    </div>
</div>
<div class="row lp-bloc-carte-contact">
    <div id="carte" class="lp-bloc-map col-12"></div>
    <div class="col-12 col-lg-12 lp-bloc-contact-map">
        <h3>Nous contacter</h3>
        <ul style="list-style-image: url('<?php bloginfo('template_url'); ?>/images/puce-contact.png');">
            <li><?= $adresse ?></li>
            <li><?= $telephone ?></li>
            <li><?= $mail ?></li>
        </ul>
    </div>
</div>
<div class="row d-flex flex-row justify-content-between lp-footer">
    <div class="lp-bottom-link">
        <a href="<?php bloginfo('url'); ?>">naddle.fr</a>
    </div>
    <div class="lp-bottom-rs offset-sm-6">
        <a href="<?= $facebook ?>" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="<?= $twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="<?= $instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjz8nPtnvwXIxFjgpsfaqRRF86PFZKE8E&libraries=geometry&libraries=places"></script>
<script>
    $(document).ready(function() {	
        var zoneAdresse="<?= $adresseCarte ?>";
        var zoneMap="carte";
        var icon = {
            url: "<?php echo bloginfo('template_url') ?>/images/marker.png",
            scaledSize: new google.maps.Size(100, 100),
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(50, 100)
        };
        var zoom=14;
        createMapIcon(zoneAdresse,zoneMap,icon,zoom);
        $('.blocFooterTop').remove();
        $('.blocFooterMiddle').remove();
        $('.blocFooterBottom').remove();
    });
</script>
<?php get_footer(); ?>