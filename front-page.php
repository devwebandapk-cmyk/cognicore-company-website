<?php get_header(); ?>
<section class="hero">
	<div class="container">
		<h1>Technology that moves your business forward.</h1>
		<p>Cognicore Technologies DWC-LLC supplies computers, peripherals and software, and runs general trading and e-commerce operations.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get in touch</a>
		<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Our activities</a>
	</div>
</section>

<section class="section">
	<div class="container">
		<h2>What we do</h2>
		<p class="lead">Our licensed business activities.</p>
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
		<p class="lead">Dependable supply, clear communication and a focus on quality.</p>
		<div class="grid">
			<div class="card"><h3>Reliable</h3><p>Dependable sourcing and delivery.</p></div>
			<div class="card"><h3>Transparent</h3><p>Clear timelines and regular updates.</p></div>
			<div class="card"><h3>Wide range</h3><p>Hardware, software and general trading under one roof.</p></div>
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
