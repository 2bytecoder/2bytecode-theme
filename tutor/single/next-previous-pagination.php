<?php

/**
 * Single next previous pagination
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.7
 */

?>


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