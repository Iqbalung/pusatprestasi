<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\REPEATER;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for test.
 *
 * @since 1.0.0
 */
class Gallery_Filter extends Widget_Base {
    use \EduVibe_Core\Traits\Grid;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'eduvibe-gallery-filter';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Filterable Gallery', 'eduvibe-core' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eduvibe-elementor-icon eicon-testimonial-carousel';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
    	return [ 'jquery-fancybox', 'jquery-isotope' ];
    }

    /**
     * Get style dependencies.
     *
     * Retrieve the list of style dependencies the element requires.
     *
     * @since 1.9.0
     * @access public
     *
     * @return array Element styles dependencies.
     */
    public function get_style_depends() {
        return [ 'jquery-fancybox' ];
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'eduvibe_elementor_widgets' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'eduvibe', 'gallery', 'filter', 'filterable', 'isotope', 'masonry', 'portfolio' ];
    }

    protected $desktop_default_grid = 3;
    protected $tablet_default_grid  = 2;
    protected $mobile_default_grid  = 1;
    protected $default_display_type = 'grid';

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'section_gallery_filter',
            [
                'label' => __( 'Gallery Filter Items', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'container_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( '<strong>The Filtering might not work on the Elementor Editor Page. But, it\'ll definitely work on the FrontEnd of your site.</strong>', 'eduvibe-core' ),
                'content_classes' => 'eduvibe-elementor-widget-alert elementor-panel-alert elementor-panel-alert-info'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'title',
			[
                'label'       => __( 'Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Education', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
			'control',
			[
                'label'       => __( 'Control Name', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __( '<b>Comma separated gallery controls. Example: Technology, Education</b>', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
			'image',
			[
                'label'       => __( 'Image', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $repeater->add_control(
			'big_image',
			[
                'label'       => __( 'Big Image(PopUp)', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'specific_image_size',
            [
                'label'        => __( 'Specific Image Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
				'condition' => [
					'image[url]!' => ''
				]
            ]
        );

        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'each_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'image[url]!'         => '',
					'specific_image_size' => 'yes'
				]
			]
		);

        $this->add_control(
            'items',
            [
                'type'       => Controls_Manager::REPEATER,
                'fields'     => $repeater->get_controls(),
                'seperator'  => 'before',
                'title_field' => '{{title}}',
                'default' => [
                    ['control' => 'Design, Branding'],
                    ['control' => 'Interior'],
                    ['control' => 'Development'],
                    ['control' => 'Design, Interior'],
                    ['control' => 'Branding, Development'],
                    ['control' => 'Design, Development']
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_gallery_filter',
            [
                'label' => __( 'Settings', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'enable_controls',
            [
                'label'        => __( 'Controls', 'eduvibe-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'all_items_text',
            [
                'label'     => __( 'Text for All Item', 'eduvibe-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'All', 'eduvibe-core' ),
                'condition' => [
                    'enable_controls' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'enable_icon',
            [
                'label'        => __( 'Icon', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'enable_title',
            [
                'label'        => __( 'Title', 'eduvibe-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'image_size',
                'default' => 'medium_large'
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'PopUp Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'icon-zoom-in-line',
                    'library' => 'eduvibe-custom-icons'
                ],
                'condition'   => [
                    'enable_icon' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->settings();

        $this->start_controls_section(
            'control_style',
            [
                'label'     => __( 'Control', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'control_alignment',
            [
                'label'          => __( 'Control Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-gallery-filter-control' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'control_margin',
            [
                'label'        => __( 'Margin', 'eduvibe-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', 'em', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-gallery-filter-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );  

        $this->end_controls_section();
    }

    private function render_editor_script() { ?>
        <script type="text/javascript">
            ( function($) {
                if ( $.isFunction( $.fn.isotope ) ) {
                    $( '.eduvibe-gallery-filter' ).each( function() {
                        let container  = $( this ).find( '.eduvibe-gallery-items-wrapper' ),
                        galleryID = '#' + $( this ).attr( 'id' );
                        container.isotope( {
                            filter: '*',
                            animationOptions: {
                                queue: true
                            }
                        } );

                        $( galleryID + ' .eduvibe-gallery-filter-control button' ).click(function(){
                            $( galleryID + ' .eduvibe-gallery-filter-control button.current' ).removeClass( 'current' );
                            $( this ).addClass( 'current' );
                     
                            let selector = $( this ).attr( 'data-filter' );
                            container.isotope( {
                                filter: selector,
                                animationOptions: {
                                    queue: true
                                }
                            } )
                            return false
                        } );
                    } );
                }
            } )( jQuery );
        </script>
    <?php
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $items    = $settings['items'];
        $grid_desktop_column = 12/$settings['desktop_grid_columns'];
		$grid_tablet_column  = 12/$settings['tablet_grid_columns'];
		$grid_mobile_column  = 12/$settings['mobile_grid_columns'];
		$grid_column         = 'eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );

        $this->add_render_attribute( 'container', 'class', 'eduvibe-gallery-filter' );
        $this->add_render_attribute( 'container', 'id', 'eduvibe-gallery-filter-id-' . esc_attr( $this->get_id() ) );

        $this->add_render_attribute( 'gallery', 'class', 'eduvibe-gallery-items-wrapper' );
        $this->add_render_attribute( 'gallery', 'id', 'eduvibe-gallery-images-wrapper-id-' . esc_attr( $this->get_id() ) );

        if ( is_array( $items ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                echo '<div class="eduvibe-gallery-filter-container">';
                    if( 'yes' === $settings['enable_controls'] ): 
                        echo '<div class="eduvibe-gallery-filter-control">';
                            if( ! empty( $settings['all_items_text'] ) ) :
                                echo '<button data-filter="*" class="filter-item current">' . esc_html( $settings['all_items_text'] ) . '</button>';
                            endif;
                            $all_controls             = array_column( $items, 'control' );
                            $controls_comma_separated = implode( ', ', $all_controls );
                            $controls_array           = explode( ',',$controls_comma_separated );
                            $controls_lowercase       = array_map( 'strtolower', $controls_array );
                            $controls_remove_space    = array_filter( array_map( 'trim', $controls_lowercase ) );
                            $controls                 = array_unique( $controls_remove_space );

                            foreach( $controls as $control ) :
                                $control_attr = preg_replace( '#[ -]+#', '-', $control );
                                echo '<button class="filter-item" data-filter=".' . esc_attr( $control_attr ) . '">' . esc_html( $control ) . '</button>';
                            endforeach;
                        echo '</div>';
                    endif;

                    echo '<div ' . $this->get_render_attribute_string( 'gallery' ) . '>';
                        foreach( $items as $key => $item ) :
                            $link_key                        = 'link_' . $key; 
                            $gallery_controls                = $item['control'];
                            $gallery_controls_to_array       = explode( ',', $gallery_controls );
                            $gallery_controls_to_lowercase   = array_map( 'strtolower', $gallery_controls_to_array );
                            $gallery_controls_remove_space   = array_filter( array_map( 'trim', $gallery_controls_to_lowercase ) );
                            $gallery_controls_space_replaced = array_map( function($val) { return str_replace( ' ', '-', $val ); }, $gallery_controls_remove_space );
                            $gallery_final_controls          = implode ( " ", $gallery_controls_space_replaced );
                            $image                           = $item['image'];

                            $this->add_render_attribute(
                                $link_key,
                                [
                                    'class' => [
                                        'eduvibe-gallery-filter-single-item',
                                        'elementor-repeater-item-'. esc_attr( $item['_id'] ),
                                        $grid_column,
                                        $gallery_final_controls
                                    ]
                                ]
                            );

                            echo '<div ' . $this->get_render_attribute_string( $link_key ) . '>';
                                if ( 'yes' === $item['specific_image_size'] ) :
                                    $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'each_image_size', $item );
                                else :
                                    $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'image_size', $settings );
                                endif;
                                if ( empty( $image_src_url ) ) :
                                    $image_url = $image['url'];
                                else :
                                    $image_url = $image_src_url;
                                endif;

                                if ( ! empty( $item['big_image']['url'] ) ) :
                                    $big_image_src = wp_get_attachment_image_src( $item['big_image']['id'], 'full' );
                                    $big_image_src = $big_image_src[0];
                                else :
                                    $big_image_src = $image_src_url;
                                endif;

                                echo '<a data-fancybox href="' . esc_url( $big_image_src ) . '" class="edu-gallery-grid-item">';
                                    echo '<div class="edu-gallery-grid">';
                                        echo '<div class="inner">';
                                            echo '<div class="thumbnail">';
                                                echo '<img class="w-100" src="' . esc_url( $image_url ) . '" />';
                                            echo '</div>';
                                        echo '</div>';

                                        if ( $settings['enable_icon'] === 'yes' ) :
                                            echo '<div class="zoom-icon">';
                                                Icons_Manager::render_icon( $settings['icon'] );
                                            echo '</div>';
                                        endif;
                                        echo '<div class="hover-action">';
                                            echo '<div class="hover-content">';
                                                if ( 'yes' === $settings['enable_title'] && $item['title'] ) :
                                                    echo '<div class="hover-text">';
                                                        echo '<h6 class="title">' . esc_html( $item['title']). '</h6>';
                                                    echo '</div>';
                                                endif;
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        endforeach;
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        endif;

        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) :
            // $this->render_editor_script();
        endif;
    }

}