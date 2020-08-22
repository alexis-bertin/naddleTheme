<?php
	global $lienLoginOut;
	global $lienLoginOutInscription;

	$lienLoginOut='';
	$lienLoginOutInscription='';

	if (!is_user_logged_in()) {
		$lienLoginOut='<a href="'.get_bloginfo("url").'/?login=connect">Connexion</a>';
		$lienLoginOutInscription='<a href="'.get_bloginfo("url").'/?login=register">Inscription</a>';
	}
	else {
		$lienLoginOut='<a href="'.esc_url(wp_logout_url()). '">Déconnexion</a>';
	}

	$modal_content_loginform='
		<form name="loginform" id="loginform" action="'.get_bloginfo("url").'/wp-login.php" method="post">
			<p class="inputTextConnexion">
				<label for="user_login">Nom d’utilisateur ou adresse e-mail<br>
				</label><input type="text" name="log" id="user_login" class="input" value="" size="20">
			</p>
			<p class="inputTextConnexion">
				<label for="user_pass">Mot de passe<br>
				</label><input type="password" name="pwd" id="user_pass" class="input" value="" size="20">
			</p>
			<p class="forgetmenot"><input name="rememberme" class="styled-checkbox" type="checkbox" id="rememberme" value="forever"><label for="rememberme"> Se souvenir de moi</label></p>
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Se connecter">
				<input type="hidden" name="redirect_to" value="'.get_bloginfo("url").'/wp-admin/">
				<input type="hidden" name="testcookie" value="1">
			</p>
		</form>
		<p id="nav">
			<a href="'.get_bloginfo("url").'/wp-login.php?action=lostpassword">Mot de passe oublié&nbsp;?</a>
		</p>
		<p id="messageLogin" class="messageLogin"></p>
		<script>
			/**************ATTENTE CHARGEMENT DOCUMENT***********/
			$(document).ready(function() {
			/*****************************************************/			
	
		 	$("#wp-submit").on("click",function(){
				if($("#user_login").val()=="" || $("#user_pass").val()==""){
					$("#messageLogin").html("Vous devez saisir les 2 valeurs.");
					return false;
				}					
		 	});


		 	/*****************************************************/	
			});
			/*****************************************************/	

		</script>
	';

	$modal_content_lostpasswordform='
		<h3>Mot de passe oublié</h3>					
		<p class="message">Veuillez saisir votre identifiant ou votre adresse mail. Un lien permettant de créer un nouveau mot de passe vous sera envoyé par e-mail.</p>
		<form name="lostpasswordform" id="lostpasswordform" action="'.get_bloginfo("url").'/wp-login.php?action=lostpassword" method="post">
			<p class="inputTextInscription">
				<label for="user_login">Nom d’utilisateur ou adresse e-mail<br>
				</label><input type="text" name="user_login" id="user_login" class="input" value="" size="20">
			</p>
				<input type="hidden" name="redirect_to" value="'.get_bloginfo("url").'/?login=reset">
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button submitMdpOublie" value="Générer un mot de passe"></p>
		</form>		
		
	';


	$modal_content_login_registerform='
		<p class="message register">S’inscrire</p>
		<form name="registerform" id="registerform" action="'.get_bloginfo("url").'/wp-login.php?action=register" method="post" novalidate>
		<div class="form-group">
			<p class="inputTextInscription">
				<label for="user_login">Identifiant<br>
				</label><input type="text" name="user_login" id="user_login" class="input  form-control" value="" size="20">
			</p>
			<p class="inputTextInscription">
				<label for="user_email">Adresse mail<br>
				</label><input type="email"  name="user_email" id="user_email" class="input form-control" value="" size="25">
			</p>
			<p id="reg_passmail">La confirmation d’inscription vous sera envoyée par e-mail.</p>
			<br class="clear">
			<input type="hidden" name="redirect_to" value="'.get_bloginfo("url").'/?login=registerOK">
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button" value="Inscription"></p>
			<p id="messageLogin" class="messageLogin"></p>
		</div>
		</form>
		<script>
			/**************ATTENTE CHARGEMENT DOCUMENT***********/
			$(document).ready(function() {
			/*****************************************************/			
		 	
		 	$("#wp-submit").on("click",function(){
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if( !regex.test($("#user_email").val())) {
					$("#messageLogin").html("Adresse mail non valide.");
					return false;
				}

				if( $("#user_login").val()=="") {
					$("#messageLogin").html("Veuillez saisir un identifiant.");
					return false;
				}
					
		 	});


		 	/*****************************************************/	
			});
			/*****************************************************/	
		</script>

	';


	$modal_content_login_error='
		<div id="login_error" class="login_error">	
			<strong>Erreur</strong>
			&nbsp;: Vos données de connexion sont incorrectes. 
			<a href="'.get_bloginfo("url").'/wp-login.php?action=lostpassword">Mot de passe oublié ?</a><br>
		</div>
	';

	$modal_content_login_reset='
		<p class="message">Vérifiez votre messagerie pour y trouver le lien de confirmation.<br></p>
	';

	$modal_content_login_register_msg='
		<p class="message">Inscription terminée. Veuillez consulter votre boite mail.</p>
	';

	$script_open_modal='
		 <script>
		 	/**************ATTENTE CHARGEMENT DOCUMENT***********/
			$(document).ready(function() {
			/*****************************************************/		

		 		$("#modal-id").modal();

		 	/*****************************************************/	
			});
			/*****************************************************/	
		 </script>
	';

	$login=isset($_GET["login"])?$_GET["login"]:'';
	$modal_content='';
	if($login=='connect')		$modal_content=$modal_content_loginform;
	if($login=='lost')			$modal_content=$modal_content_lostpasswordform;
	if($login=='reset')			$modal_content=$modal_content_login_reset.'<br> '. $modal_content_loginform;
	if($login=='fail')			$modal_content=$modal_content_login_error.'<br>'.$modal_content_loginform;
	if($login=='register')		$modal_content=$modal_content_login_registerform;
	if($login=='registerOK')	$modal_content=$modal_content_login_register_msg.' '.$modal_content_loginform;
	if($login!='') 				$modal_content.=' '.$script_open_modal;
?>
	
<div class="modal modalConnexionDeco" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content mo-login-modal">
			<div class="modal-header">
				<div class="modal-title"></div>
				<button type="button" class="ferme" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?=$modal_content ?>		
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button> -->
			</div>
		</div>
	</div>
</div>


