<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<section class="page-hero">
	<div class="container">
		<span class="eyebrow">Cognicore Technologies</span>
		<h1><?php the_title(); ?></h1>
	</div>
</section>
<section class="section">
	<div class="container">
	<?php if ( is_page( 'services' ) ) : ?>
		<p class="lead reveal">Whether you need advice, custom software, hardware or a complete solution, here is how we can help.</p>
		<div class="bento">
			<?php foreach ( cognicore_activities() as $a ) : ?>
				<article class="tile reveal"><span class="tile-ico"><?php echo cognicore_icon( $a['icon'] ); ?></span><h3><?php echo esc_html( $a['title'] ); ?></h3><p><?php echo esc_html( $a['desc'] ); ?></p></article>
			<?php endforeach; ?>
		</div>
	<?php elseif ( is_page( 'contact' ) ) : ?>
		<div class="contact-grid">
			<div class="panel reveal">
				<h2>Send us a message</h2>
				<div class="prose"><?php the_content(); ?></div>
			</div>
			<aside class="reveal"><?php echo do_shortcode( '[cognicore_address]' ); ?></aside>
		</div>
	<?php else : ?>
		<div class="prose prose-wide reveal"><?php the_content(); ?></div>
	<?php endif; ?>
	</div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>
