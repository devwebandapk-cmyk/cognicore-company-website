<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="page-header"><div class="container"><h1><?php the_title(); ?></h1></div></section>
<section class="page-content"><div class="container">
	<p class="lead"><?php echo esc_html( get_the_date() ); ?></p>
	<?php the_content(); ?>
</div></section>
<?php endwhile; ?>
<?php get_footer(); ?>
