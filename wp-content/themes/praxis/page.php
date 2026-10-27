<?php
/**
 * The template for displaying all pages
 *
 * This is the default page template in a WordPress theme.
 *
 * @package Theme_Name
 * @since 1.0.0
 */

get_header();
?>

<main>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
?>