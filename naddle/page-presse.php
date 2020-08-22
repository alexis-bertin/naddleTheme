<?php 
    get_header(); 
    the_post();
    $fichier1 = get_field('fichier_presse_1');
    $fichier2 = get_field('fichier_presse_2');
    $fichier3 = get_field('fichier_presse_3');
    $fichier4 = get_field('fichier_presse_4');
    $fichier5 = get_field('fichier_presse_5');
    $fichier6 = get_field('fichier_presse_6');
    $fichier7 = get_field('fichier_presse_7');
    $fichier8 = get_field('fichier_presse_8');
    $fichier9 = get_field('fichier_presse_9');
    $fichier10 = get_field('fichier_presse_10');
    $fichier11 = get_field('fichier_presse_11');
    $fichier12 = get_field('fichier_presse_12');
?>
    <div class="pagePresse row justify-content-center">
        <h2 class="col-12">presse</h2>   
        <div class="col-10">
            <?php
                if($fichier1['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier1['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier1['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier2['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier2['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier2['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier3['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier3['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier3['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier4['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier4['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier4['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier5['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier5['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier5['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier6['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier6['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier6['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier7['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier7['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier7['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier8['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier8['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier8['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier9['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier9['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier9['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier10['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier10['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier10['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier11['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier11['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier11['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
                if($fichier12['fichier']) {
                    echo '<div class="blocPresse">
                        <h4>'.$fichier12['titre_fichier'].'</h4>
                        <a target="blank" href="'.$fichier12['fichier']['link'].'">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>';
                }
            ?>
        </div>
    </div>

<?php get_footer(); ?>