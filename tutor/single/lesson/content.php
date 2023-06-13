<?php

/**
 * Display the content
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post;
global $previous_id;
global $next_id;

// Get the ID of this content and the corresponding course
$course_content_id = get_the_ID();
$course_id         = tutor_utils()->get_course_id_by_subcontent($course_content_id);

$_is_preview = get_post_meta($course_content_id, '_is_preview', true);
$content_id  = tutor_utils()->get_post_id($course_content_id);
$contents    = tutor_utils()->get_course_prev_next_contents_by_id($content_id);
$previous_id = $contents->previous_id;
$next_id     = $contents->next_id;

// Get total content count
$course_stats = tutor_utils()->get_course_completed_percent($course_id, 0, true);

$jsonData                                 = array();
$jsonData['post_id']                      = get_the_ID();
$jsonData['best_watch_time']              = 0;
$jsonData['autoload_next_course_content'] = (bool) get_tutor_option('autoload_next_course_content');

$best_watch_time = tutor_utils()->get_lesson_reading_info(get_the_ID(), 0, 'video_best_watched_time');
if ($best_watch_time > 0) {
    $jsonData['best_watch_time'] = $best_watch_time;
}

$is_comment_enabled = tutor_utils()->get_option('enable_comment_for_lesson') && comments_open();
$is_enrolled        = tutor_utils()->is_enrolled($course_id);


$course_Cates = get_the_terms( $course_id, 'course-category' );
$is_video_course = "";
if($course_Cates){
	foreach($course_Cates as $cc){
		if($cc->slug == "video-course"){
			$is_video_course = true;
		}
	}
}

?>

<?php do_action('tutor_lesson/single/before/content'); ?>
<?php if ($is_enrolled) : ?>




    <div class="tutor-topbar-assignment-details tutor-d-flex tutor-align-items-center d-none">
        <?php
        do_action('tutor_course/single/enrolled/before/lead_info/progress_bar');
        ?>
        <div class="tutor-fs-7 tutor-color-design-white">
            <?php if (true == get_tutor_option('enable_course_progress_bar')) : ?>
                <span class="tutor-progress-content tutor-color-primary-60">
                    <?php _e('Your Progress:', 'tutor'); ?>
                </span>
                <span class="tutor-fs-7 tutor-fw-bold">
                    <?php echo $course_stats['completed_count']; ?>
                </span>
                <?php _e('of ', 'tutor'); ?>
                <span class="tutor-fs-7 tutor-fw-bold">
                    <?php echo $course_stats['total_count']; ?>
                </span>
                (<?php echo $course_stats['completed_percent'] . '%'; ?>)
            <?php endif; ?>
        </div>
        <?php
        do_action('tutor_course/single/enrolled/after/lead_info/progress_bar');
        ?>
        <!-- <div class="tutor-topbar-complete-btn tutor-ml-24"> -->
        <?php tutor_lesson_mark_complete_html(); ?>
        <!-- </div> -->
    </div>

<?php endif; ?>

<!-- Load Lesson Video -->
<input type="hidden" id="tutor_video_tracking_information" value="<?php echo esc_attr(json_encode($jsonData)); ?>">
<?php

$referer_url        = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$referer_comment_id = explode('#', $_SERVER['REQUEST_URI']);
$url_components     = parse_url($referer_url);
isset($url_components['query']) ? parse_str($url_components['query'], $output) : null;
$page_tab = isset($_GET['page_tab']) ? esc_attr($_GET['page_tab']) : (isset($output['page_tab']) ? $output['page_tab'] : null);
?>

<style>
    .tutor-actual-comment.viewing {
        box-shadow: 0 0 10px #cdcfd5;
        animation: blinkComment 1s infinite;
    }

    @keyframes blinkComment {
        50% {
            box-shadow: 0 0 0px #ffffff;
        }
    }
</style>


<div class="leftbar">
    <article class="article">
        <div class="container-fluid">

            <?php if($is_video_course): ?>
            
            <div class="video-wrapper pb-2">
            <div class="sidebar-icon">
                <i class="bi bi-arrow-left-short"></i>
                <span>Course content</span>
            </div>
            <?php tutor_lesson_video(); ?>


            <?php 
					if(is_user_logged_in()):
                    ?>
					<div class="tutor-fs-7 ps-3 pb-3 tutor-color-black-50 course-progress">
						<?php $course_stats = tutor_utils()->get_course_completed_percent($course_id, 0, true);
						if (true == get_tutor_option('enable_course_progress_bar')) : ?>
							<span class="tutor-progress-content tutor-color-black-50">
								<?php _e('Your Progress:', 'tutor'); ?>
							</span>
							<span class="tutor-fs-7 tutor-fw-bold">
								<?php echo $course_stats['completed_count']; ?>
							</span>
							<?php _e('of ', 'tutor'); ?>
							<span class="tutor-fs-7 tutor-fw-bold">
								<?php echo $course_stats['total_count']; ?>
							</span>
							(<?php echo $course_stats['completed_percent'] . '%'; ?>)
						<?php endif; ?>
					</div>
					
					<?php endif; ?>
            </div>
            <?php endif; ?>


            <div class="tutor-course-spotlight-wrapper <?php if($is_video_course){echo "px-3 px-md-1";} ?>">
            <div class="tutor-spotlight-tab tutor-default-tab tutor-course-details-tab">
                <div class="tab-header tutor-d-flex justify-content-center">
                    <div class="tab-header-item flex-center<?php echo (!isset($page_tab) || 'overview' == $page_tab) ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-1" data-tutor-query-string="overview">
                        <span class="tutor-icon-document-alt-filled d-none d-sm-inline"></span>
                        <span><?php _e('Overview', 'tutor'); ?></span>
                    </div>
                    <div class="tab-header-item flex-center<?php echo 'files' == $page_tab ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-2" data-tutor-query-string="files">
                        <span class="tutor-icon-attach-filled d-none d-sm-inline"></span>
                        <span><?php _e('Exercise Files', 'tutor'); ?></span>
                    </div>
                    <?php if ($is_comment_enabled) : ?>
                        <div class="tab-header-item flex-center<?php echo 'comments' == $page_tab ? ' is-active' : ''; ?>" data-tutor-spotlight-tab-target="tutor-course-spotlight-tab-3" data-tutor-query-string="comments">
                            <span class="tutor-icon-comment-filled d-none d-sm-inline"></span>
                            <span><?php _e('Comments', 'tutor'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="tab-body">

                    <div class="overview-wrapper tab-body-item<?php echo (!isset($page_tab) || 'overview' == $page_tab) ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-1" data-tutor-query-string-content="overview">
                        <div class="tutor-fs-6 tutor-color-black-60 tutor-mt-12" style="min-height:5px;">

                            <?php 
                            if(!$is_video_course)
                            { tutor_lesson_video(); 
                            }else{
                                echo '<button type="button" class="btn btn-primary view-course-content mb-4">View Course Content <i class="bi bi-arrow-right-short"></i></button>';
                            }


                            the_content();

                            ?>
                            

                        </div>
                    <?php if(is_user_logged_in()):
                        ?>
                        <div class="tutor-spotlight-mobile-progress-complete tutor-px-20 tutor-py-16 tutor-mt-20 tutor-d-block mt-4">
                            <div class="tutor-row tutor-align-items-center">
    
                                <?php 
                                        $is_completed_lesson = tutor_utils()->is_completed_lesson();
                                        $my_lesson_complete = $is_completed_lesson ? true : false;
                                        if(!$my_lesson_complete):
                                ?>
    
                                <div class="tutor-spotlight-mobile-progress-left col-12 col-md-6">
                                    <div class="tutor-fs-7 tutor-color-muted">
                                        <?php echo $course_stats['completed_percent'] . '%'; ?><span>&nbsp;Complete</span>
                                    </div>
                                    <div class="list-item-progress tutor-my-16">
                                        <div class="progress-bar tutor-mt-12" style="--progress-value:<?php echo $course_stats['completed_percent']; ?>%;"><span class="progress-value"></span></div>
                                    </div>
                                </div>
                                <div class="tutor-spotlight-mobile-progress-right col-12 col-md-6">
                                    <?php 
                                        tutor_lesson_mark_complete_html();
                                    ?>
                                </div>
                                <?php else: ?>
                                    <div class="tutor-spotlight-mobile-progress-left tutor-col-12">
                                    <div class="tutor-fs-7 tutor-color-black-50">
                                        <?php echo $course_stats['completed_percent'] . '%'; ?><span>&nbsp;Complete</span>
                                    </div>
                                    <div class="list-item-progress tutor-my-16">
                                        <div class="progress-bar tutor-mt-12" style="--progress-value:<?php echo $course_stats['completed_percent']; ?>%;"><span class="progress-value"></span></div>
                                    </div>
                                </div>
                                <div class="tutor-spotlight-mobile-progress-right tutor-col-6 d-none">
                                    <?php 
                                        tutor_lesson_mark_complete_html();
                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                            
                        
                        
                    </div>


                    <div class="tab-body-item<?php echo 'files' == $page_tab ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-2" data-tutor-query-string-content="files">
                        <div class="tutor-fs-6 tutor-fw-medium tutor-color-black"><?php _e('Exercise Files', 'tutor'); ?></div>
                        <?php get_tutor_posts_attachments(); ?>
                    </div>


                    <?php if ($is_comment_enabled) : ?>
                        <div class="tab-body-item<?php echo 'comments' == $page_tab ? ' is-active' : ''; ?>" id="tutor-course-spotlight-tab-3" data-tutor-query-string-content="comments">
                        <?php 
                        if(is_user_logged_in()){
                            require __DIR__ . '/comment.php';
                        }else{
                            echo "<p class='lead'> Please Login to join the conversation </p>";
                        }
                        ?>
                        </div>
                    <?php endif; ?>


                    <div class="tutor-next-previous-pagination-wrap d-flex justify-content-center my-5">
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


                </div>
            </div>
            </div>

        </div>
    </article>
</div>


<!-- rightbar -->
<?php if(!$is_video_course): ?>
<div class="rightbar flex-lg-column">
    <div class="m-0">
        <img src="https://via.placeholder.com/150/2f2e41/000000">
        <img src="https://via.placeholder.com/150/2f2e41/000000">
    </div>
</div>
<?php endif; ?>

</div>
</div>
</div>

<?php do_action('tutor_lesson/single/after/content'); ?>


<?php
// login popup
if(!is_user_logged_in()):
$lost_pass = apply_filters('tutor_lostpassword_url', wp_lostpassword_url());
?>
<div class="tutor-login-modal tutor-modal tutor-is-sm tutor-modal-is-close-inside-inner">
    <span class="tutor-modal-overlay"></span>
    <div class="tutor-modal-root">
        <div class="tutor-modal-inner">
            <button data-tutor-modal-close class="tutor-modal-close">
                <span class="tutor-icon-line-cross-line tutor-icon-40"></span>
            </button>
            <?php do_action("tutor_before_login_form"); ?>

            <div class="tutor-modal-body">
                <div class="tutor-fs-5 tutor-color-black tutor-mb-32">
                    <?php _e('Hi, Welcome back!', 'tutor'); ?>
                </div>
                <?php
                    // load form template.
                    $login_form = trailingslashit( tutor()->path ) . 'templates/login-form.php';
                    tutor_load_template_from_custom_path(
                        $login_form,
                        false
                    );
                ?>
                <?php do_action("tutor_after_login_form"); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>