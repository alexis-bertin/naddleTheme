<?php 
    get_header(); 
    the_post();
?>

    <div class="pageCGUCGV">
        <h2>Mentions légales</h2>
        <div class="row justify-content-center">
            <div class="col-10">
                <?= the_content() ?>
            </div>    
        </div>
    </div>

<?php get_footer(); ?>