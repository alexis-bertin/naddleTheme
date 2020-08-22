<?php 
    get_header(); 
    the_post();
?>

<div class="container-fluid">		
    <div class="pageFAQ">
        <h2>FAQ</h2>
        <div class="row justify-content-center">
            <div class="col-10 div_faq_accordion accordion" data-speed="150">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div> 
<script>
    $('.accordion td').addClass('accordion-item');
    $('.accordion h3').addClass('accordion-title');
    $('.accordion p').addClass('accordion-content');
    $('.accordion').each(function(e) {
        var accordion = $(this);
        var toggleSpeed = accordion.attr('data-speed') || 100;
        function open(item, speed) {
            accordion.find('.accordion-item').not(item).removeClass('active')
                .find('.accordion-content').slideUp(speed);
            item.addClass('active')
                .find('.accordion-content').slideDown(speed);
        }
        open(accordion.find('.active:first'), 0);
        accordion.on('click', '.accordion-title', function(ev) {
            ev.preventDefault();
            open($(this).closest('.accordion-item'), toggleSpeed);
        });
    });
</script>
<?php get_footer(); ?>