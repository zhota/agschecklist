<?php
namespace AgenciaDoSiteChecklist;

if(!defined ('ABSPATH'))exit;

class template{
	
	public function __construct(){
		if(!is_admin()){
			add_action('init',[$this, 'createTemplate']);	
			add_action('wp_enqueue_scripts',[$this,'register_archive_scripts']);
		}
	}

	public function register_archive_scripts(){
		wp_enqueue_style( 'template-theme', AGSCHECKLIST_URL. 'assets/css/template.css');	
		wp_enqueue_script( 'template-script', AGSCHECKLIST_URL . 'assets/js/scripts.js', array ( 'jquery' ));
	}

	public function createTemplate(){ ?>
		<!-- Chamar script -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!-- Limpar HTML dos arquivos php -->
		<div id="agschecklist" class="agschecklist" style="background: url('<?php echo AGSCHECKLIST_URL. 'assets/images/asgchecklist-bg.jpg'?>')">	
		      <input style="background: url('<?php echo AGSCHECKLIST_URL. 'assets/images/ags-toggle-button.png'?>') no-repeat" class="ags-hide-n-show" type="button" id="toggle">
					<div class="agschecklist-inner">
						<div class="ags-row">
<!-- ///////////////////////// APRESENTAÇÃO -- INICIO ////////////////////////						 -->
							<div class="ags-login">
								<h1>Olá,</h1>
								<strong>Você é o administrador do site?</strong>
							</div>
<!-- ///////////////////////// APRESENTAÇÃO -- FIM ////////////////////////						 -->

<!-- ///////////////////////// VIDEO -- INICIO ////////////////////////						 -->
							<div class="ags-video">
								<iframe width="360" height="215" src="https://www.youtube.com/embed/tbrGvt_4q_M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							</div>
<!-- ///////////////////////// VIDEO -- FIM ////////////////////////						 -->

							<div class="ags-desc-text">
								<strong>Abaixo verifique o checklist do seu site e confirme os itens. Caso tenha alguma dúvida, envie uma mensagem através do <a href="#">formulário de contato</a></strong>
							</div>
							
<!-- ///////////////////////// DESIGN -- INICIO ////////////////////////						 -->
							<h1 class="ags-design-title">Design</h1>
							<div class="ags-design">
								<div class="ags-tooltip">?
									<div class="ags-tooltiptext">
										<p>Aqui é uma breve descrição do que é o topo e como avaliar ele.</p>
										<p>Legenda:</p>
										<p class="ags-em-desenvolvimento-leg">Em desenvolvimento</p>
										<p class="ags-aprovado-cliente-leg">Aprovado pelo cliente</p>
										<p class="ags-finalizado-leg">Finalizado pelo designer</p>
										<p class="ags-orcamento-leg">Adicional, solicitar orçamento</p>
									</div>
								</div>
								<div class="ags-design-inner-topo">
									<strong>O topo está pronto?</strong>
									<p>Sim, confirmar</p>
									<a href="#">Não, enviar uma mensagem!</a>
								</div>
								<div class="ags-design-inner-info">
									<strong>Informações do designer:</strong>
									<p><?php $options = get_option('my_option_name', array() );
									echo $options["informacoesdodesigner-topo"];?></p>
									
								</div>
								<div class="ags-design-inner-nota">
									<strong>Nota do designer:</strong>
									<p><?php 
									$options = get_option('my_option_name', array() );
									echo $options["notadodesigner-topo"];
								?></p>
								</div>
							</div>
<!-- ///////////////////////// DESIGN -- FIM ////////////////////////						 -->


						</div>
					</div>
		</div>
	<?php }
}
