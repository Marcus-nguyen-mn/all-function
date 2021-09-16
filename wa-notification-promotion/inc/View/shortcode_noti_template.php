<div class="noti-promotion">
    <a href="javascript:void(0)" class="ic-noti-pro" id="notiPromotion">
        <i class="wa-bell"></i>
    </a>
    <div class="list-noti-promotion" id="popupNotiPromotion">
        <?php
        $args = array(
            'posts_per_page' => 15,
            'post_type' => 'noti_promotion',
            'orderby' => 'date',
        );
        $promotion_query = new WP_Query( $args );
        if ( $promotion_query->have_posts() ) :
            while ( $promotion_query->have_posts() ) : $promotion_query->the_post();?>
        <a href="<?php the_permalink(); ?>" class="mc-row">
            <div class="img-promotion">
                <?php echo get_the_post_thumbnail(); ?>
            </div>
            <div class="content-promotion">
                <div class="ct-npro-pleft">
                    <div class="title-promotion">
                    <?php the_title(); ?>  
                    </div>
                    <div class="date-promotion">
                        <?php 
                            echo get_the_date("d/m/Y");
                        ?>
                    </div>
                </div>
                
            </div>
        </a>
        <?php    
            endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
</div>