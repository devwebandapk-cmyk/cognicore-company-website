<?php get_header(); ?>
<section class="hero">
	<div class="container">
		<h1>Technology that moves your business forward.</h1>
		<p>From hardware supply to software design, we connect businesses with the technology and products they need to grow.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get in touch</a>
		<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Our activities</a>
	</div>
</section>

<section class="section">
	<div class="container">
		<h2>What we do</h2>
		<p class="lead">Five areas of expertise, one dependable partner.</p>
		<div class="grid">
			<?php foreach ( cognicore_activities() as $a ) : ?>
				<div class="card"><h3><?php echo esc_html( $a[0] ); ?></h3><p><?php echo esc_html( $a[1] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section alt">
	<div class="container">
		<h2>Why Cognicore</h2>
		<p class="lead">Consistent supply, open communication and uncompromising standards.</p>
		<div class="grid">
			<div class="card"><h3>Dependable</h3><p>Consistent sourcing and on-time delivery.</p></div>
			<div class="card"><h3>Transparent</h3><p>Straightforward terms and regular updates.</p></div>
			<div class="card"><h3>Versatile</h3><p>Hardware, software and trading expertise in one place.</p></div>
		</div>
	</div>
</section>

<section class="cta">
	<div class="container">
		<h2>Looking for a supplier?</h2>
		<p>Tell us what you need and we'll get back to you quickly.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact us</a>
	</div>
</section>
<?php get_footer(); ?>
