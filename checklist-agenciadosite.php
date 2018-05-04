<?php
   /*
   Plugin Name: Checklist Agência do Site
   Plugin URI: https://www.agenciadosite.com.br
   description: Um checklist para auxiliar o desenvolvimento do site
   Version: 0.1
   Author: Pablo Coutinho
   Author URI: https://twitter.com/pablocoutinho19
   License: GPL2
   */

   if(!defined('ABSPATH'))exit;



   //Plugin control
   define('AGSCHECKLIST_VERSION','0.1');
   define('AGSCHECKLIST__FILE__',__FILE__);
   define('AGSCHECKLIST_URL',plugins_url('/', AGSCHECKLIST__FILE__));
   define('AGSCHECKLIST__PLUGIN_DIR',plugin_dir_path(__FILE__));
   define('AGSCHECKLIST_ASSETS_URL',AGSCHECKLIST_URL.'assets/');
   register_activation_hook(__FILE__, array('Checklist Agência do Site','plugin_activation'));
   register_deactivation_hook(__FILE__, array('Checklist Agência do Site','plugin_deactivation'));

   


   //Actions  
   require_once(AGSCHECKLIST__PLUGIN_DIR.'/includes/plugin.php');
   

   //Template
   // require_once(CHECKLIST_AGENCIADOSITE__PLUGIN_DIR.'/inclusdes/views/');
