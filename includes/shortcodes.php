<?php

function ImgCategories($atts){
    extract(shortcode_atts( array(
            'number'=>''
    ), $atts));
    $categories= get_categories( array(
        'orderby'=> 'name',
        'order'=> 'ASC',
        'parent'=> 0,
        'number'=> $number
    ));

    foreach($categories as $category){
        echo '<archive class="category-item">
                <a href="'.get_category_link( $category->term_id).'">
                <figure class="wrapper-category-img">'.
                    wp_get_attachment_image(get_term_meta($category->term_id, 'category-image-id', true), '100').
                '
                </figure>
                <span class="category-item__name">
                    '.$category->name.'
                </span>
                </a>
            </archive>';
    }
}

add_shortcode( 'imgcategories', 'ImgCategories');
