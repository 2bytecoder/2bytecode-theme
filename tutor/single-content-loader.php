<?php

/**
 * Template for displaying single lesson, assignment, quiz etc.
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post;
$currentPost = $post;

$method_map = array(
    'lesson' => 'tutor_lesson_content',
    'assignment' => 'tutor_assignment_content',
);

$content_id = tutor_utils()->get_post_id();
$course_id = tutor_utils()->get_course_id_by_subcontent($content_id);
$contents = tutor_utils()->get_course_prev_next_contents_by_id($content_id);
$previous_id = $contents->previous_id;
$next_id = $contents->next_id;

$enable_spotlight_mode = tutor_utils()->get_option('enable_spotlight_mode');
extract($data); // $context, $html_content

function tutor_course_single_sidebar($echo = true, $context = 'desktop')
{
    ob_start();
    tutor_load_template('single.lesson.lesson_sidebar', array('context' => $context));
    $output = apply_filters('tutor_lesson/single/lesson_sidebar', ob_get_clean());

    if ($echo) {
        echo tutor_kses_html($output);
    }

    return $output;
}

do_action('tutor/course/single/content/before/all', $course_id, $content_id);

get_tutor_header();

?>

<?php do_action('tutor_' . $context . '/single/before/wrap'); ?>


<?php tutor_course_single_sidebar(); ?>


<?php (isset($method_map[$context]) && is_callable($method_map[$context])) ? $method_map[$context]() : 0; ?>
<?php echo isset($html_content) ? $html_content  : ''; ?>

<?php if ($context == 'lesson') : ?>

    <div class="tutor-next-previous-pagination-wrap d-flex justify-content-center my-5 d-none">
        <div class="d-block w-100 px-4 mt-0 mb-5 text-center">

            <?php
            if ($previous_id) {
            ?>
                <a href="<?php echo get_the_permalink($previous_id); ?>" class="text-decoration-none link-dark float-start tutor-previous-link-<?php echo $previous_id; ?>"><i class="bi bi-arrow-left-short fs-1 align-middle"></i> Previous</a>

            <?php
            }

            if ($next_id) {
            ?>
                <a href="<?php echo get_the_permalink($next_id); ?>" class="fs-5 text-decoration-none link-dark float-end tutor-next-link-<?php echo $next_id; ?>">Next <i class="bi bi-arrow-right-short fs-1 align-middle"></i></a>
            <?php
            }
            ?>

        </div>
    </div>
<?php endif; ?>

<!-- <div class="tutor-course-single-sidebar-wraper tutor-mobile-sidebar">
    <?php //tutor_course_single_sidebar(true, 'mobile'); ?>
</div> -->



<!-- Course Progressbar on sm/mobile  -->
<?php
// Get the ID of this content and the corresponding course
$course_content_id = get_the_ID();
$course_id         = tutor_utils()->get_course_id_by_subcontent($course_content_id);

// Get total content count
$course_stats = tutor_utils()->get_course_completed_percent($course_id, 0, true);
// moved on content
?>


<?php do_action('tutor_' . $context . '/single/after/wrap'); ?>

<?php get_tutor_footer(); ?>
