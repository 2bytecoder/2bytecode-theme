<?php

/**
 * Display Topics and Lesson lists for learn
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
$post_id = get_the_ID();
if (!empty($_POST['lesson_id'])) {
	$post_id = sanitize_text_field($_POST['lesson_id']);
}
$currentPost = $post;
$_is_preview = get_post_meta($post_id, '_is_preview', true);
$course_id   = 0;
if ($post->post_type === 'tutor_quiz') {
	$course    = tutor_utils()->get_course_by_quiz(get_the_ID());
	$course_id = $course->ID;
} elseif ($post->post_type === 'tutor_assignments') {
	$course_id = tutor_utils()->get_course_id_by('assignment', $post->ID);
} elseif ($post->post_type === 'tutor_zoom_meeting') {
	$course_id = get_post_meta($post->ID, '_tutor_zm_for_course', true);
} else {
	$course_id = tutor_utils()->get_course_id_by('lesson', $post->ID);
}
$user_id                      = get_current_user_id();
$enable_qa_for_this_course    = get_post_meta($course_id, '_tutor_enable_qa', true) == 'yes';
$enable_q_and_a_on_course     = tutor_utils()->get_option('enable_q_and_a_on_course') && $enable_qa_for_this_course;
$is_enrolled                  = tutor_utils()->is_enrolled($course_id);
$is_instructor_of_this_course = tutor_utils()->is_instructor_of_this_course($user_id, $course_id);
$is_user_admin                = current_user_can('administrator');


$course_Cates = get_the_terms($course_id, 'course-category');
$course_Cat = "";
if ($course_Cates) {
	foreach ($course_Cates as $cc) {
		if ($cc->slug == "video-course") {
			$course_Cat = $cc->slug;
			$is_video_course = true;
		}
	}
}

?>

<?php do_action('tutor_lesson/single/before/lesson_sidebar'); ?>

<?php if (!$is_video_course) : ?>
	<div class="lessonMenu d-lg-none d-block"><i class="bi bi-arrow-right-circle-fill fs-2"></i></div>
<?php endif; ?>

<div class="lesson-page <?php if (is_user_logged_in()) echo "user-logged-in"; ?> <?php echo $course_Cat; ?>">
	<div class="container-fluid m-0 p-0">
		<div class="d-flex <?php echo $is_video_course ? "" : "flex-lg-row flex-column flex-wrap" ?>">

			<!-- sidebar -->
			<div class="sidebar d-lg-flex flex-column <?php echo $course_Cat; ?>" data-course-id="<?php echo $course_id; ?>">
				<div class="flex-shrink-0 bg-white scrollarea  <?php echo $is_video_course ? "mb-5 pb-5" : "my-lg-3 py-lg-3 py-2" ?>">

					<?php
					if ($is_video_course) {
						echo '<div class="sidebar-top-txt">
					<p>Course content</p>
					<span>x</span>
				</div>';
					}
					?>



					<ul class="list-unstyled ps-0 scrollarea <?php echo $is_video_course ? "mb-4" : "my-2" ?>">

						<?php
						if (is_user_logged_in() && !$is_video_course) :
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




						<?php
						$topics = tutor_utils()->get_topics($course_id);
						if ($topics->have_posts()) {
							$loopvar1 = 1;
							while ($topics->have_posts()) {
								$topics->the_post();
								$topic_id       = get_the_ID();
								$topic_summery  = get_the_content();
								$total_contents = tutor_utils()->count_completed_contents_by_topic($topic_id);
								$randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);
						?>
								<li class="mb-1 tutor-topics-<?php echo $topic_id; ?>">
									<button class="btn btn-toggle align-items-center rounded collapsed <?php echo $is_video_course ? 'text-start' : '' ?>" data-bs-toggle="collapse" data-bs-target="#<?php echo $randomletter ?>-collapse" aria-expanded="false">
										<?php echo $loopvar1 . ". ";
										the_title();
										$loopvar1 += 1 ?>
									</button>
								</li>
								<?php
								if (!$is_video_course) {
									echo '<li class="border-top border-2 my-1"></li>';
								}
								?>


								<div class="collapse" id="<?php echo $randomletter; ?>-collapse">
									<ul class="btn-toggle-nav list-unstyled fw-normal <?php $is_video_course == true ? "" : "pb-1"; ?>">


										<?php
										do_action('tutor/lesson_list/before/topic', $topic_id);
										$lessons = tutor_utils()->get_course_contents_by_topic(get_the_ID(), -1);
										$is_enrolled = tutor_utils()->is_enrolled($course_id, get_current_user_id());
										$loopvar2 = 1;
										while ($lessons->have_posts()) {
											$lessons->the_post();
											$show_permalink = !$_is_preview || $is_enrolled || get_post_meta($post->ID, '_is_preview', true);
											if ($post->post_type === 'tutor_quiz') {
												$quiz = $post;
										?>
												<div class="tutor-lessons-under-topic" data-quiz-id="<?php echo $quiz->ID; ?>">
													<div class="lesson-item tutor-single-lesson-items <?php echo ($currentPost->ID == get_the_ID()) ? 'active tutor-color-design-brand' : ''; ?>">
														<a href="<?php echo $show_permalink ? get_permalink($quiz->ID) : '#'; ?>" class="tutor-single-quiz-a tutor-d-flex tutor-justify-content-between" data-quiz-id="<?php echo $quiz->ID; ?>">
															<div class="tutor-single-lesson-items-left tutor-d-flex py-1">
																<span class="tutor-icon-quiz-filled"></span>
																<span class="lesson_title tutor-fs-7 tutor-color-black-70 quiz-title">
																	<?php echo $quiz->post_title; ?>
																</span>
															</div>
															<div class="tutor-single-lesson-items-right tutor-d-flex tutor-lesson-right-icons">
																<span class="tutor-fs-7 tutor-color-black-50">
																	<?php
																	$time_limit = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_value');
																	if ($time_limit) {
																		$time_type = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_type');

																		$time_type == 'minutes' ? $time_limit = $time_limit * 60 : 0;
																		$time_type == 'hours' ? $time_limit = $time_limit * 3660 : 0;
																		$time_type == 'days' ? $time_limit = $time_limit * 86400 : 0;
																		$time_type == 'weeks' ? $time_limit = $time_limit * 86400 * 7 : 0;

																		// To Fix: If time larger than 24 hours, the hour portion starts from 0 again. Fix later.
																		echo gmdate('H:i:s', $time_limit);
																	}

																	$has_attempt = tutor_utils()->has_attempted_quiz(get_current_user_id(), $quiz->ID)
																	?>

																	<?php if ($show_permalink) : ?>
																		<input type='checkbox' class='tutor-form-check-input tutor-form-check-circle' disabled="disabled" readonly="readonly" <?php echo esc_attr($has_attempt ? 'checked="checked"' : ''); ?> />
																	<?php else : ?>
																		<i class="tutor-icon-lock-stroke-filled"></i>
																	<?php endif; ?>
																</span>
															</div>
														</a>
													</div>
												</div>

												<?php
												if (!$is_video_course) {
													echo '<li class="border-top border-2 w-100 my-1"></li>';
												}
												?>
											<?php


											} else {

												/**
												 * Lesson
												 */

												$video = tutor_utils()->get_video_info();

												$play_time = false;
												if ($video) {
													$play_time = $video->playtime;
												}
												$is_completed_lesson = tutor_utils()->is_completed_lesson();
											?>
												<li class="lesson-item <?php echo ($currentPost->ID === get_the_ID()) ? 'active' : ''; ?>">
													<a href="<?php echo $show_permalink ? get_the_permalink() : '#'; ?>" class="d-block link-dark rounded my-1 py-1 text-decoration-none" data-lesson-id="<?php the_ID(); ?>">
														<?php echo str_pad($loopvar2, 2, '0', STR_PAD_LEFT) . ". ";
														the_title();

														$loopvar2 += 1;


														if ($is_video_course) {
															$video          = maybe_unserialize(get_post_meta($post->ID, '_video', true));
															$runtimeHours   = tutor_utils()->avalue_dot('runtime.hours', $video);
															$runtimeMinutes = tutor_utils()->avalue_dot('runtime.minutes', $video);
															$runtimeSeconds = tutor_utils()->avalue_dot('runtime.seconds', $video);

															if ($runtimeSeconds > 0 && $runtimeHours == 0) {
																echo '<span class="d-flex align-items-center lh-lg"><i class="bi bi-play-circle-fill"></i>&nbsp;<span>' . ($runtimeMinutes + 1) . ' Min</span></span>';
															} else if ($runtimeHours == 0 && $runtimeSeconds == 0 && $runtimeMinutes) {
																echo '<span class="d-flex align-items-center lh-lg"><i class="bi bi-play-circle-fill"></i>&nbsp;<span>' .
																	$runtimeMinutes
																	. 'Min</span></span>';
															} else {
																echo '<span class="d-flex align-items-center lh-lg"><i class="bi bi-play-circle-fill"></i>&nbsp;<span>' . ($runtimeHours) ? $runtimeHours : "00" . ($runtimeMinutes) ? $runtimeMinutes : "00" . ($runtimeSeconds) ? $runtimeSeconds : "00" . ' Hrs</span></span>';
															}
														}

														?>

													</a>
												</li>
												<?php
												if (!$is_video_course) {
													echo '<li class="border-top border-2 w-100 my-1"></li>';
												}
												?>

										<?php
											}
										}
										?>

										<?php
										$lessons->reset_postdata();
										do_action('tutor/lesson_list/after/topic', $topic_id);
										?>

									</ul>
								</div>
								<li class="mb-1 tutor-topics-get-certificate">
									<button class="btn btn-toggle align-items-center rounded collapsed <?php echo $is_video_course ? 'text-start' : '' ?>" data-bs-toggle="collapse" data-bs-target="#get-certificate-collapse" aria-expanded="false">
										Get your certificate
									</button>
								</li>
								<div class="collapse" id="get-certificate-collapse">
									<ul class="btn-toggle-nav list-unstyled fw-normal ">
										<li class="lesson-item">
											<a href="/course-quiz?course-id=<?php echo $course_id; ?>" class="d-block link-dark rounded my-1 py-1 text-decoration-none bg-white">
												Play Quiz
											</a>
										</li>
									</ul>
								</div>

								<?php
								if (!$is_video_course) {
									echo '<li class="border-top border-2 w-100 my-1"></li>';
								}
								?>
								</li>
						<?php
							}
							$topics->reset_postdata();
							wp_reset_postdata();
						}
						?>
					</ul>
				</div>
			</div>




			<?php do_action('tutor_lesson/single/after/lesson_sidebar'); ?>