<?php get_header(); ?>

<section class="hero">
	<div class="hero-glow" aria-hidden="true"></div>
	<div class="container hero-grid">
		<div class="hero-copy">
			<span class="eyebrow"><?php echo cognicore_icon( 'pin' ); ?> Dubai South &middot; United Arab Emirates</span>
			<h1>AI-powered solutions, <span class="grad">from software to hardware.</span></h1>
			<p class="hero-sub">We build custom software with intelligent AI tools built in, and supply the hardware it runs on, so your operations run smarter and your people work faster.</p>
			<div class="hero-cta">
				<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project <?php echo cognicore_icon( 'arrow' ); ?></a>
				<a class="btn btn-ghost" href="#solutions">Explore solutions</a>
			</div>
			<ul class="chips" aria-label="Focus areas">
				<li class="chip-ai">AI-Powered</li><li>Retail Billing</li><li>Procurement</li><li>Facility Management</li><li>E-Commerce</li><li>POS &amp; Barcode</li><li>Digital Signage</li>
			</ul>
		</div>

		<div class="hero-visual" aria-hidden="true">
			<div class="win win-main">
				<div class="win-bar"><i></i><i></i><i></i><span>Retail Billing</span></div>
				<div class="win-body">
					<div class="row"><b></b><u></u></div><div class="row"><b></b><u></u></div><div class="row"><b></b><u></u></div>
					<div class="total"><span></span><strong></strong></div>
				</div>
			</div>
			<div class="win win-sign">
				<div class="win-bar"><i></i><i></i><i></i><span>Digital Signage</span></div>
				<div class="sign"><div class="sign-a"></div><div class="sign-b"></div><div class="sign-c"></div></div>
			</div>
			<div class="float f1"><?php echo cognicore_icon( 'printer' ); ?><span>POS &amp; Peripherals</span></div>
			<div class="float f2"><?php echo cognicore_icon( 'spark' ); ?><span>AI-Enhanced Software</span></div>
		</div>
	</div>
	<svg class="skyline" viewBox="0 0 1440 200" preserveAspectRatio="none" aria-hidden="true">
		<path d="M0 200V150h40v-24h30v24h26v-50h24v50h30v-34h28v34h40v-62h22v62h26v-40h34v40h40v-76h20v76h28v-30h36v30h40v-54h26v54h34V90h18v60h30v-44h32v44h40v-92h12L688 18l8 52h14v80h30v-66h30v66h38v-40h28v40h34v-58h22v58h40v-84h20v84h30v-36h36v36h34v-62h26v62h40v-46h30v46h34v-70h22v70h40v-34h30v34h36v-52h28v52h40v-38h30v38h34v-60h24v60h40v-30h30v30h60v50z" fill="rgba(11,18,36,.9)"/>
	</svg>
</section>

<section class="section" id="solutions">
	<div class="container">
		<div class="head reveal">
			<span class="eyebrow">What we do</span>
			<h2>Everything under one roof, <span class="grad">from advice to deployment.</span></h2>
			<p class="lead">Six capabilities that work on their own or come together as a single, fully managed solution, with AI woven through the software we build.</p>
		</div>
		<div class="bento">
			<?php foreach ( cognicore_activities() as $a ) : ?>
				<article class="tile reveal">
					<span class="tile-ico"><?php echo cognicore_icon( $a['icon'] ); ?></span>
					<h3><?php echo esc_html( $a['title'] ); ?></h3>
					<p><?php echo esc_html( $a['desc'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cognicore_ai_section(); ?>

<section class="section section-alt">
	<div class="container">
		<div class="head reveal">
			<span class="eyebrow">How we work</span>
			<h2>A clear path from idea to <span class="grad">live system.</span></h2>
		</div>
		<ol class="steps">
			<li class="reveal"><span class="num">01</span><h3>Consult</h3><p>We study your operations and define the right scope, systems and hardware.</p></li>
			<li class="reveal"><span class="num">02</span><h3>Design</h3><p>Architecture, interfaces and equipment choices, agreed before we build.</p></li>
			<li class="reveal"><span class="num">03</span><h3>Build &amp; Deploy</h3><p>Software developed, hardware supplied and everything installed and integrated.</p></li>
			<li class="reveal"><span class="num">04</span><h3>Support</h3><p>Training, maintenance and continued improvement after go-live.</p></li>
		</ol>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="head reveal">
			<span class="eyebrow">Industries</span>
			<h2>Built for businesses that <span class="grad">run on technology.</span></h2>
		</div>
		<div class="industry">
			<div class="ind reveal"><h3>Supermarkets &amp; Retail</h3><p>Billing, POS terminals, barcode scanning and live price displays.</p></div>
			<div class="ind reveal"><h3>Parking &amp; Facilities</h3><p>Guidance screens, signage and facility management software.</p></div>
			<div class="ind reveal"><h3>Enterprises &amp; Institutions</h3><p>Procurement systems, hardware supply and IT consultancy.</p></div>
			<div class="ind reveal"><h3>Online Business</h3><p>E-commerce platforms connected to your back-office systems.</p></div>
		</div>
	</div>
</section>

<section class="section cta-wrap">
	<div class="container">
		<div class="cta reveal">
			<h2>Ready to build your next solution?</h2>
			<p>Tell us what you need. We'll respond with a clear plan.</p>
			<a class="btn btn-light" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact us <?php echo cognicore_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
