<?php

global $pafa_faq_data,$post,$pafa;

if ( count( $pafa_faq_data['questions'] ) == 0 ) {
    _e('No Faq Found','faq-creator');
    return ;
}

$icon_closed = $pafa->get( 'icon_closed' );

if ( isset( $icon_closed ) && $icon_closed != '' ) {
    $icon   = '<span style="background-color:' . $args["icon_bg_color"] . '; border-radius: ' . $args["icon_bg_radius"] . 'px; ?>;"><i class="' . $icon_closed . '" style="color: ' . $args['icon_color'] . '"></i></span>';
    $class  = ' pafa-icon';
} else {
    $icon   = '';
    $class  = '';
}

?>
<!-- Accordion Template -->
<div class="dickensos_faq_accordion">
    <?php
    if ( isset( $pafa_faq_data['terms'] ) ) {
        $i = 1;
        foreach ( $pafa_faq_data['terms'] as $terms ) {
            if ( count( $pafa_faq_data['questions'][ $terms->term_id ] ) > 0 ) {
                ?>
                <div class="pafa-accordion-cat">
                    <h2>
                        <a name="<?php echo $i++ . $terms->slug; ?>"></a><?php echo $terms->name; ?>
                    </h2>
                    <?php
                    foreach( $pafa_faq_data['questions'][ $terms->term_id ] as $post ) {
                        setup_postdata( $post );
                        ?>
                        <div class="pafa-accordion<?php echo $class; ?>">
                            <h3 class="pafa-accordion-q"><?php echo $icon; ?><?php the_title(); ?></h3>
                            <div class="pafa-accordion-a">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php
                } ?>
                </div>
        <?php } 
        }
        
    } else {
        foreach ( $pafa_faq_data['questions'] as $post ) {
            setup_postdata($post);
        ?>
        <div class="pafa-accordion<?php echo $class; ?>">
            <h3 class="pafa-accordion-q"><?php echo $icon; ?><?php the_title(); ?></h3>
            <div class="pafa-accordion-a">
                <?php the_content(); ?>
            </div>
        </div>
        <?php
        }
    }?>
</div>
