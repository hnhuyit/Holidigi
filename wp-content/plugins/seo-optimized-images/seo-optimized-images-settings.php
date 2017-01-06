<?php 
$default_options_data = array (
    
    
    'soi_alt_value' => '%name %title',
	'soi_title_value' => '',
	'soi_override_alt_value' => '1',
	'soi_override_title_value' => '1',
  
	); 
        
      // If there is no option setting in DB then assign default data to soi option array..
      
        
   $soi_options_array = wp_parse_args(get_option('soi_options_values'), $default_options_data);
  // print_r($soi_options_array);
   
   
   
if(isset($_POST['submit_general_settings_tab'])){

  
	
	$soi_options_array['soi_alt_value'] = esc_attr($_POST['soi_alt_value']);
	$soi_options_array['soi_title_value'] = esc_attr($_POST['soi_title_value']);
	$soi_options_array['soi_override_alt_value'] = esc_attr($_POST['soi_override_alt_value']);
	$soi_options_array['soi_override_title_value'] = esc_attr($_POST['soi_override_title_value']);
	update_option ('soi_options_values', $soi_options_array );
	
}

	


?>

<div class="wrap settings-wrap" id="page-settings">
    <h2>Settings</h2>
    <div id="option-tree-header-wrap">
        <ul id="option-tree-header">
            <li id=""><a href="" target="_blank"></a>
            </li>
            <li id="option-tree-version"><span>SEO Optimized Images</span>
            </li>
        </ul>
    </div>
    <div id="option-tree-settings-api">
    <div id="option-tree-sub-header"></div>
        <div class = "ui-tabs ui-widget ui-widget-content ui-corner-all">
           
          <!-- Tabs Begin-->
            <ul >
                <li id="tab_create_setting"><a href="#section_general">General Settings</a>
                </li>
                
			<!--
                <li id="tab_shortcode_atts" ><a href="#shortcode_atts">Shortcode Attributes</a>
                </li>
               <li id="tab_layouts" ><a href="#section_roadmap">RoadMap</a>
                </li> -->
                
                <li id="tab_faq" ><a href="#section_faq">FAQ</a>
                </li>
                <li id="tab_support" ><a href="#section_support">Support</a>
                </li>
               
               <!--
                <li id="tab_support" ><a href="#get_beta_version">Get the Premium Version</a>
                </li>
                -->
            </ul>
            <!-- Tabs End-->
            
            
    <div id="poststuff" class="metabox-holder">
        <div id="post-body">
			<div id="post-body-content">
                <div id="section_general" class = "postbox">
                    <div class="inside">
                        <div id="setting_theme_options_ui_text" class="format-settings">
                            <div class="format-setting-wrap">
                    
    <div class = "format-setting type-textarea has-desc">
        <div class = "format-setting-inner">            
    <form method="post" action="#section_general">
	<div class="format-setting-label">
		<h3 class="label">General Settings</h3>
	</div>
					
    <table class="form-table table_custom">
        
       
        
        <tr valign="top">
        <th scope="row"><?php _e('Alt Attribute Value','seoimages');?></th>
        <td><input type="text" name="soi_alt_value" value="<?php echo esc_attr( $soi_options_array['soi_alt_value'] ); ?>" />
        <p class=""><?php _e('The Alt attributes will be dynamically replaced by the above value.', 'seoimages') ?></p>
     <p class="">    
             %name - It will insert Image Name.<br> %title- It will insert Post Title.<br>
             %category - It will insert Post Categories.
         </p>
        </td>
        </tr>
        
         <tr valign="top">
        <th scope="row"><?php _e('Override Existing Alt Tag','seoimages');?></th>
        <td><select id="soi_override_alt_value" name="soi_override_alt_value">
		<?php $override_setting = array(
		'1'=>'YES',
		'0'=>'NO'); ?>
		<?php foreach($override_setting as $key => $value) { ?>
		<option value="<?php echo $key; ?>" <?php if ($soi_options_array['soi_override_alt_value']==$key) { echo 'selected="selected"'; } ?>  >
		<?php _e($value,'seoimages') ?> </option>
		<?php } ?>
		</select>
		<p class=""><?php _e('Do you want to Over Ride existing alt tags?','seoimages') ?></p>
        </td>
        </tr>
        
       
        
         <tr valign="top">
        <th scope="row"><?php _e('Title Attribute Value','seoimages');?></th>
        <td><input type="text" name="soi_title_value" value="<?php echo esc_attr( $soi_options_array['soi_title_value'] ); ?>" />
        <p class=""><?php _e('The Title attribute will be dynamically replaced by the above value.', 'seoimages') ?></p>
        
        </td>
        </tr> 
    
       <tr valign="top">
        <th scope="row"><?php _e('Override Existing Title Tag','seoimages');?></th>
        <td><select id="soi_override_title_value" name="soi_override_title_value">
		<?php $override_setting = array(
		'1'=>'YES',
		'0'=>'NO'); ?>
		<?php foreach($override_setting as $key => $value) { ?>
		<option value="<?php echo $key; ?>" <?php if ($soi_options_array['soi_override_title_value']==$key) { echo 'selected="selected"'; } ?>  >
		<?php _e($value,'seoimages') ?> </option>
		<?php } ?>
		</select>
		<p class=""><?php _e('Do you want to Over Ride existing title tags?','seoimages') ?></p>
        </td>
        </tr>
		
		
		</table>
		
		<table class="form-table ">  
		<tr valign="top">
        <td><input type="submit" name="submit_general_settings_tab" value="save changes" class="button button-primary"></td>
        </tr>
		</table>
		
			
			</form>
                                        
					</div>
				</div>
			</div>
         </div>
        </div>
    </div>
    
            
    <div id="section_faq" class = "postbox">
        <div class="inside">
            <div class="format-settings">
                <div class="format-setting-wrap">
                    <div class="format-setting-label">
                    <h3 class="label">How Does it Work? </h3>
                    </div>
                </div>
            </div>
                                
        <p><span class="description">1. The plugin dynamically replaces the alt tags with the pattern specified by you. It makes no changes to the database.   </span></p>
        <p><span class="description">2. Since there are no changes to the database, one can have different alt tags for same images on different pages / posts.</span></p>
        <p><span class="description">3. %name - It will insert Image Name.</span></p>
        <p><span class="description">4. %title- It will insert Post Title.</span></p>
        <p><span class="description">5. %category - It will insert Post Categories.  </span></p>                
				</div>
				
				  <div class="inside">
            <div class="format-settings">
                <div class="format-setting-wrap">
                    <div class="format-setting-label">
                    <h3 class="label"> Why Optimize Alt Tags </h3>
                    </div>
                </div>
            </div>
                                
        <p><span class="description">1. According to <a target = "_blank" href = "http://googlewebmastercentral.blogspot.in/2007/12/using-alt-attributes-smartly.html">this post </a> on the Google Webmaster Blog, Google tends to focus on the information in the ALT text. Creating a optimized alt tags can bring more traffic from Search Engines </span></p>
        <p><span class="description">2. Take note that the plugin does not makes changes to the database. It dynamically replaces the tags at the times of page load.</span></p>
                      
				</div>
				
				
	</div>
	
	
	  <div id="section_support" class = "postbox">
        <div class="inside">
            <div class="format-settings">
                <div class="format-setting-wrap">
                    <div class="format-setting-label">
                    <h3 class="label">Support </h3>
                    </div>
                </div>
            </div>
                                
        <p><span class="description">1. For any queries contact us via the <a href = "" target = "_blank">support forums.</a></span></p>
        
                      
				</div>
	</div>

	
        </div>
    </div>
    </div>
        <div class="clear"></div>
        </div>
    </div>
</div>
