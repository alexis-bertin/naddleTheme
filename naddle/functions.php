<?php

    add_theme_support( 'title-tag' );
    
    //AJOUT SCRIPTS POUR AJAX
    function add_js_scripts() {
        wp_enqueue_script( 'script', get_template_directory_uri().'/js/scripts.js', array('jquery'), '1.0', true );
        wp_localize_script( 'script', 'ajaxurl', array( 'ajax_url' => admin_url('admin-ajax.php')) );
    }
    add_action('wp_enqueue_scripts', 'add_js_scripts');

    //Désactiver l'éditeur par défaut Gutembergh
    add_filter('use_block_editor_for_post', '__return_false');

    //Cacher la barre d'administration
    add_filter("show_admin_bar","cache_bar_admin");
    function cache_bar_admin(){
        return false;
    }

    //Lors du login ou du logout revenir à la page home
    add_filter("wp_login","redirige_home");
    add_filter("wp_logout","redirige_home");
    function redirige_home(){
        wp_redirect(home_url());
        exit;
    }

    /* Bloquer accès aux non-admins */
    function wpc_block_dashboard() {
        $file = basename($_SERVER['PHP_SELF']);
        if (is_user_logged_in() && is_admin() && !current_user_can('edit_posts') && $file != 'admin-ajax.php') {
            wp_redirect( home_url() );
            exit();
        }
    }
    add_action('init', 'wpc_block_dashboard');

    //MODIFIER INFOS OBLIGATOIRES COMPTE 
    function modifierInfosObligatoires() {
        wp_update_user(
            array(
                'ID' => $_POST['user_id'],
                'last_name' => $_POST['user_nom'],
                'first_name' => $_POST['user_prenom']
            ) 
        ); 
        update_user_meta($_POST['user_id'], 'wpcf-telephone-user', $_POST['user_tel']);
        update_user_meta($_POST['user_id'], 'wpcf-adresse-ville', $_POST['user_ville']);
        update_user_meta($_POST['user_id'], 'wpcf-adresse-cp', $_POST['user_cp']);
        update_user_meta($_POST['user_id'], 'wpcf-adresse-rue', $_POST['user_rue']);
    }

    //AJOUT COLONNE BACK OFFICE 
    function ajoutColonneAuteurSujet($columns) {
        return array_merge($columns, 
        array('auteurSujet' => __('Auteur')));
    }
    add_filter('manage_sujet_posts_columns' , 'ajoutColonneAuteurSujet');
    function ajoutColonneAvant($columns) {
        return array_merge($columns, 
        array('newsAvant' => __('Mise en avant')));
    }
    add_filter('manage_actualite_posts_columns' , 'ajoutColonneAvant');

    add_action('manage_posts_custom_column', 'dataColonneAvant');
    function dataColonneAvant($name) {
        global $post;
        switch ($name) {
            case 'newsAvant' :
                if(get_post_meta($post->ID, 'wpcf-mettre-en-avant', true) == 1) {
                    echo 'Oui';
                } 
                else {
                    echo 'Non';
                }
                break;
            case 'auteurSujet' :
                the_author();
                break;
        }
    } 

    // TRAITEMENT DU FORMULAIRE DE CHANGEMENT D'INFOS DU COMPTE
    function traitement_formulaire_compte() {
        if (isset($_POST['modifier-infos-compte']) && isset($_POST['changement-compte-verif'])) {
            if (wp_verify_nonce($_POST['changement-compte-verif'], 'changer-infos')) {
                if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
                if (empty($_POST['user_prenom']) || empty($_POST['user_nom']) || empty($_POST['user_tel']) || empty($_POST['user_ville']) || empty($_POST['user_cp']) || empty($_POST['user_rue']))  {
                    $url = add_query_arg('cestunescroc', 'oui', wp_get_referer());
                    wp_safe_redirect($url);
                    exit();
                }
                else {
                    $url = wp_get_referer();
                    $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'erreur-champ', 'modifie'), $url);
                    $nbErr = 0;
                    if (!empty($_POST['user_prenom']) && strlen($_POST['user_prenom']) <= 20 && preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $_POST['user_prenom'])) {
                        //OK
                    }
                    else {
                        //PRENOM MAUVAIS
                        $nbErr += 1;
                        $erreurPrenom = TRUE;
                    }
                    if (!empty($_POST['user_nom']) && strlen($_POST['user_nom']) <= 20 && preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $_POST['user_nom'])) {
                        //OK
                    }
                    else {
                        //NOM MAUVAIS
                        $nbErr += 1;
                        $erreurNom = TRUE;
                    }
                    if (!empty($_POST['user_tel']) && preg_match("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", $_POST['user_tel'])) {
                        //OK
                    }
                    else {
                        //TELEPHONE MAUVAIS
                        $nbErr += 1;
                        $erreurTel = TRUE;
                    }
                    if (!empty($_POST['user_ville']) && strlen($_POST['user_ville']) <= 30 && preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $_POST['user_ville'])) {
                        //OK
                    }
                    else {
                        //VILLE MAUVAIS
                        $nbErr += 1;
                        $erreurVille = TRUE;
                    }
                    if (!empty($_POST['user_cp']) && strlen($_POST['user_cp']) <= 30 && preg_match("/^[0-9]{5,5}$/", $_POST['user_cp'])) {
                        //OK
                    }
                    else {
                        //CODE POSTAL MAUVAIS
                        $nbErr += 1;
                        $erreurCp = TRUE;
                    }
                    if (!empty($_POST['user_rue']) && strlen($_POST['user_rue']) <= 50) {
                        //OK
                    }
                    else {
                        //RUE MAUVAIS
                        $nbErr += 1;
                        $erreurRue = TRUE;
                    }
                    //SI LES CHAMPS DESC ET IMAGE SONT VIDES
                    if (empty($_POST['user_desc']) && empty($_FILES['user_pdp'])) {
                        if($nbErr == 0) {
                            modifierInfosObligatoires();
                            $url = add_query_arg('modifie', 'oui', wp_get_referer());
                            $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'erreur-champ', 'retourValeurs', 'nbErreurs', 'retourPrenom', 'retourNom', 'retourTel', 'retourRue', 'retourCp', 'retourVille'), $url);
                            wp_safe_redirect($url);
                            exit(); 
                        }
                        else {
                            $url = add_query_arg('retourValeurs', 'yep', $url);
                            $url = add_query_arg('nbErreurs', $nbErr, $url);
                            $url = add_query_arg('retourPrenom', $_POST['user_prenom'], $url);
                            $url = add_query_arg('retourNom', $_POST['user_nom'], $url);
                            $url = add_query_arg('retourTel', $_POST['user_tel'], $url);
                            $url = add_query_arg('retourRue', $_POST['user_rue'], $url);
                            $url = add_query_arg('retourCp', $_POST['user_cp'], $url);
                            $url = add_query_arg('retourVille', $_POST['user_ville'], $url);
                            $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'modifie'), $url);
                            if($erreurPrenom) { $valErreurChamp = 'prenom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurNom) { $valErreurChamp = 'nom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurTel) { $valErreurChamp = 'tel'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurVille) { $valErreurChamp = 'ville'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurCp) { $valErreurChamp = 'cp'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurRue) { $valErreurChamp = 'rue'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                        }
                    }
                    else {
                        if (strlen($_POST['user_desc']) > 500) {
                            //DESCRIPTION MAUVAIS
                            $nbErr += 1;
                            $erreurDesc = TRUE;
                        }
                        //SI LE CHAMP IMAGE EST BIEN REMPLI
                        if ($_FILES['user_pdp']['size'] < 1000000 && $_FILES['user_pdp']['size'] > 0) {
                            $uploadedfile = $_FILES['user_pdp'];
                            $upload_overrides = array( 'test_form' => false );
                            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                                if ( $movefile ) {
                                    $wp_filetype = $movefile['type'];
                                    $filename = $movefile['file'];
                                    $wp_upload_dir = wp_upload_dir();
                                    $attachment = array(
                                        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                                        'post_mime_type' => $wp_filetype,
                                        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                        'post_content' => '',
                                        'post_status' => 'inherit'
                                    );
                                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                                    $attach_id = wp_insert_attachment( $attachment, $filename, $insertPost);
                                    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                                    wp_update_attachment_metadata( $attach_id, $attach_data );
                                    wp_delete_attachment(attachment_url_to_postid($_POST['user_linkPdp']));
                                    update_user_meta($_POST['user_id'], 'wpcf-image-de-profil', $wp_upload_dir['url'] . '/' . basename($filename));
                                }
                                modifierInfosObligatoires();
                                wp_update_user(
                                    array(
                                        'ID' => $_POST['user_id'],
                                        'description' => $_POST['user_desc']
                                    ) 
                                ); 
                            $url = add_query_arg('modifie', 'oui', wp_get_referer());
                            $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'erreur-champ', 'retourValeurs', 'nbErreurs', 'retourPrenom', 'retourNom', 'retourTel', 'retourRue', 'retourCp', 'retourVille'), $url);
                            wp_safe_redirect($url);
                            exit(); 
                        }
                        //SI LE CHAMP IMAGE EST VIDE ET QUIL N Y A PAS D ERREUR
                        elseif($_FILES['user_pdp']['size'] == 0 && $_FILES['user_pdp']['error'] != 1) {
                            if($nbErr == 0) {
                                modifierInfosObligatoires();
                                wp_update_user(
                                        array(
                                            'ID' => $_POST['user_id'],
                                            'description' => $_POST['user_desc']
                                        ) 
                                    ); 
                                $url = add_query_arg('modifie', 'oui', wp_get_referer());
                                $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'erreur-champ', 'retourValeurs', 'nbErreurs', 'retourPrenom', 'retourNom', 'retourTel', 'retourRue', 'retourCp', 'retourVille'), $url);
                                wp_safe_redirect($url);
                                exit(); 
                            }
                            else {
                                $url = add_query_arg('QUOI', $_FILE['user_pdp']['error'], $url);
                                $url = add_query_arg('retourValeurs', 'yep', $url);
                                $url = add_query_arg('nbErreurs', $nbErr, $url);
                                $url = add_query_arg('retourPrenom', $_POST['user_prenom'], $url);
                                $url = add_query_arg('retourNom', $_POST['user_nom'], $url);
                                $url = add_query_arg('retourTel', $_POST['user_tel'], $url);
                                $url = add_query_arg('retourRue', $_POST['user_rue'], $url);
                                $url = add_query_arg('retourCp', $_POST['user_cp'], $url);
                                $url = add_query_arg('retourVille', $_POST['user_ville'], $url);
                                $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'modifie'), $url);

                                if($erreurPrenom) { $valErreurChamp = 'prenom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurNom) { $valErreurChamp = 'nom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurTel) { $valErreurChamp = 'tel'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurVille) { $valErreurChamp = 'ville'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurCp) { $valErreurChamp = 'cp'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurRue) { $valErreurChamp = 'rue'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                                if($erreurDesc) { $valErreurChamp = 'desc'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            }
                        }
                        else {
                            //FICHIER TROP GROS
                            $nbErr += 1;
                            $erreurFichier = TRUE;
                            $url = add_query_arg('QUOI', $_FILE['user_pdp']['error'], $url);
                            $url = add_query_arg('retourValeurs', 'yep', $url);
                            $url = add_query_arg('nbErreurs', $nbErr, $url);
                            $url = add_query_arg('retourPrenom', $_POST['user_prenom'], $url);
                            $url = add_query_arg('retourNom', $_POST['user_nom'], $url);
                            $url = add_query_arg('retourTel', $_POST['user_tel'], $url);
                            $url = add_query_arg('retourRue', $_POST['user_rue'], $url);
                            $url = add_query_arg('retourCp', $_POST['user_cp'], $url);
                            $url = add_query_arg('retourVille', $_POST['user_ville'], $url);
                            $url = remove_query_arg(array('mdpReinitialise', 'cestunescroc', 'modifie'), $url);

                            if($erreurPrenom) { $valErreurChamp = 'prenom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurNom) { $valErreurChamp = 'nom'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurTel) { $valErreurChamp = 'tel'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurVille) { $valErreurChamp = 'ville'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurCp) { $valErreurChamp = 'cp'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurRue) { $valErreurChamp = 'rue'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurDesc) { $valErreurChamp = 'desc'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                            if($erreurFichier) { $valErreurChamp = 'file'; $url = add_query_arg('erreur-champ', $valErreurChamp, $url); wp_safe_redirect($url); exit(); }
                        }
                    }
                }
            }
        }
    }
    add_action('template_redirect', 'traitement_formulaire_compte');

    /***CHARGEMENT DU FICHIER PHP QUI CONTIENT LES FONCTIONS DE LOGIN_MODAL***/
    require_once(ABSPATH.'wp-content/themes/'.wp_get_theme().'/modules/login_modal/functions.php');

    //AMELIORE LA PRESENTATION DE LA FONCTION var_dump($_posts)///
    function vardump($input, $collapse=false) {
        $recursive = function($data, $level=0) use (&$recursive, $collapse) {
            global $argv;
            $isTerminal = isset($argv);
            if (!$isTerminal && $level == 0 && !defined("DUMP_DEBUG_SCRIPT")) {
                define("DUMP_DEBUG_SCRIPT", true);
                echo '<script language="Javascript">function toggleDisplay(id) {';
                echo 'var state = document.getElementById("container"+id).style.display;';
                echo 'document.getElementById("container"+id).style.display = state == "inline" ? "none" : "inline";';
                echo 'document.getElementById("plus"+id).style.display = state == "inline" ? "inline" : "none";';
                echo '}</script>'."\n";
            }
            $type = !is_string($data) && is_callable($data) ? "Callable" : ucfirst(gettype($data));
            $type_data = null;
            $type_color = null;
            $type_length = null;
            switch ($type) {
                case "String": 
                    $type_color = "green";
                    $type_length = strlen($data);
                    $type_data = "\"" . htmlentities($data) . "\""; break;
                case "Double": 
                case "Float": 
                    $type = "Float";
                    $type_color = "#0099c5";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;
                case "Integer": 
                    $type_color = "red";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;
                case "Boolean": 
                    $type_color = "#92008d";
                    $type_length = strlen($data);
                    $type_data = $data ? "TRUE" : "FALSE"; break;
                case "NULL": 
                    $type_length = 0; break;
                case "Array": 
                    $type_length = count($data);
            }
            if (in_array($type, array("Object", "Array"))) {
                $notEmpty = false;
                foreach($data as $key => $value) {
                    if (!$notEmpty) {
                        $notEmpty = true;
                        if ($isTerminal) {
                            echo $type . ($type_length !== null ? "(" . $type_length . ")" : "")."\n";
                        } else {
                            $id = substr(md5(rand().":".$key.":".$level), 0, 8);
                            echo "<a href=\"javascript:toggleDisplay('". $id ."');\" style=\"text-decoration:none\">";
                            echo "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>";
                            echo "</a>";
                            echo "<span id=\"plus". $id ."\" style=\"display: " . ($collapse ? "inline" : "none") . ";\">&nbsp;&#10549;</span>";
                            echo "<div id=\"container". $id ."\" style=\"display: " . ($collapse ? "" : "inline") . ";\">";
                            echo "<br />";
                        }
                        for ($i=0; $i <= $level; $i++) {
                            echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        echo $isTerminal ? "\n" : "<br />";
                    }
                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    echo $isTerminal ? "[" . $key . "] => " : "<span style='color:black'>[" . $key . "]&nbsp;=>&nbsp;</span>";
                    call_user_func($recursive, $value, $level+1);
                }
                if ($notEmpty) {
                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    if (!$isTerminal) {
                        echo "</div>";
                    }
                } else {
                    echo $isTerminal ? 
                            $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " : 
                            "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";
                }
            } else {
                echo $isTerminal ? 
                        $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " : 
                        "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";
                if ($type_data != null) {
                    echo $isTerminal ? $type_data : "<span style='color:" . $type_color . "'>" . $type_data . "</span>";
                }
            }
            echo $isTerminal ? "\n" : "<br />";
        };
        call_user_func($recursive, $input);
    }


// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {
	
	function wpex_pagination() {
		
		$prev_arrow = is_rtl() ? '<i class="fas fa-arrow-right"></i>' : '<i class="fas fa-arrow-left"></i>';
        $next_arrow = is_rtl() ? '<i class="fas fa-arrow-left"></i>' : '<i class="fas fa-arrow-right"></i>';
        $args=array(
            'post_type' => 'actualite',
            'meta_key' => 'wpcf-mettre-en-avant',
            'meta_compare' => '!=',
            'meta_value' => 1
        );  
        global $wp_query, $wpex_query;
        $wpex_query = new WP_Query( $args );
        if ( $wpex_query ) {
            $total = $wpex_query->max_num_pages;
        } else {
            $total = $wp_query->max_num_pages;
        }
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 1,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}	
}
// Numbered Pagination
if ( !function_exists( 'wpex_pagination_sujets' ) ) {
	
	function wpex_pagination_sujets() {
		
		$prev_arrow = is_rtl() ? '<i class="fas fa-arrow-right"></i>' : '<i class="fas fa-arrow-left"></i>';
        $next_arrow = is_rtl() ? '<i class="fas fa-arrow-left"></i>' : '<i class="fas fa-arrow-right"></i>';
        $args=array(
            'post_type' => 'sujet'
        );  
        global $wp_query, $wpex_query;
        $wpex_query = new WP_Query( $args );
        if ( $wpex_query ) {
            $total = $wpex_query->max_num_pages;
        } else {
            $total = $wp_query->max_num_pages;
        }
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 1,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}	
}
// Numbered Pagination
if ( !function_exists( 'wpex_pagination_annonces' ) ) {
	
	function wpex_pagination_annonces() {
		
		$prev_arrow = is_rtl() ? '<i class="fas fa-arrow-right"></i>' : '<i class="fas fa-arrow-left"></i>';
        $next_arrow = is_rtl() ? '<i class="fas fa-arrow-left"></i>' : '<i class="fas fa-arrow-right"></i>';
        $args=array(
            'post_type' => 'annonce'
        );  
        global $wp_query, $wpex_query;
        $wpex_query = new WP_Query( $args );
        if ( $wpex_query ) {
            $total = $wpex_query->max_num_pages;
        } else {
            $total = $wp_query->max_num_pages;
        }
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 1,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}	
}

//Renvoie sous forme de case à cocher  (checkbox) 
//la liste des terms d'une taxo -> $taxonomy
//pour un post donné -> $postID
//avec les terms du post cochés (ici cases à cocher donc plusieurs choix possibles)
//Avec possibilité de donner un nom de classe
//exemple d'utilisation  -> $taxonomie=get_check_terms_taxo_post( get_the_ID(),'genre','form-control');

function get_check_terms_taxo_post($postID,$taxonomy,$classe=''){
    
	//Récupération des  terms de la taxo niveau auxquels appartient le post
    $terms=get_the_terms($postID,$taxonomy); //Si il n'y aucun term la fonction renvoie 0 (false)   

    //Création d'un tableau indicé qui contient les id des terms si il y a au moins un term
    $tabterm=array();
    if($terms){
        foreach ($terms as $term) {
            $tabterm[]=$term->term_id;
        }
    }

    //vardump($tabterm);
	
    //Création des cases à cocher indiquant les terms
    $taxonomie='';
    $terms=get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ) );
    foreach($terms as $term){
        $checked="";
        if(in_array($term->term_id , $tabterm) ) $checked="checked";
        $taxonomie .= '<input '.$checked.' type="checkbox"  class="'.$classe.' styled-checkbox" id="'.$term->slug.'" name="'.$term->taxonomy.'[]" value="'.$term->term_id.'"><label  for="'.$term->slug.'">'.$term->name.'</label>&nbsp;&nbsp;&nbsp;&nbsp;';     
    }
    return $taxonomie;	
}

 ///////////////EXEMPLE DE FONCTION UTILSANT UNE REQUETE SQL SELECT////////////////
//Renvoie un tableau d'objets de type post correspondant
//à la liste des terms d'une taxo d'un post donné
//chaque objet contient : le post_ID,la taxo, le name et le slug du term
//exemple d'utilisation dans librairie -> $terms=getTermTaxo( get_the_id(),'genre');
function getTermTaxo($post_id,$taxo){

    global $wpdb;

    $requete= $wpdb->prepare("  
        SELECT {$wpdb->prefix}posts.ID,
        {$wpdb->prefix}term_taxonomy.taxonomy,
        {$wpdb->prefix}terms.name,
        {$wpdb->prefix}terms.slug
    FROM (({$wpdb->prefix}term_relationships 
        INNER JOIN {$wpdb->prefix}term_taxonomy
        ON ({$wpdb->prefix}term_relationships.term_taxonomy_id =
            {$wpdb->prefix}term_taxonomy.term_taxonomy_id))
    INNER JOIN {$wpdb->prefix}posts
        ON ({$wpdb->prefix}term_relationships.object_id = {$wpdb->prefix}posts.ID))
    INNER JOIN {$wpdb->prefix}terms
        ON ({$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id)
    WHERE ({$wpdb->prefix}posts.ID = %d) AND ({$wpdb->prefix}term_taxonomy.taxonomy = '%s')
    ",$post_id,$taxo);

    $resultats=$wpdb->get_results($requete);

	return $resultats;
}

/////////////////////////////////////////////////////////////////////
////////////////////////FONCTIONS META JSON//////////////////////////
/////////////////////////////////////////////////////////////////////

//FONCTION QUI INSERT UN TABLEAU PHP DANS UN POST META
//EN LE STOCKANT SOUS FORME D'UN TABLEAU JSON
function update_post_meta_json($id,$meta,$tablo){

    $json = json_encode($tablo,JSON_UNESCAPED_UNICODE);

    update_post_meta($id,$meta,$json);

}

//FONCTION QUI RECUPERE UN TABLEAU PHP A PARTIR D'UN POST META
//QUI SOCKAIT LES DONNEES SOUS FORME D'UN TABLEAU JSON
function get_post_meta_json($id,$meta){

    $wpcf=get_post_meta($id,$meta,true);
 
    $tablo=array();
    if($wpcf!="") {
        $tablo=json_decode($wpcf);
    }
    return $tablo;

}

//FONCTION QUI INSERT UN TABLEAU PHP DANS UN USER META
//EN LE STOCKANT SOUS FORME D'UN TABLEAU JSON
function update_user_meta_json($id,$meta,$tablo){

    $json = json_encode($tablo,JSON_UNESCAPED_UNICODE);

    update_user_meta($id,$meta,$json);

}

//FONCTION QUI RECUPERE UN TABLEAU PHP A PARTIR D'UN USER META
//QUI SOCKAIT LES DONNEES SOUS FORME D'UN TABLEAU JSON
function get_user_meta_json($id,$meta){

    $wpcf=get_user_meta($id,$meta,true);
 
    $tablo=array();
    if($wpcf!=""){
        $tablo=json_decode($wpcf);
    }

    return $tablo;
}


function ajouterUnJaime() {
    $userID = $_POST['userID'];
    $postID = $_POST['postID'];
    $nbLikes = get_post_meta($postID, 'nb_likers', true);
    $likers = get_post_meta_json($postID, 'likers');
    if (!in_array($userID, $likers)) {
        $likers[] = $userID;
        update_post_meta_json($postID, 'likers', $likers); 
        $nbLikes = $nbLikes + 1;
        update_post_meta($postID, 'nb_likers', $nbLikes); 
        $results['success'] = true;
        echo json_encode($results);
        exit;
    }
    else {
        for ($i=0; $i < count($likers); $i++) {
            $currentTab = $likers[$i];
            if ($currentTab == strval($userID)) {
                array_splice($likers, $i, 1);
            }
        }
        update_post_meta_json($postID, 'likers', $likers); 
        $nbLikes = $nbLikes - 1;
        update_post_meta($postID, 'nb_likers', $nbLikes); 
        echo json_encode ( $results );
        exit;
    }
}
add_action ( 'wp_ajax_' . 'ajoutLikePost', 'ajouterUnJaime');
add_action ( 'wp_ajax_nopriv_' . 'ajoutLikePost', 'ajouterUnJaime');

function filtrerLesCategories() {
    $filtreCat = explode( ',', $_POST['filtreCat']);
    $filtreLike = $_POST['filtreLike'];
    if ($filtreLike) {
        $args=array(
            'post_type' => 'sujet'
        );
    }
    elseif (!empty(array_filter($filtreCat))) {
        $args=array(
            'post_type' => 'sujet',
            'meta_key'			=> 'nb_likers',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC',
            'tax_query' => array(
                array(  'taxonomy' => 'categorie',
                        'field' => 'term_id',
                        'terms' => $filtreCat,
                ),
            ),
        );
        $results['filtrage'] = 'yes';
    }
    else {
        $args=array(
            'post_type' => 'sujet',
            'posts_per_page' => 9,
            'paged' => $paged
        );
    }
    $sujetsFiltres = new WP_Query($args);
    if ($filtreLike) {
        $ohlala = 0;
        while($sujetsFiltres->have_posts()) {
            $sujetsFiltres->the_post();
            $nbLikers = get_post_meta(get_the_ID(), 'nb_likers', true);
            $tabTerms = getTermTaxo(get_the_ID(), 'categorie');
            if(!empty($tabTerms)) {
                $termesSujet = '<div class="termesSujet">';
                foreach($tabTerms as $term) {
                    $termesSujet .= '<div class="termeSujet">'.$term->name.'</div>';
                }
                $termesSujet .= '</div>';
            }
            if ((get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)) == (get_bloginfo('template_url').'/images/avatar.png')) {
                $lienImageAuteurTaVu = get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true);
            }
            else {
                $lienImageAuteurTaVu = wp_get_attachment_image_src(attachment_url_to_postid(get_user_meta(get_the_author_meta('ID'), 'wpcf-image-de-profil', true)), 'thumbnail');
                $lienImageAuteurTaVu = $lienImageAuteurTaVu[0];
            }
            $likers = get_post_meta_json(get_the_ID(), 'likers');
            if (in_array($filtreLike, $likers)) {
                if($ohlala == 0) {
                    $affichage .= '<div class="lesPlusRecents"><h2>Mes derniers likes</h2></div>';
                }
                $ohlala += 1;
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
        }
        if($ohlala == 0) {
            $affichage .= '<div class="noPosts">Vous n\'avez aimé aucun sujet.</div>';
        }
        $results['html'] = $affichage;
        echo json_encode ( $results );
        exit;
    }
    else {
        if($sujetsFiltres->have_posts()) {
            $affichage .= '<div class="lesPlusRecents"><h2>Les plus récents</h2></div>';
        }
        else {
            $affichage .= '<div class="noPosts">Il n\'y a aucun sujet correspondant.</div>';
        }
        while($sujetsFiltres->have_posts()) {
            $sujetsFiltres->the_post();
            $nbLikers = get_post_meta(get_the_ID(), 'nb_likers', true);
            $tabTerms = getTermTaxo(get_the_ID(), 'categorie');
            if(!empty($tabTerms)) {
                $termesSujet = '<div class="termesSujet">';
                foreach($tabTerms as $term) {
                    $termesSujet .= '<div class="termeSujet">'.$term->name.'</div>';
                }
                $termesSujet .= '</div>';
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
        $results['html'] = $affichage;
        echo json_encode ( $results );
        exit;
    }
}
add_action ( 'wp_ajax_' . 'filtreSujets', 'filtrerLesCategories');
add_action ( 'wp_ajax_nopriv_' . 'filtreSujets', 'filtrerLesCategories');


//BALISES CANONIQUES AUTO
function any_head_canonical( $output = '' ){
    if( is_home() ){ $output = home_url( '/' ); }
    if( is_category() ){ global $cat; $output = get_category_link($cat); }
    if( is_tag() ){ global $tag_id; $output = get_tag_link($tag_id); }
    if( is_page() ){ global $page_id; $output = get_page_link($page_id); }
    if( is_single() ){ $output = get_permalink(); }
    if( $output != '' ){ echo '<link rel="canonical" href="',$output,'">'; }
}
add_action('wp_head', 'any_head_canonical');

//AJOUT DEFINIR BENEVOLE USER
function ajout_benevole( $actions, $user ) {
    $actions['new_action'] = "<a class='new_action' href='" . admin_url( "users.php?&action=nouveauBenevole&amp;user=$user->ID") . "'>" . esc_html__('Définir comme bénévole', 'ajout_benevole_user') . "</a>";
    return $actions;
}
add_filter('user_row_actions', 'ajout_benevole', 10, 2);

function ajout_benevole_user_new_action_notice() {
    if($_GET['action'] == "nouveauBenevole") {
        update_user_meta($_GET['user'], 'wpcf-statut', 'Bénévole');
        echo '<div class="updated">
            <p>'.esc_html_e( 'L\'internaute a bien été défini comme bénévole', 'ajout_benevole_user' ).'</p>
        </div>';
    }
}
add_action( 'admin_notices', 'ajout_benevole_user_new_action_notice' );


add_filter('manage_users_columns' , 'ajoutColonneBenevole');
function ajoutColonneBenevole($columns) {
    $columns['statut'] = 'Statut';
    return $columns;
}

add_action('manage_users_custom_column', 'dataColonneBenevole', 10, 3);
function dataColonneBenevole($name, $column_name, $user_id) {
    $statut = get_user_meta($user_id, 'wpcf-statut', true);
	if ( 'statut' == $column_name )
		return $statut;
    return $value;
} 

add_filter('manage_users_columns', 'pippin_add_user_id_column');
function pippin_add_user_id_column($columns) {
    $columns['user_id'] = 'ID';
    return $columns;
} 
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
function pippin_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
	if ( 'user_id' == $column_name )
		return $user_id;
    return $value;
}

?>