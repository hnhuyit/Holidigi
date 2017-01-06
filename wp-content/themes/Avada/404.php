<?php get_header(); ?>
	<div id="content" class="full-width">
		<div id="post-404page">
			<div class="post-content">
				<div class="fusion-clearfix"></div>
				<div class="error-page">
					<div class="fusion-columns fusion-columns-3">
						<div class="fusion-column col-lg-8 col-md-8 col-sm-8 content-error">
							<div class="fusion-column col-lg-12 col-md-12 col-sm-12">
								<?php
									// Render the page titles
									$subtitle =  __( 'Oops, This Page Could Not Be Found!', 'Avada' );
									echo Avada()->template->title_template( $subtitle );
								?>
							</div>
							<div class="fusion-column col-lg-6 col-md-6 col-sm-6">
								<div class="error-message">404</div>
							</div>
							<div class="search col-lg-6 col-md-6 col-sm-6">
								<h3><?php _e( 'Search Our Website', 'Avada' ); ?></h3>
								<p><?php _e( 'Can\'t find what you need? Take a moment and do a search below!', 'Avada' ); ?></p>
								<div class="search-page-search-form">
									<?php echo get_search_form( false ); ?>
								</div>	
							</div>			
						</div>	
						<div style="float: right; padding-left: 80px; padding-bottom: 10px	" class="fusion-column col-lg-4 col-md-4 col-sm-4 useful-links">
							<?php //dynamic_sidebar('404'); ?>
							<div class="contact-form blog">
								<div class="contact-form slider">
									<div class="contact-form">
										<?php echo do_shortcode('[contact-form-7 id="32" title="form-slider"]'); ?>
									</div>
								</div>
							</div>
							
						</div>

						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
