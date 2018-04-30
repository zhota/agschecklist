<?php
namespace AgenciaDoSiteChecklist;

if(!defined ('ABSPATH'))exit;

class Plugin {
	public $checklist;
	public $template;
	public $shortcode;
	public $widget;
	public $loop;

	public function __construct() {
		$this->includes();
		$this->init_components();
	}

	private function includes(){
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/checklist.php');
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/views/template.php');
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/shortcode');
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/widget.php');
		include(AGSCHECKLIST__PLUGIN_DIR.'indludes/loop');
	}

	private function init_components(){
		$this->checklist = New Checklist();
		//$this->shortcode = New Shortcode();
		//$this->template = New Template();
		//$this->widget = New Widget();
		//$this->lista_checklist = New WidgetLoop();

	}

}

new Plugin();


