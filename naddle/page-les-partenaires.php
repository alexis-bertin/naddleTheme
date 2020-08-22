<?php 
    get_header(); 
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
    $lienPartenaire1 = get_post_meta(136, 'lien_partenaire_1', true);
    $lienPartenaire2 = get_post_meta(136, 'lien_partenaire_2', true);
    $lienPartenaire3 = get_post_meta(136, 'lien_partenaire_3', true);
    $lienPartenaire4 = get_post_meta(136, 'lien_partenaire_4', true);
    $lienPartenaire5 = get_post_meta(136, 'lien_partenaire_5', true);
    $lienPartenaire6 = get_post_meta(136, 'lien_partenaire_6', true);
    $lienPartenaire7 = get_post_meta(136, 'lien_partenaire_7', true);
    $lienPartenaire8 = get_post_meta(136, 'lien_partenaire_8', true);
    $lienPartenaire9 = get_post_meta(136, 'lien_partenaire_9', true);
    $lienPartenaire10 = get_post_meta(136, 'lien_partenaire_10', true);
    $descPartenaire1 = get_post_meta(136, 'description_partenaire_1', true);
    $descPartenaire2 = get_post_meta(136, 'description_partenaire_2', true);
    $descPartenaire3 = get_post_meta(136, 'description_partenaire_3', true);
    $descPartenaire4 = get_post_meta(136, 'description_partenaire_4', true);
    $descPartenaire5 = get_post_meta(136, 'description_partenaire_5', true);
    $descPartenaire6 = get_post_meta(136, 'description_partenaire_6', true);
    $descPartenaire7 = get_post_meta(136, 'description_partenaire_7', true);
    $descPartenaire8 = get_post_meta(136, 'description_partenaire_8', true);
    $descPartenaire9 = get_post_meta(136, 'description_partenaire_9', true);
    $descPartenaire10 = get_post_meta(136, 'description_partenaire_10', true);
?>

    <div class="pagePartenaires">
        <h2 >les partenaires</h2>
        <div class="row justify-content-center">
            <?php
                if($logoPartenaire1) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire1.'"><img src="'.wp_get_attachment_image_url($logoPartenaire1, $default).'"></a><p>'.$descPartenaire1.'</p></div>';
                }
                if($logoPartenaire2) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire2.'"><img src="'.wp_get_attachment_image_url($logoPartenaire2, $default).'"></a><p>'.$descPartenaire2.'</p></div>';
                }
                if($logoPartenaire3) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire3.'"><img src="'.wp_get_attachment_image_url($logoPartenaire3, $default).'"></a><p>'.$descPartenaire3.'</p></div>';
                }
                if($logoPartenaire4) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire4.'"><img src="'.wp_get_attachment_image_url($logoPartenaire4, $default).'"></a><p>'.$descPartenaire4.'</p></div>';
                }
                if($logoPartenaire5) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire5.'"><img src="'.wp_get_attachment_image_url($logoPartenaire5, $default).'"></a><p>'.$descPartenaire5.'</p></div>';
                }
                if($logoPartenaire6) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire6.'"><img src="'.wp_get_attachment_image_url($logoPartenaire6, $default).'"></a><p>'.$descPartenaire6.'</p></div>';
                }
                if($logoPartenaire7) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire7.'"><img src="'.wp_get_attachment_image_url($logoPartenaire7, $default).'"></a><p>'.$descPartenaire7.'</p></div>';
                }
                if($logoPartenaire8) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire8.'"><img src="'.wp_get_attachment_image_url($logoPartenaire8, $default).'"></a><p>'.$descPartenaire8.'</p></div>';
                }
                if($logoPartenaire9) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire9.'"><img src="'.wp_get_attachment_image_url($logoPartenaire9, $default).'"></a><p>'.$descPartenaire9.'</p></div>';
                }
                if($logoPartenaire10) {
                    echo '<div class="col-12 col-sm-6 col-lg-3 bloc-img-partenaires"><a target="_blank" href="'.$lienPartenaire10.'"><img src="'.wp_get_attachment_image_url($logoPartenaire10, $default).'"></a><p>'.$descPartenaire10.'</p></div>';
                }
            ?>
        </div>
    </div>  

<?php get_footer(); ?>