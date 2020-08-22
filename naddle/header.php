<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="<?php bloginfo("charset"); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url');?>/images/favicon/favicon.ico">
		<link rel="icon" type="image/ico" href="<?php bloginfo('template_url');?>/images/favicon/favicon.ico?v=2" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url');?>/images/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url');?>/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url');?>/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php bloginfo('template_url');?>/images/favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php bloginfo('template_url');?>/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="<?php bloginfo('template_url');?>/js/jquery-ui-1.12.1/jquery-ui.min.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url');?>/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url');?>/styles/bootstrap.min.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url');?>/styles/style.css?id=1">
		<script src="<?php bloginfo('template_url');?>/js/jquery-3.4.1.min.js"></script>	
		<script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-156500338-1');
		</script>
		<?php wp_head(); ?>
		<style>
			/* IMPORT FONTS */
			@font-face {
				font-family: "Roboto";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Roboto/Roboto-Regular.ttf')  format('truetype');
			}
			@font-face {
				font-family: "Roboto_Condensed";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Roboto_Condensed/RobotoCondensed-Regular.ttf')  format('truetype');
			}
			@font-face {
				font-family: "Roboto_Mono";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Roboto_Mono/RobotoMono-Regular.ttf')  format('truetype');
			}
			@font-face {
				font-family: "Roboto_Slab";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf')  format('truetype');
			}
			@font-face {
				font-family: "Comfortaa";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Comfortaa/static/Comfortaa-Regular.ttf')  format('truetype');
			}
			@font-face {
				font-family: "Baloo";
				src: url('<?php bloginfo('template_url');?>/styles/fonts/Baloo/Baloo-Regular.ttf')  format('truetype');
			}
		</style>
	</head>
	<body>
		<?php 
			if ($post->ID !== 26) {
				get_template_part('menuheader');
			}
		?>
		<div class="container-fluid">