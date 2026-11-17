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
	<?php elseif ( is_page( 'about' ) ) : ?>
		<div class="about-grid">
			<div class="reveal">
				<span class="eyebrow">Our story</span>
				<h2 class="about-h">One partner for the software <span class="grad">and the hardware it runs on.</span></h2>
				<div class="prose">
					<p>Cognicore Technologies DWC-LLC is a Dubai-based solution provider that brings software and hardware together. Too often, businesses buy equipment from one supplier, software from another, and are left to make the two work side by side. We close that gap.</p>
					<p>We develop custom software, including retail billing, procurement management, service and facility management systems and e-commerce platforms, and we supply the hardware around it: POS terminals, printers, scanners, barcode readers and digital signage. We also build custom AI tools into that software, from automated workflows to predictive insights and intelligent assistants, so it works harder for your staff and your customers. Our consultancy team helps you choose the right approach before a single line of code is written.</p>
					<p>From our base in Dubai South, we design solutions for retailers, facility operators and enterprises, and stay beside them long after go-live.</p>
				</div>
			</div>
			<aside class="glance reveal">
				<h3>At a glance</h3>
				<dl>
					<div><dt>Company</dt><dd><?php echo esc_html( COGNICORE_COMPANY ); ?></dd></div>
					<div><dt>Headquarters</dt><dd>Dubai South Business Park, Dubai, UAE</dd></div>
					<div><dt>Focus</dt><dd>Software, hardware and consultancy</dd></div>
					<div><dt>Capabilities</dt><dd>AI-powered software &middot; IT consultancy &middot; POS &amp; peripherals &middot; Digital signage &middot; General trading</dd></div>
				</dl>
			</aside>
		</div>

		<div class="duo">
			<div class="tile reveal"><span class="eyebrow">Mission</span><h3>Make technology simple to adopt.</h3><p>We deliver intelligent software and hardware as one dependable solution, so our clients spend their time running their business instead of coordinating suppliers.</p></div>
			<div class="tile reveal"><span class="eyebrow">Vision</span><h3>The trusted partner for complete solutions.</h3><p>We aim to be the first call for businesses that want technology designed, supplied and supported by a single accountable team.</p></div>
		</div>

		<div class="head reveal about-values">
			<span class="eyebrow">How we work</span>
			<h2>Principles that shape <span class="grad">every project.</span></h2>
		</div>
		<div class="industry">
			<div class="ind reveal"><h3>Integrated by design</h3><p>Software and hardware planned together from day one, so they work together on launch day.</p></div>
			<div class="ind reveal"><h3>Practical</h3><p>Solutions built around real workflows, not around features nobody uses.</p></div>
			<div class="ind reveal"><h3>Transparent</h3><p>Clear scope, straightforward terms and honest advice, even when the answer is simpler than expected.</p></div>
			<div class="ind reveal"><h3>Committed</h3><p>Training, maintenance and continued improvement long after installation.</p></div>
		</div>

		<div class="cta reveal about-cta">
			<h2>Let's talk about your project.</h2>
			<p>Share what you are planning and we'll suggest the right way to build it.</p>
			<a class="btn btn-light" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact us <?php echo cognicore_icon( 'arrow' ); ?></a>
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
<?php if ( is_page( 'services' ) ) { cognicore_ai_section(); } ?>
<?php endwhile; ?>
<?php get_footer(); ?>
