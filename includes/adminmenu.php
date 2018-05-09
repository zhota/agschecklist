<?php
namespace AgenciaDoSiteChecklist;

if(!defined ('ABSPATH'))exit;

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'My Settings', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>Configurações</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Informações sobre o Topo', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        // add_settings_field(
        //     'id_number', // ID
        //     'ID Number', // Title 
        //     array( $this, 'id_number_callback' ), // Callback
        //     'my-setting-admin', // Page
        //     'setting_section_id' // Section           
        // );      

        add_settings_field(
            'notadodesigner-topo', 
            'TOPO(Header) - Nota do Designer:', 
            array( $this, 'notadodesign_topo_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );      

        add_settings_field(
            'informacoesdodesigner-topo', 
            'TOPO(Header) - Informações do Designer:', 
            array( $this, 'informacoesdodesigner_topo_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );   

        add_settings_section(
        	'setting_section_footer_id',
        	'Informações sobre o Rodapé',
        	array( $this, 'print_section_footer'),
        	'my-setting-admin'

        );

        add_settings_field(
        	'notadodesigner-rodape',
        	'Rodapé(Footer) - Nota do Designer:',
        	array( $this, 'notadodesigner_rodape_callback'),
        	'my-setting-admin',
        	'setting_section_footer_id'
    	);

        add_settings_field(
        	'informacoesdodesigner-rodape',
        	'Rodapé(Footer) - Informações do Designer:',
        	array( $this, 'informacoesdodesigner_rodape_callback'),
        	'my-setting-admin',
        	'setting_section_footer_id'
    	);

    	add_settings_section(
    		'setting_section_content_id',
    		'Informações sobre o conteúdo',
    		array( $this, 'print_section_content'),
    		'my-setting-admin'
		);

/*
		add_settings_field(
			'nomedapagina-conteudo',
			'Definir o nome da página:',
			array( $this, 'nomedapagina_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);

		add_settings_field(
			'notadodesigner-conteudo',
			'Conteúdo - Nota do Designer:',
			array( $this, 'notadodesigner_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);

		add_settings_field(
			'informacoesdodesigner-conteudo',
			'Conteudo - Informações do Conteúdo:',
			array( $this, 'informacoesdodesigner_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);
*/		
		//$this->repeatableStructure();

		$this->repeatableStructure($array);
    }

    public function generateNewContent(){
    	$data = array();

    	foreach ($data as $row => $value) {
    		$this->repeatableStructure($row);
    	}
    }

    public function repeatableStructure($array){
		add_settings_field(
			'nomedapagina-conteudo',
			'Definir o nome da página:',
			array( $this, 'nomedapagina_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);
		add_settings_field(
			'informacoesdodesigner-conteudo',
			'Informações do conteúdo:',
			array( $this, 'informacoesdodesigner_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);
		add_settings_field(
			'notadodesigner-conteudo',
			'Nota do Designer:',
			array( $this, 'notadodesigner_conteudo_callback'),
			'my-setting-admin',
			'setting_section_content_id'
		);
    }

    public function addMorePageButton(){
    	?>
			<p><input type="button" value="Adicionar nova Página" onclick=""></p>
    	<?php
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        // if( isset( $input['id_number'] ) )
        //     $new_input['id_number'] = absint( $input['id_number'] );

        //HEADER SANITIZE
        if( isset( $input['notadodesigner-topo'] ) )
            $new_input['notadodesigner-topo'] = sanitize_text_field( $input['notadodesigner-topo'] );

        if( isset( $input['informacoesdodesigner-topo'] ) )
            $new_input['informacoesdodesigner-topo'] = sanitize_text_field( $input['informacoesdodesigner-topo'] );

        //FOOTER SANITIZE

		if( isset( $input['notadodesigner-rodape'] ) )
        	$new_input['notadodesigner-rodape'] = sanitize_text_field( $input['notadodesigner-rodape'] );

        if( isset( $input['informacoesdodesigner-rodape'] ) )
        	$new_input['informacoesdodesigner-rodape'] = sanitize_text_field( $input['informacoesdodesigner-rodape'] );
       
        //CONTENT SANITIZE

        if( isset( $input['nomedapagina-conteudo'] ) )
        	$new_input['nomedapagina-conteudo'] = sanitize_text_field( $input['nomedapagina-conteudo'] );

        if( isset ( $input['notadodesigner-conteudo'] ) )
        	$new_input['notadodesigner-conteudo'] = sanitize_text_field( $input['notadodesigner-conteudo'] );

        if( isset( $input['informacoesdodesigner-conteudo'] ) )
        	$new_input['informacoesdodesigner-conteudo'] = sanitize_text_field( $input['informacoesdodesigner-conteudo'] );

        $clean = '';
        if( is_array( $input ) )
        	$clean = array_map('sanitize_text_field', $input);
        return $clean;

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Adicione as informações referente ao Topo(Header) abaixo:';
    }

    public function print_section_footer()
    {
    	print 'Adicione as informações referentes ao Rodapé(Footer) abaixo:';
    }

    public function print_section_content(){
    	print 'Adicione as informações referentes ao Conteúdo abaixo:';
    }

    /** 
     * Get the settings option array and print one of its values
     */


    // public function id_number_callback()
    // {
    //     printf(
    //         '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
    //         isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
    //     );
    // }

    /** 
     * Get the settings option array and print one of its values
     */

//CALLBACKS DO HEADER - INICIO

    public function notadodesign_topo_callback()
    {
        printf(
            '<input type="text" id="notadodesigner-topo" name="my_option_name[notadodesigner-topo]" value="%s" />',
            isset( $this->options['notadodesigner-topo'] ) ? esc_attr( $this->options['notadodesigner-topo']) : ''
        );


    }

    public function informacoesdodesigner_topo_callback(){
        ?> 
        	<select name="my_option_name[informacoesdodesigner-topo]" id="informacoesdodesigner-topo">
        		<?php $selected = (isset( $this->options['informacoesdodesigner-topo'] ) && $this->options['informacoesdodesigner-topo'] === 'Não iniciado') ? 'selected' : '' ; ?>
	            <option value="Não iniciado" <?php echo $selected; ?>>Não iniciado</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-topo'] ) && $this->options['informacoesdodesigner-topo'] === 'Em desenvolvimento') ? 'selected' : '' ; ?>
	            <option value="Em Desenvolvimento" <?php echo $selected; ?>>Em desenvolvimento</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-topo'] ) && $this->options['informacoesdodesigner-topo'] === 'Finalizado') ? 'selected' : '' ; ?>
	            <option value="Finalizado" <?php echo $selected; ?>>Finalizado</option>
       		</select> 
   		<?php
    }

// CALLBACKS DO HEADER - FIM

// CALLBACKS DO FOOTER - INICIO


    public function notadodesigner_rodape_callback()
    {
        printf(
            '<input type="text" id="notadodesigner-rodape" name="my_option_name[notadodesigner-rodape]" value="%s" />',
            isset( $this->options['notadodesigner-rodape'] ) ? esc_attr( $this->options['notadodesigner-rodape']) : ''
        );


    }


    public function informacoesdodesigner_rodape_callback(){
    	?>
        	<select name="my_option_name[informacoesdodesigner-rodape]" id="informacoesdodesigner-rodape">
        		<?php $selected = (isset( $this->options['informacoesdodesigner-rodape'] ) && $this->options['informacoesdodesigner-rodape'] === 'Não iniciado') ? 'selected' : '' ; ?>
	            <option value="Não iniciado" <?php echo $selected; ?>>Não iniciado</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-rodape'] ) && $this->options['informacoesdodesigner-rodape'] === 'Em desenvolvimento') ? 'selected' : '' ; ?>
	            <option value="Em Desenvolvimento" <?php echo $selected; ?>>Em desenvolvimento</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-rodape'] ) && $this->options['informacoesdodesigner-rodape'] === 'Finalizado') ? 'selected' : '' ; ?>
	            <option value="Finalizado" <?php echo $selected; ?>>Finalizado</option>
       		</select> 
    	<?php
    }

// CALLBACKS DO FOOTER - FIM

// CALLBACKS DO CONTEUDO - INICIO

	public function nomedapagina_conteudo_callback(){
		printf(
			'<input type="text" id="nomedapagina-conteudo[]" name="my_option_name[nomedapagina-conteudo[]]" value="%s" />',
			isset( $this->options['nomedapagina-conteudo[]'] ) ? esc_attr( $this->options['nomedapagina-conteudo[]']) : ''
		);
	}

	public function notadodesigner_conteudo_callback(){
		printf(
			'<input type="text" id="notadodesigner-conteudo" name="my_option_name[notadodesigner-conteudo]" value="%s" />',
			isset( $this->options['notadodesigner-conteudo'] ) ? esc_attr( $this->options['notadodesigner-conteudo']) : ''
		);
	}


	public function informacoesdodesigner_conteudo_callback(){
		?>
			<select name="my_option_name[informacoesdodesigner-conteudo]" id="informacoesdodesigner-conteudo">
		<?php $selected = (isset( $this->options['informacoesdodesigner-conteudo'] ) && $this->options['informacoesdodesigner-conteudo'] === 'Não iniciado') ? 'selected' : '' ; ?>
	            <option value="Não iniciado" <?php echo $selected; ?>>Não iniciado</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-conteudo'] ) && $this->options['informacoesdodesigner-conteudo'] === 'Em desenvolvimento') ? 'selected' : '' ; ?>
	            <option value="Em Desenvolvimento" <?php echo $selected; ?>>Em desenvolvimento</option>
	            <?php $selected = (isset( $this->options['informacoesdodesigner-conteudo'] ) && $this->options['informacoesdodesigner-conteudo'] === 'Finalizado') ? 'selected' : '' ; ?>
	            <option value="Finalizado" <?php echo $selected; ?>>Finalizado</option>
       		</select> 
    	<?php
	}
// CALLBACKS DO CONTEUDO - FIM

}


