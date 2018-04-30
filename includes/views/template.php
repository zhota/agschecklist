<?php
namespace AgenciaDoSiteChecklist;

if(!defined ('ABSPATH'))exit;


class template{
	public function __construct(){
		add_action('init',[$this, 'createTemplate']);	
		add_action('wp_enqueue_scripts',[$this,'register_archive_scripts']);
	}

	public function register_archive_scripts(){
		wp_enqueue_style( 'template-theme', AGSCHECKLIST_URL. 'assets/css/template.css');	
		wp_enqueue_script( 'template-script', AGSCHECKLIST_URL . 'assets/js/scripts.js', array ( 'jquery' ));
	}

	public function createTemplate(){ ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<div id="agschecklist" class="agschecklist" style="background: url('<?php echo AGSCHECKLIST_URL. 'assets/images/asgchecklist-bg.jpg'?>')">	
		      <input class="ags-hide-n-show" type="button" value="Checkbox" id="toggle">
					<div class="agschecklist-inner">
						<div class="ags-row">
							<div class="ags-login">
								<h1>Olá,</h1>
								<strong>Você é o administrador do site?</strong>
							</div>
						</div>
					</div>
		</div>
	<?php }
}

