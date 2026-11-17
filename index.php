<?php get_header(); ?>
<section class="page-header"><div class="container"><h1><?php echo is_home() ? 'Blog' : esc_html( get_the_archive_title() ); ?></h1></div></section>
<section class="page-content"><div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="card" style="margin-bottom:24px">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( get_the_date() ); ?></p>
		<?php the_excerpt(); ?>
	</article>
<?php endwhile; the_posts_pagination(); else : ?>
	<p>Nothing found.</p>
<?php endif; ?>
</div></section>
<?php get_footer(); ?>
