<?php

class Categories_Image_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'categories_image_widget',
            'description' => 'Display categories with image',
        );

        parent::__construct( 'imgcat', 'Img Categories' ,$widget_options );
    }

    // Back-end display of widget
    public function form( $instance ) {
        echo 'Sin opciones para mostrar';
    }

    // Front-end display of widget
    public function widget( $args, $instance ) {

        echo $args[ 'before_widget' ];

        ?>

            <div>
                <?php
                $categories= get_categories( array(
                    'orderby'=> 'name',
                    'order'=> 'ASC',
                    'parent'=> 0,
                ));
                    foreach($categories as $category){
                        echo '<archive class="">
                                <a href="'.get_category_link( $category->term_id).'">
                                <figure class="">'.
                                    wp_get_attachment_image(get_term_meta($category->term_id, 'category-image-id', true), '100').
                                '
                                </figure>
                                <span class="">
                                    '.$category->name.'
                                </span>
                                </a>
                            </archive>';
                        }
                ?>
            </div>
        <?php

        echo $args[ 'after_widget' ];
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Categories_Image_Widget' );
} );