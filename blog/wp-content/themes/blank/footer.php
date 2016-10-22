    </div><!-- #main -->
<div class="footer-v1">
			<div class="footer">
				<div class="container">
					<div class="row">
						<!-- About -->
						<div class="col-md-3 md-margin-bottom-40">
							<div id="footer-sidebar-1" class="posts">
								<?php
									if(is_active_sidebar('footer-sidebar-1')){
									dynamic_sidebar('footer-sidebar-1');
									}
								?>
							</div>
						</div><!--/col-md-3-->
						
						<div class="col-md-3 md-margin-bottom-40">
							<div id="footer-sidebar-2" class="posts">
								<?php
								if(is_active_sidebar('footer-sidebar-2')){
								dynamic_sidebar('footer-sidebar-2');
								}
								?>
							</div>
						</div><!--/col-md-3-->
				
						<div class="col-md-3 md-margin-bottom-40" class="posts">
							<div id="footer-sidebar-3" class="posts">
								<?php
								if(is_active_sidebar('footer-sidebar-3')){
								dynamic_sidebar('footer-sidebar-3');
								}
								?>
						</div>
						</div><!--/col-md-3-->
	
						<div class="col-md-3 map-img md-margin-bottom-40">
							<div id="footer-sidebar-4" class="posts">
								<?php
								if(is_active_sidebar('footer-sidebar-4')){
								dynamic_sidebar('footer-sidebar-4');
								}
								?>
						</div>
						</div><!--/col-md-3-->
						
					</div>
				</div>
			</div><!--/footer-->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<p>
								2015 &copy; All Rights Reserved.
								<a href="<?php echo get_site_url(); ?>">Privacy Policy</a> | <a href="<?php echo get_site_url(); ?>">Terms of Service</a>
							</p>
						</div>

						<!-- Social Links -->
						<div class="col-md-6">
							<ul class="footer-socials list-inline">
								<li>
									<a data-original-title="Facebook" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Skype" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-skype"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Google Plus" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-google-plus"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Linkedin" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Pinterest" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-pinterest"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Twitter" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a data-original-title="Dribbble" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#">
										<i class="fa fa-dribbble"></i>
									</a>
								</li>
							</ul>
						</div>
						<!-- End Social Links -->
					</div>
				</div>
			</div><!--/copyright-->
		</div>
<?php wp_footer(); ?>
</body>
</html>