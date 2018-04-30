<?php
namespace AgenciaDoSiteChecklist;



class checkList{
	public function __construct(){
		add_action('init',[$this, 'testeEcho']);	
	}

	public function testeEcho(){
		echo "teste-checklist";
	}
}

