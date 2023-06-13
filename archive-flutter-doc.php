<?php
get_header();
?>




<div class="doc-level flutter">
    <div class="container d-flex flex-column justify-content-center">
        <div class="titleWrap mt-5 mb-1 mb-md-2 text-center">
            <h2>Flutter Widgets</h2>
        </div>

        <div class="contentWrap mt-4 mb-5 pb-5">


<?php

$terms = get_terms([
    'taxonomy' => 'flutter-categories',
    'hide_empty' => false,
    'orderby' => 'id',
    'order' => 'ASC'
]);

$res = array();

foreach($terms as $term){
    $args = array(
        'post_type'      => 'flutter-doc',
        'posts_per_page' => 1,
        "order"          => "ASC",
        'tax_query' => array(
            array(
                'taxonomy' => 'flutter-categories',
                'field'    => 'slug',
                'terms'    => $term->slug,
            ),
        ),
    );
    $recent_posts = new WP_Query($args);
    if ($recent_posts->have_posts()) {
        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
            array_push($res, get_permalink());
        }
    }
}
      
wp_reset_postdata();

?>




<div class="card">
    <a href="<?php echo $res[0];?>">
        <div class="card-img">
            <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/basic-widgets-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/basic-widgets-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/basic-widgets-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Basic Widgets</h3>
        <p class="small mb-0">Most common widgets used in all the flutter application.</p>
        </div>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[1];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/text-widgets-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/text-widgets-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/text-widgets-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Text Widgets</h3>
        <p class="small mb-0">All the text widgets used in flutter application.</p>
        </div>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[2];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/button-widgets-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/button-widgets-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/button-widgets-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Button Widgets</h3>
        <p class="small mb-0">Button widgets are used to listen the changes and act accordingly.</p>
        </div>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[3];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/input-fields-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/input-fields-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/input-fields-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Input Fields</h3>
        <p class="small mb-0">Textfields, formfields and etc are included in this input fields.</p>
        </div>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[4];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/advanced-widgets-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/advanced-widgets-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/advanced-widgets-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Advanced Widgets</h3>
        <p class="small mb-0">Advanced widgets are included in this such as tapBar, silverAppBar etc.</p>
        </div>
    </a>
</div>



<div class="card">
    <a href="<?php echo $res[5];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/image-widgets-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/image-widgets-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/image-widgets-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Image Widgets</h3>
        <p class="small mb-0">Image widgets to improve the app User experiance in flutter app.</p>
        </div>
    </a>
</div>


<div class="card me-auto flex-grow-0">
    <a href="<?php echo $res[6];?>">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/animation-light.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/animation-dark.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/doc/flutter-cat/animation-light.svg'; ?>" />
        </div>
        <div class="card-body">
        <h3>Animation</h3>
        <p class="small mb-0">Animation widgets with their usability.</p>
        </div>
    </a>
</div>




</div>
</div>
</div>



<?php

get_footer();

