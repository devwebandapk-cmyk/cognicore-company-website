</main>
<footer class="site-footer">
	<div class="container foot-grid">
		<div>
			<div class="brand brand-foot">
				<svg class="mark" viewBox="0 0 32 32" aria-hidden="true"><path d="M16 2 28 9v14L16 30 4 23V9z" fill="none" stroke="#3b82f6" stroke-width="2.2"/><circle cx="16" cy="16" r="4.2" fill="#22d3ee"/></svg>
				<span class="wordmark">Cognicore<small>Technologies</small></span>
			</div>
			<p class="foot-tag">Software and hardware, delivered as one complete solution.</p>
		</div>
		<div>
			<h4>Explore</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'foot-menu', 'depth' => 1, 'fallback_cb' => false ) ); ?>
		</div>
		<div>
			<h4>Visit us</h4>
			<address>
				<strong><?php echo esc_html( COGNICORE_COMPANY ); ?></strong><br>
				<?php echo implode( '<br>', array_map( 'esc_html', cognicore_address_lines() ) ); ?>
			</address>
			<a class="link-arrow" href="<?php echo esc_url( cognicore_maps_url() ); ?>" target="_blank" rel="noopener">Open in Maps <?php echo cognicore_icon( 'arrow' ); ?></a>
		</div>
	</div>
	<div class="container foot-base">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( COGNICORE_COMPANY ); ?>. All rights reserved.</span>
		<a href="#top">Back to top &uarr;</a>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
