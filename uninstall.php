<?php  
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )  
   exit();  

function jl_contact__uninstall(){  
  global $wpdb;   
  
  $table_name = $wpdb->prefix.'jl_contact';   
  
  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){  
       $sql = "DROP TABLE `$table_name`";   
       $wpdb->query($sql);  
  }   
}
gmap_uninstall();