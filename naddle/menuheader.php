<?php
	get_template_part("/modules/login_modal/template");
	global $lienLoginOut;
	global $lienLoginOutInscription;
    global $current_user;
    $lienInscription = "";
    $lienBackOffice = "";
    $enteteMenuResponsive = "";
    $imageProfilUser = get_user_meta($current_user->ID, 'wpcf-image-de-profil', true);
    $nomUser = get_user_meta( $current_user->ID, 'last_name', true );
    $prenomUser = get_user_meta( $current_user->ID, 'first_name', true );
    $statutUser = get_user_meta($current_user->ID, 'wpcf-statut', true);
    $villeUser = get_user_meta($current_user->ID, 'wpcf-adresse-ville', true);
    
    if (is_user_logged_in()) {
        $divMenuResponsive = '<div class="col-12 divConnecte">';
        $enteteMenuResponsive .= '<div class="enteteMenuResponsiveConnecte">';
        $enteteMenuResponsive .= '<div class="col imageDeProfilUser"><img src="'.$imageProfilUser.'"></div>';
        $enteteMenuResponsive .= '<div class="col nomPrenomUser">'.$prenomUser.' <div style="text-transform: uppercase; display: inline;"> '.$nomUser.'</div></div>';
        $enteteMenuResponsive .= '<div class="col statutUser">'.$statutUser.'</div>';
        if ($current_user->user_level==10 || $current_user->user_level==7 || $current_user->user_level==2) {
            $lienBack1 = get_bloginfo('url').'/wp-admin';
            $lienBackOffice='<li class="nav-item"><span class="loutreCannibale" data-loutre="'.base64_encode($lienBack1).'"><i class="fas fa-user-cog"></i> Back Office</span></li>';
        } else {
            if(empty($nomUser) || empty($prenomUser) || empty($villeUser)) {
                $lienCompte1 = get_bloginfo('url').'/mon-compte/';
                $lienBackOffice = '<li class="nav-item elementPuceRouge"><span class="loutreCannibale" data-loutre="'.base64_encode($lienCompte1).'">Mon compte</span></li>';
            }
            else {
                $lienCompte1 = get_bloginfo('url').'/mon-compte/';
                $lienBackOffice='<li class="nav-item"><span class="loutreCannibale" data-loutre="'.base64_encode($lienCompte1).'">Mon compte</span></li>';
            }
        } 
        $enteteMenuResponsive .= "</div>";
    } else {
        $divMenuResponsive = '<div class="col-12 divDeconnecte">';
        $enteteMenuResponsive .= '<div class="enteteMenuResponsiveDeconnecte">';
        $enteteMenuResponsive .= '<div class="logoMenuResponsiveDeco"><img src="'.get_bloginfo('template_url').'/images/icone-final.png" alt=""></div>';
        $enteteMenuResponsive .= "</div>";
        $lienInscription='<li class="nav-item">'.$lienLoginOutInscription.'</li>';
    }
?>
<div class="row topMenuHeader">
    <div class="col-8 offset-2 offset-lg-0 col-lg-2 d-flex justify-content-center">
        <a class="navbar-brand logo-menuPrincipal" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url');  ?>/images/logo-final.png" alt=""></a>
    </div>
    <div class="d-none col-lg-10 d-lg-inline-block">
        <nav class="navbar navbar-expand-lg navbar-light navbar-right coMenuGrand">
            <ul class="navbar-nav">
                <?php echo $lienParametres ?>
                <?php echo $lienBackOffice ?>
                <?php echo $lienInscription ?>
                <li class="nav-item"><?php echo $lienLoginOut; ?></li>
            </ul>
        </nav>
    </div>
    <div id="burgerMenuSticky" class="d-lg-none blocCroixMenu align-self-center">
            <div class="croix-menu" onclick="menuResponsive(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
    </div>
</div>
<div class="row d-none d-lg-inline-block col-12 blocNavSecondMain">
    <nav id="menuTopSticky" class="navbar navbar-expand-lg justify-content-center navSecondMain" role="navigation">
        <ul class="nav navbar-nav">
            <li><a href="<?php bloginfo('url'); ?>">accueil</a></li>
            <li class="dropdown">
                <a class="dropdownEvenement" data-toggle="dropdown">événement</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php bloginfo('url'); ?>/programme">programme</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/galerie">galerie</a></li>
                </ul>
            </li>
            <li><a href="<?php bloginfo('url'); ?>/participer">participer</a></li>
            <li><a href="<?php bloginfo('url'); ?>/benevoles">bénévoles</a></li>
            <li><a href="<?php bloginfo('url'); ?>/news">news</a></li>
            <li><a href="<?php bloginfo('url'); ?>/forum">forum</a></li>
            <?php $lienCompte2 = get_bloginfo('url').'/contact' ?>
            <li><span class="loutreCannibale" data-loutre="<?= base64_encode($lienCompte2) ?>">contact</span></li>
        </ul>
    </nav>
</div>
<div class="row d-lg-none menuResponsiveHeight">
    <?= $divMenuResponsive ?>
        <div class="row topResp">
            <div class="col-10">
                <?php echo $enteteMenuResponsive; ?>
            </div>
        </div>
        <div class="row midResp justify-content-between">
                <div class="elementsMenuResp d-flex flex-column justify-content-between">
                    <div><a href="<?php bloginfo('url'); ?>">accueil</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/programme">programme</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/galerie">galerie</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/participer">participer</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/benevoles">bénévoles</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/news">news</a></div>
                    <div><a href="<?php bloginfo('url'); ?>/forum">forum</a></div>
                    <?php $lienCompte2 = get_bloginfo('url').'/contact' ?>
                    <div><span class="loutreCannibale" data-loutre="<?= base64_encode($lienCompte2) ?>">contact</span></div>
                </div>
                <div class="col-12 blocMenuRespDeco d-flex align-items-end align-self-end">
                    <div class="row d-flex flex-row justify-content-between">   
                        <div>
                            <?php 
                                if (is_user_logged_in()) {
                                    echo '<a href="'.get_bloginfo('url').'/mon-compte/">Mon compte</a>';
                                }
                                else {
                                    echo $lienLoginOutInscription;
                                }
                            ?>
                        </div>
                        <div>
                            <?php echo $lienLoginOut; ?>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row bottomResp">
            <div class="col-12 blocCroixMenuResp">
                <div class="croixMenuResponsive" onclick="menuResponsive2()"><i class="fas fa-times"></i></div>
            </div>
        </div>
    </div>
</div>