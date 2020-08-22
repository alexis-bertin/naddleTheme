<?php 
    get_header(); 
    the_post();
?>

    <div class="container-fluid blocGestionCookies">		
        <?= the_content(); ?>
    </div> 

<?php get_footer(); ?>