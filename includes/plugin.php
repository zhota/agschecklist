<?php
namespace AgenciaDoSiteChecklist;

if(!defined ('ABSPATH'))exit;

class Plugin {
	public $checklist;
	public $template;
	public $loop;
	public $adminMenu;
	public $checklistSettings;
	public $teste;

	public function __construct() {
		$this->includes();
		$this->init_components();
	}

	private function includes(){
		//include(AGSCHECKLIST__PLUGIN_DIR.'includes/checklist.php');
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/views/template.php');
		//include(AGSCHECKLIST__PLUGIN_DIR.'indludes/loop.php');
		include(AGSCHECKLIST__PLUGIN_DIR.'includes/adminmenu.php');
		//include(AGSCHECKLIST__PLUGIN_DIR.'includes/agschecklist-settings.php');

		//Teste

		//include(AGSCHECKLIST__PLUGIN_DIR.'includes/options.php');


	}

	private function init_components(){
		//$this->checklist = New Checklist();
		$this->template = New Template();
		//$this->lista_checklist = New WidgetLoop();
		$this->adminMenu = New MySettingsPage();
		//$this->checklistSettings = New ChecklistSettings();

	}

}

new Plugin();


