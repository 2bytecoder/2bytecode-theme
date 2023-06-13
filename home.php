<?php
/*
Template Name: Blog
*/

/**
 * The template for displaying all blog posts
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TwoByteCode
 */


get_header();
?>



<main id="primary" class="site-main">
    <!-- <div class="container-fluid m-0 p-0 py-4" style="position: relative; top: -10px; background-color: #1F2127;">
        <h2 class="fs-1 my-2 text-white text-center">BLOG</h2>
    </div> -->

    <div class="all-blogs container-fluid my-4">

        <!-- search and category -->
        <div class="pt-4 mb-5">
            <div class="w-100 d-flex gap-1 flex-row flex-wrap align-items-center justify-content-center m-0 p-0" style="width: 100%;">
                <form role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>">
                    <div class="filter-widget-search">
                        <div class="tutor-input-group tutor-form-control-has-icon tutor-from-control">
                            <span class="tutor-icon-search-filled tutor-input-group-icon tutor-color-black-50"></span>
                            <input type="Search" class="tutor-form-control" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="Search...">
                        </div>
                    </div>
                </form>




                <!-- <div class="d-flex gap-1 flex-row flex-wrap align-items-center justify-content-center m-0 pt-4 pt-sm-0" style="width: auto;"> -->
                <?php
                // if($paged_category == ""){
                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag all active"><a href="'. home_url( "/" ). 'articles/">All</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag dart"><a href="'. home_url( "/" ). 'articles/?category=dart">Dart</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag flutter"><a href="'. home_url( "/" ). 'articles/?category=flutter">Flutter</a></div>';
                // }
                // else if($paged_category == "dart"){
                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag all"><a href="'. home_url( "/" ). 'articles/">All</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag dart active"><a href="'. home_url( "/" ). 'articles/?category=dart">Dart</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag flutter"><a href="'. home_url( "/" ). 'articles/?category=flutter">Flutter</a></div>';
                // }
                // else if($paged_category == "flutter"){
                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag all"><a href="'. home_url( "/" ). 'articles/">All</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag dart"><a href="'. home_url( "/" ). 'articles/?category=dart">Dart</a></div>';

                //     echo  "&nbsp;&nbsp;";
                //     echo '<div class="category-tag flutter active"><a href="'. home_url( "/" ). 'articles/?category=flutter">Flutter</a></div>';
                // }
                ?>
                <!-- </div> -->
            </div>
        </div>



        <div class="row mb-2">


            <?php
            // Set up the paged variable
            $paged_category = (isset($_GET['category'])) ? $_GET['category'] : "";
            $paged = (isset($_GET['pg']) && intval($_GET['pg']) > 0) ? intval($_GET['pg']) : 1;

            if ($paged_category != "") {
                query_posts(array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'category_name' => $paged_category));
            } else {
                $exclude_cat = array();
                $exclude_cat[] = get_cat_ID( "packages" );
                query_posts(array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'category__not_in' => $exclude_cat ));
            }
            ?>

            <div class="d-flex flex-column flex-sm-row flex-wrap align-items-center justify-content-center m-0 p-0">


                <!-- show package category -->
                <?php if ($paged_category != "packages"): ?>

                <div class="post-category-card">
                    <a href="<?php echo home_url() . '/articles/?category=packages'; ?>" class="text-decoration-none ">
                        <div class="card border-0 shadow-lg m-4 text-center" style="width: 18rem;height: 345px;">
                            <div class="card-body">
                                <h4>Packages</h4>
                                <p>Read about the Flutter and Dart amazing packages to help you with your next project</p>
                            </div>
                        </div>
                    </a>
                </div>

                <?php endif; ?>



                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>
                            <div class="card m-4 border-0 shadow-lg" style="width: 18rem;height: 345px">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="card-img-top" alt="<?php echo wp_trim_words(get_the_title(), 12, "..."); ?>" style="width: 100%; max-height: 180px; height: 180px">
                                <?php else : ?>
                                    <img class="card-img-top" alt="Thumbnail [100%x240]" src="http://via.placeholder.com/200x240" style="width: 100%; max-height: 180px; height: 180px">
                                <?php endif; ?>


                                <div class="card-body">
                                    <h6 class="card-title mb-0"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></a></h6>
                                    <div class="postCatagory" style="position: absolute; bottom: 70px; color:var(--bs-gray-600);">
                                        <!-- <?php //if (get_the_category()[0]->name == "flutter") {
                                                // echo '<strong class="d-inline-block my-2">flutter</strong>';
                                                // } else if (get_the_category()[0]->name == "dart") {
                                                //  echo '<strong class="d-inline-block my-2">dart</strong>';
                                                // } else {
                                                //   echo '<strong class="d-inline-block my-2">' . get_the_category()[0]->name . '</strong>';
                                                // }
                                                ?> -->
                                        <strong class="d-inline-block my-2 fw-normal"><?php echo get_the_category()[0]->name ?></strong>
                                        
                                    </div>
                                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                    <!-- <a href="#" class="btn btn-primary">Continue reading</a> -->
                                    <a href="<?php the_permalink(); ?>" class="justify-self-end mt-2 btn-continue" style="position: absolute; bottom: 20px">Continue <i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php
                    if ($wp_query->max_num_pages > 1) : ?>
        <nav class="my-5 py-2">
            <ul class="pagination justify-content-center">

                <?php if ($paged_category != "") : ?>

                    <!-- previous -->
                    <?php if (1 == $paged) : ?>
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="<?php echo add_query_arg(array('pg' => $paged - 1, 'category' => $paged_category)) ?>">Previous</a></li>
                    <?php endif; ?>
                    <!-- all page numbers -->
                    <?php for ($i = 1; $i <= $wp_query->max_num_pages; $i++) {
                                $link = $i == 1 ? remove_query_arg('pg') : add_query_arg(array('pg' => $i, 'category' => $paged_category));
                                echo '<li class="page-item' . ($i == $paged ? ' active" aria-current="page" ' : '"') . '><a href="' . $link . '" class="page-link"' . '>' . $i . '</a></li>';
                            } ?>
                    <!-- next -->
                    <?php if ($wp_query->max_num_pages == $paged) : ?>
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="<?php echo add_query_arg(array('pg' => $paged + 1, 'category' => $paged_category)) ?>">Next</a></li>
                    <?php endif; ?>


                <?php else : ?>
                    <!-- previous -->
                    <?php if (1 == $paged) : ?>
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="<?php echo add_query_arg('pg', $paged - 1) ?>">Previous</a></li>
                    <?php endif; ?>
                    <!-- all page numbers -->
                    <?php for ($i = 1; $i <= $wp_query->max_num_pages; $i++) {
                                $link = $i == 1 ? remove_query_arg('pg') : add_query_arg('pg', $i);
                                echo '<li class="page-item' . ($i == $paged ? ' active" aria-current="page" ' : '"') . '><a href="' . $link . '" class="page-link"' . '>' . $i . '</a></li>';
                            } ?>
                    <!-- next -->
                    <?php if ($wp_query->max_num_pages == $paged) : ?>
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="<?php echo add_query_arg('pg', $paged + 1) ?>">Next</a></li>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>
        </nav>
    <?php endif ?>
<?php else : ?>
    <div class="404 not-found px-3 py-5 my-4">
        <h3>Not Found</h3>
        <div class="post-excerpt">
            <p>Sorry, but there are no more posts here... Please try going back to the <a href="<?php echo remove_query_arg(['pg', 'category']); ?>" class="link-dark">main page</a></p>
        </div>
    </div>
<?php endif;

                // Make sure the default query stays intact
                wp_reset_query();


?>

</main><!-- #main -->

<?php
get_footer();
