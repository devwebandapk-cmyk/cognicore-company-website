<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="page-header"><div class="container"><h1><?php the_title(); ?></h1></div></section>
<section class="page-content"><div class="container"><?php the_content(); ?>
	<?php if ( is_page( 'services' ) ) : ?>
		<div class="grid">
			<?php foreach ( cognicore_activities() as $a ) : ?>
				<div class="card"><h3><?php echo esc_html( $a[0] ); ?></h3><p><?php echo esc_html( $a[1] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if ( is_page( 'contact' ) ) : ?>
		<h2>Our office</h2>
		<?php echo do_shortcode( '[cognicore_address]' ); ?>
	<?php endif; ?>
</div></section>
<?php endwhile; ?>
<?php get_footer(); ?>
