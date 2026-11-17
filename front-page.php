<?php get_header(); ?>
<section class="hero">
	<div class="container">
		<h1>Complete technology solutions, from software to hardware.</h1>
		<p>We advise, develop and deliver: custom software together with the hardware it runs on, so you have one dependable partner from design to deployment.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get in touch</a>
		<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Our activities</a>
	</div>
</section>

<section class="section">
	<div class="container">
		<h2>What we do</h2>
		<p class="lead">From expert advice to full deployment, everything under one roof.</p>
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
