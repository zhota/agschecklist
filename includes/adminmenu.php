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

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

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
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['notadodesigner-topo'] ) )
            $new_input['notadodesigner-topo'] = sanitize_text_field( $input['notadodesigner-topo'] );

        if( isset( $input['informacoesdodesigner-topo'] ) )
            $new_input['informacoesdodesigner-topo'] = sanitize_text_field( $input['informacoesdodesigner-topo'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Adicione as informações abaixo:';
    }

    /** 
     * Get the settings option array and print one of its values
     */


    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
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

}

