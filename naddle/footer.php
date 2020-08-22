<?php
    //$parametres = get_post_meta(136);
    $lienSiteAPT2N = get_post_meta(136, 'lien_site_apt2n', true);
    $lienFb = get_post_meta(136, 'lien_facebook_naddle', true);
    $lienTw = get_post_meta(136, 'lien_twitter_naddle', true);
    $lienInst = get_post_meta(136, 'lien_instagram_naddle', true);
    $lienYT = get_post_meta(136, 'lien_youtube_naddle', true);
?>
        </div>
        <div class="row blocFooterTop justify-content-center">
            <div class="col-10 col-lg-6 newsletterFooter">
                <p>Abonnez-vous à notre newsletter pour rester informé et recevoir toutes les actualités de Naddle par mail.</p>
                <?php echo do_shortcode('[mc4wp_form id="73"]'); ?>
            </div>
        </div>
        <div class="row blocFooterMiddle">
                <div class="col-12 col-md-4 colLiensFooter">
                    <?php $lienA = get_bloginfo('url').'/mentions-legales'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienA) ?>">Mentions légales</span>
                    <?php $lienB = get_bloginfo('url').'/sitemap.xml'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienB) ?>">Plan du site</span>
                    <?php $lienC = get_bloginfo('url').'/faq'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienC) ?>">FAQ</span>
                    <?php $lienD = get_bloginfo('url').'/donnees-personnelles'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienD) ?>">Données personnelles</span>    
                </div>
                <div class="col-12 col-md-4 colLiensFooter">
                    <?php $lienE = get_bloginfo('url').'/gestion-des-cookies'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienE) ?>">Gestion des cookies</span>
                    <?php $lienF = get_bloginfo('url').'/politique-de-confidentialite'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienF) ?>">Politique de confidentialité</span>
                    <?php $lienG = get_bloginfo('url').'/infos-pratiques'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienG) ?>">Infos pratiques</span>
                    <?php $lienH = get_bloginfo('url').'/presse'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienH) ?>">Presse</span>
                </div>
                <div class="col-12 col-md-4 colLiensFooter">
                    <?php $lienI = get_bloginfo('url').'/cgu'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienI) ?>">CGU / CGV</span>
                    <?php $lienJ = get_bloginfo('url').'/les-partenaires'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienJ) ?>">Les partenaires</span>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienSiteAPT2N) ?>">APT2N</span>
                    <?php $lienL = get_bloginfo('url').'/lagence'; ?>
                    <span class="loutreCannibale" data-loutre="<?= base64_encode($lienL) ?>">L'agence</span>
                </div>
        </div>
        <div class="row blocFooterBottom">
            <div class="col-12">
                <div class="row container-fluid sousBlocFooterBottom d-flex align-items-center">
                    <div class="col-6 footerCopyright">
                        <p>© 2020 Naddle | Tous droits réservés. Projet fictif.</p>
                    </div>
                    <div class="col-6 footerRS">
                        <span class="loutreCannibale" data-loutre="<?= base64_encode($lienFb) ?>"><i class="fab fa-facebook"></i></span>
                        <span class="loutreCannibale" data-loutre="<?= base64_encode($lienTw) ?>" ><i class="fab fa-twitter"></i></span>
                        <span class="loutreCannibale" data-loutre="<?= base64_encode($lienInst) ?>" ><i class="fab fa-instagram"></i></span>
                        <span class="loutreCannibale" data-loutre="<?= base64_encode($lienYT) ?>" ><i class="fab fa-youtube"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="<?php bloginfo('template_url');?>/js/jquery-ui-1.12.1/jquery-ui.min.js" async></script>
    <script src="<?php bloginfo('template_url');?>/bootstrap/js/bootstrap.js"></script> 
    <script src="<?php bloginfo('template_url');?>/js/popper.min.js"></script>
    <script src="<?php bloginfo('template_url');?>/js/scripts.js?ver=1.0"></script> 
	<script defer src="<?php bloginfo('template_url');?>/fontawesome/js/all.js"></script>						
    <?php  wp_footer() ?>
</html>