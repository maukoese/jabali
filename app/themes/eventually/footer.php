<?php
/**
* @package Eventually 
**/ ?>
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<?php $social = getOption( 'social' ); ?>
					<li><a href="<?php echo( $social['facebook']); ?>" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="<?php echo( $social['twitter']); ?>" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="<?php echo( $social['instagram']); ?>" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="<?php echo( $social['github']); ?>" class="icon fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="mailto:<?php showOption( 'email' ); ?>" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					<li><a href="tel:<?php showOption( 'phone' ); ?>" class="icon fa-phone"><span class="label">Phone</span></a></li>
				</ul>
				<ul class="copyright">
					<li><?php showOption( 'copyright' ); ?> - <a class="" href="<?php showOption( 'attribution_link' ); ?>"><?php showOption( 'attribution' ); ?></a></li>
				</ul>
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="<?php echo _THEMES; ?>eventually/assets/js/main.js"></script>

	</body>
</html>