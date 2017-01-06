

<?php if(get_option('contentfu_master_key_active' )) { ?>
	<div id="wpbody-content" aria-label="Main content" tabindex="0">
		<div class="wrap">
			<form method="post" action="http://app.publishvault.com/settings/<?php echo get_option('contentfu_master_key' ); ?>/wp-disconnect/<?php echo base64_encode(get_site_url()); ?>" >
				<input type="submit" value="Disconnect" class="button">
			</form>
		</div>
	</div>
<?php } else { ?>
	<div id="wpbody-content" aria-label="Main content" tabindex="0">
		<div class="wrap">
			<form method="post" action="http://app.publishvault.com/wp-login" >
				<input type="hidden" name="wp_page_id" value="<?php echo get_option('publishvault_page_id' ); ?>">
				<input type="hidden" name="secret_key" value="<?php echo get_option('contentfu_master_key' ); ?>">
				<input type="hidden" name="domain_name" value="<?php echo get_site_url(); ?>">
				<input type="hidden" name="wp_callback_url" value="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=publishvault&status=success&secret-key=<?php echo get_option('contentfu_master_key' ); ?>">
				<input type="submit" value="Connect" class="button button-primary">
			</form>
		</div>
	</div>
<?php } ?>
