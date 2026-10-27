<?php
/**
 * The template for displaying all single posts
 *
 * @package Praxis
 * @since 1.0.0
 */

get_header();
?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
?>