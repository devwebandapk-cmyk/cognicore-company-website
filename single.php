<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="page-hero"><div class="container"><span class="eyebrow"><?php echo esc_html( get_the_date() ); ?></span><h1><?php the_title(); ?></h1></div></section>
<section class="section"><div class="container"><div class="prose prose-wide"><?php the_content(); ?></div></div></section>
<?php endwhile; ?>
<?php get_footer(); ?>
