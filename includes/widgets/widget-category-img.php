<?php

class Categories_Image_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'categories-image-widget',
            'description' => 'Display categories with image',
        );

        parent::__construct( 'imgcat', 'Img Categories' ,$widget_options );
    }

    // Back-end display of widget
    public function form( $instance ) {
        echo 'Si el numero a colocar es 0 traerá todas las categorias';

        $defaults = array(
            'number'=> 0
        );

        extract(wp_parse_args( (array) $instance, $defaults)); ?>

    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number category:', 'text_domain' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
    </p>
<?php
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['number'] = isset($new_instance['number']) ? wp_strip_all_tags($new_instance['number']):'';
        return $instance;
    }

    // Front-end display of widget
    public function widget( $args, $instance ) {

        $number = isset($instance['number'])? $instance['number'] : '';
        echo $args[ 'before_widget' ];

        ?>

            <div class="categories-image-widget__wrapper">
                <?php
                $categories= get_categories( array(
                    'orderby'=> 'name',
                    'order'=> 'ASC',
                    'number'=> $number
                ));
                    foreach($categories as $category){
                        echo '<archive class="categories-image-widget__wrapper__item">
                                <a href="'.get_category_link( $category->term_id).'">
                                <figure class="categories-image-widget__wrapper__item__image">'.
                                    wp_get_attachment_image(get_term_meta($category->term_id, 'category-image-id', true), '100').
                                '
                                </figure>
                                </a>
                                <span class="">
                                    <a href="'.get_category_link( $category->term_id).'">
                                        '.$category->name.'
                                    </a>
                                </span>
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