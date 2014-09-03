<?php
/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', '80cpmgmo9pspi70ck31cwaapn47s7f6dh' );

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/
$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php'			// Theme installation
				);
// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
foreach ( $includes as $i ) {
	locate_template( $i, true );
}
if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}
/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'add_jquery' );
add_action( 'wp_footer', '' );

register_sidebar(array(
'name'=> 'My Custom Widget Area',
'id' => 'custom'
));

function add_jquery()
{
	wp_enqueue_script( 'jquery' );
}

function touchMenu()
{
?>
<script type="text/javascript">
$jQuery(function()
{
    var menuActive = false,
        touched = false,
        $nav = $('.nav');

    function removeActive(callback)
    {
        $nav.find('.MenuActive').removeClass('MenuActive');
        callback();
    }

    function newActive($this,menu)
    {
        removeActive(function(){
            $this.next().addClass('MenuActive').queue(function(){
                if(menu){
                    menuActive = true;
                    touched = false;
                } else {
                    touched = true;
                }
            }).dequeue();
        });   
    }

    $nav.on({
        touchstart:function(e){            
            e.stopPropagation();
            newActive($(this),touched);
        },
        mouseenter:function(){
            newActive($(this),true);  
        },
        click:function(e){
            e.preventDefault();

            if(menuActive){
                $(this).trigger('trueClick',e.target);
            }
        },
        trueClick:function(e,$target){
            $(this).parents('.nav').trigger('mouseleave');
            window.location.href = $target;
        }
    },'li .has_children').on('mouseleave',function(){
        removeActive(function(){
            menuActive = false;
            touched = false;
        });
    });

    $('html').on('touchstart',function(e)
    {
    	if(menuActive)
    	{
        $nav.trigger('mouseleave');
    	}
    });
});
</script>
<?php 
}
/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>