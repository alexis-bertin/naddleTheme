<?php 
    get_header(); 
    the_post();
?>

    <div class="pageInfos row justify-content-center">
        <h2 class="col-12">Quelques infos pratiques</h2>
            <div class="col-10">
                <?= the_content() ?>
            </div>
    </div>

<?php get_footer(); ?>