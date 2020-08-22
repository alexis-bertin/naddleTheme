<?php get_header(); ?>
    <div class="row blocPage404 justify-content-center">
        <div class="col-10 col-lg-6 sousBlocPage404 align-self-center">
            <div class="row">
                <h1>Oups, une 404 !</h1>
            </div>
            <div class="row">
                <img src="<?php bloginfo('template_url');  ?>/images/404.svg" alt="">
            </div>
            <div class="row">
                <p>Pas de panique, vous ne vous noyez pas</p>
            </div>
            <div class="row" style="margin-top: 40px">
                <a href="<?php bloginfo('url'); ?>">Remonter à la surface <i class="fas fa-arrow-up"></i></a>
            </div>
        </div>
    </div>
    <script>
            $('#menuTopSticky').empty();
            $('#burgerMenuSticky').empty();
            $('.topMenuHeader').remove();
            $('.blocNavSecondMain').remove();
            $('.menuResponsiveHeight').remove();
        $(document).ready(function() {	
            $('.blocFooterTop').remove();
            $('.blocFooterMiddle').remove();
            $('.blocFooterBottom').remove();
        });
    </script>
<?php get_footer();  ?>