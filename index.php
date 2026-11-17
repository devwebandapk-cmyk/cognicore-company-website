<?php get_header(); ?>
<section class="page-hero"><div class="container"><span class="eyebrow">Cognicore Technologies</span><h1><?php echo is_home() ? 'Insights' : esc_html( get_the_archive_title() ); ?></h1></div></section>
<section class="section"><div class="container">
<?php if ( have_posts() ) : ?><div class="bento">
<?php while ( have_posts() ) : the_post(); ?>
	<article class="tile reveal"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html( get_the_date() ); ?></p><?php the_excerpt(); ?></article>
<?php endwhile; ?></div><?php the_posts_pagination(); else : ?><p class="lead">Nothing found.</p><?php endif; ?>
</div></section>
<?php get_footer(); ?>
