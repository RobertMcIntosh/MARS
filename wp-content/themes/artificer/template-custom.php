<?php
/**
 * Template Name: Widget Page
 *
 * This template is to add widgets to pages
 *
 * @package WooFramework
 * @subpackage Template
 */
get_header();
global $woo_options;
?>
<div id="content" class="page col-full">

	<?php woo_main_before(); ?>

	<section id="main"  class="col-left">
		<?php 
		if (is_active_sidebar('custom'));
		?>
		<div id="customWidgetArea" class="widget-area">
			<?php 
				dynamic_sidebar('custom');
			?>
		</div>
	</section>
	<!--main -->

	<?php woo_main_after(); ?>
	
	<?php get_sidebar(); ?>
</div>
<!--content -->

<?php get_footer(); ?>