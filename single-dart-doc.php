<?php
get_header();


?>

<!-- sidebar -->

<?php while (have_posts()) : the_post(); ?>
    <?php
    $dartLevel = wp_get_post_terms(get_the_ID(), 'dart-level')[0]->slug;
    $dartLevelName = wp_get_post_terms(get_the_ID(), 'dart-level')[0]->name;
    $docPostID = get_the_ID();
    ?>
<?php
endwhile;
?>



<div class="lessonMenu d-lg-none d-block shadow"><i class="bi bi-arrow-right-circle-fill fs-2"></i></div>
<div class="doc-page <?php if (is_user_logged_in()) echo "user-logged-in"; ?>">
    <div class="container-fluid m-0 p-0">
        <div class="d-flex flex-lg-row flex-column flex-wrap">


            <!-- sidebar -->
            <div class="sidebar d-lg-flex flex-column">
                <div class="flex-shrink-0 py-2 py-lg-3 bg-white scrollarea my-lg-3">
                    <h4 class="gradient-text ps-3 pt-3 pt-xl-0 pb-3">DART : <?php echo $dartLevelName; ?></h4>

                    <ul class="list-unstyled ps-0 my-2 scrollarea">


                        <?php

                        $args = array(
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'dart-level',
                                    'field' => 'slug',
                                    'terms' => $dartLevel
                                ),
                            ),
                            'post_type'      => 'dart-doc',
                            'posts_per_page' => -1,
                            "order"          => "ASC",
                        );
                        $recent_posts = new WP_Query($args);
                        wp_reset_postdata();

                        ?>


                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">

                            <?php

                            $docPostIDs = array();

                            $loopCount = 1;

                            while ($recent_posts->have_posts()) :
                                $recent_posts->the_post();
                                $docPostIDs[] = get_the_ID();

                            ?>
                                <li class="doc-item ps-2 ps-sm-3 <?php echo ($docPostID == get_the_ID()) ? "active" : "" ?>"><a href="<?php echo get_permalink() ?>" class="link-dark rounded my-1 py-1 text-decoration-none">
                                        <?php echo $loopCount . ". " . get_the_title();
                                        $loopCount += 1; ?> </a>
                                </li>
                                <li class="border-top border-1 w-100 my-1"></li>

                            <?php endwhile; ?>

                            <?php
                            wp_reset_postdata();
                            ?>
                            <li style="height:10px"></li>
                        </ul>
                    </ul>



                    <div class="other-levels pb-5">
                        <?php

                        $terms = get_terms([
                            'taxonomy' => 'dart-level',
                            'hide_empty' => false,
                            'orderby' => 'id',
                            'order' => 'ASC'
                        ]);

                        foreach ($terms as $term) {
                            if($term->slug == $dartLevel){
                                continue;
                            }

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
                                    echo '<a href="'.get_the_permalink().'" class="btn btn-secondary my-3 upcoming-level"><span>'.$term->name.'</span> <i class="bi bi-arrow-right"></i></a>';
                                }
                            }
                        }

                        wp_reset_postdata();

                        $next_dart_level = "Beginner Level";

                        if($dartLevel == "beginner-level"){
                            $next_dart_level = "Intermediate Level";
                        }else if ($dartLevel == "intermediate-level"){
                            $next_dart_level = "Expert Level";
                        }

                        ?>
                        <div style="height:80px"></div>
                    </div>

                </div>
            </div>










            <div class="leftbar">
                <article class="article" data-doctype="dart" data-doclevel="<?php echo $dartLevelName; ?>" data-next-doc-level="<?php echo $next_dart_level ?>">
                    <div class="container-fluid">


                        <?php while (have_posts()) : the_post(); ?>
                            <h2><?php the_title(); ?></h2>

                            <?php
                            if (get_the_post_thumbnail_url()) : ?>
                                <div class="w-100 d-grid place-items-center pt-2 pb-3">
                                    <img class="main-img px-0 px-sm-2" src="<?php echo get_the_post_thumbnail_url() ?>">
                                </div>
                            <?php endif; ?>

                            <div class="doc-content">
                                <?php the_content();  ?>
                            </div>


                        <?php endwhile; ?>

                        <!-- pagination -->
                        <?php

                        $current_position = array_search($docPostID, $docPostIDs);
                        if ($current_position == 0) {
                            $prev_post = null;
                            $next_post = $docPostIDs[$current_position + 1];
                        } else if ($current_position == (count($docPostIDs) - 1)) {
                            $next_post = null;
                            $prev_post = $docPostIDs[$current_position - 1];
                        } else {
                            $prev_post = $docPostIDs[$current_position - 1];
                            $next_post = $docPostIDs[$current_position + 1];
                        }

                        ?>


                        <div class="doc-pagination tutor-next-previous-pagination-wrap d-flex justify-content-center my-2 my-md-4 py-3">
                            <div class="d-block w-100 px-4 mt-0 mb-2 mb-md-4 text-center">

                                <?php
                                if (!empty($prev_post)) {
                                ?>
                                    <a href="<?php echo get_the_permalink($prev_post); ?>" class="text-decoration-none link-dark float-start"><i class="bi bi-chevron-left fs-1 align-middle" style="font-size: 22px !important;"></i> Previous</a>

                                <?php
                                }

                                if (!empty($next_post)) {
                                ?>
                                    <a href="<?php echo get_the_permalink($next_post); ?>" class="fs-5 text-decoration-none link-dark float-end">Next <i class="bi bi-chevron-right fs-1 align-middle" style="font-size:22px !important;"></i></a>
                                <?php
                                } else { ?>
                                    <a href="#" class="fs-5 text-decoration-none link-dark float-end" onclick="dartDocLevelCompleted();">Next <i class="bi bi-chevron-right fs-1 align-middle" style="font-size:22px !important;"></i></a>
                                <?php }
                                ?>

                            </div>
                        </div>

                        <div class="py-2"></div>


                    </div>
                </article>
            </div>




            <!-- rightbar -->
            <div class="rightbar flex-lg-column">
                <div class="soical-ref">
                    <div class="text-container">
                        <div>
                            <span>Join the</span><span>&nbsp;BIGGEST</span> <br /> <span>Flutter Community</span>
                        </div>
                        <div>
                            🥳
                        </div>
                    </div>

                    <div class="social-links">

                        <div>
                            <a href="https://t.me/flutter_comm_2BC">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/telegram.png'; ?> " alt="">
                            </a>
                        </div>

                        <div>
                            <a href="https://www.instagram.com/flutter2bc/">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/instagram.png'; ?> " alt="">
                            </a>
                        </div>


                        <div>
                            <a href="https://www.facebook.com/flutter2bc">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/facebook.png'; ?> " alt="">
                            </a>
                        </div>


                        <div>
                            <a href="https://www.linkedin.com/company/2bytecode/">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/linkedin.png'; ?> " alt="">
                            </a>
                        </div>

                        <div>
                            <a href="https://www.youtube.com/channel/UCmgENiNqlTNoT1F1d07yqJQ">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/youtube.png'; ?> " alt="">
                            </a>
                        </div>


                        <div>
                            <a href="https://discord.gg/X4Cj8gpPRX">
                                <img src="<?php echo get_template_directory_uri() . '/images/doc/social/discord.png'; ?> " alt="">
                            </a>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<?php
do_shortcode("[dart_doc_anm_add_resources
current_doc='".$dartLevelName."'
next_doc='".$next_dart_level."'
]");
?>


<?php
get_footer();
