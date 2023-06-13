<?php
get_header();
?>




<div class="doc-level">
    <div class="container">
        <div class="titleWrap mt-5 mb-3 text-center">
            <h2>Dart Documentation</h2>
            <p class="lead pb-4">Choose Your Level</p>
        </div>

        <div class="contentWrap mt-3 mb-5">


<?php

$terms = get_terms([
    'taxonomy' => 'dart-level',
    'hide_empty' => false,
    'orderby' => 'id',
    'order' => 'ASC'
]);

$res = array();

foreach($terms as $term){
    $args = array(
        'post_type'      => 'dart-doc',
        'posts_per_page' => 1,
        "order"          => "ASC",
        'tax_query' => array(
            array(
                'taxonomy' => 'dart-level',
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
            <img src="<?php echo get_template_directory_uri() . '/images/doc/Frame7.svg'; ?>" />
        </div>
        <h1>Beginner</h1>

        <ul>
            <li>First Code</li>
            <li>Data Types</li>
            <li>Operators and etc.</li>
        </ul>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[1];?>">
        <div class="card-img">
            <img src="<?php echo get_template_directory_uri() . '/images/doc/Frame8.svg'; ?>" />
        </div>
        <h1>Intermediate</h1>
        <ul>
            <li>If Else Statement</li>
            <li>Switch Case Statement</li>
            <li>Loops and etc.</li>
        </ul>
    </a>
</div>

<div class="card">
    <a href="<?php echo $res[2];?>">
        <div class="card-img">
            <img src="<?php echo get_template_directory_uri() . '/images/doc/Frame9.svg'; ?>" />
        </div>
        <h1>Expert</h1>
        <ul>
            <li>Classes and Objects</li>
            <li>Const and Final Keywords</li>
            <li>Constructors and etc.</li>
        </ul>
    </a>
</div>










</div>
</div>
</div>



<?php

get_footer();

