<div class="clear"></div>
<div class="alm-drop-btn alm-layout-selection">
   <a href="javascript:void(0);" class="target"><i class="fa fa-chevron-circle-down"></i> <?php _e('Apply Layout', 'ajax-load-more'); ?></a>
	<div class="alm-dropdown">
	   <div class="alm-drop-inner">
   	   <ul>
   	      <li>
   	         <a href="javascript:void(0);" class="layout" data-type="default"><i class="fa fa-picture-o"></i>  
	   	         <?php _e('Default', 'ajax-load-more'); ?>
	   	      </a>
   	      </li>
   	      <?php if (has_action('alm_layouts_installed')){       	      
      	      do_action('alm_get_layouts_add_on');
            } else {
               echo '<li><a href="https://connekthq.com/plugins/ajax-load-more/add-ons/layouts/?utm_source=WP%20Admin&utm_medium=Extend&utm_campaign=Layouts" class="add-on" target="_blank">';
               echo '<i class="fa fa-key"></i>';
               _e('Unlock additional layout templates with the <strong>Layouts add-on</strong>', 'ajax-load-more');
               echo '</a></li>';
            }?>
   	      
   	   </ul>
	   </div>
	</div>
</div>