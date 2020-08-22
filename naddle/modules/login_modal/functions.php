<?php

	////////////////////////////////AJOUT FONCTIONNALITE LOGIN MODAL/////////////////////////////////////

	/***REDIRIGE VERS LA PAGE HOME LORS DE L'ECHEC DU LOGIN AVEC /?login=failed   **/
	add_action( 'wp_login_failed', 'my_login_fail' );  // hook failed login
	function my_login_fail( $username ) {
	    wp_redirect(home_url() . '/?login=fail' );  
	    exit;
	}

	/***REDIRIGE VERS LA PAGE HOME LORS DE L'OUBLI DU PASSWORD AVEC /?login=lost   **/
	add_action( 'lost_password', 'my_lost_password');
	function my_lost_password() {
	    wp_redirect(home_url() . '/?login=lost' );  
	    exit;
	}


?>