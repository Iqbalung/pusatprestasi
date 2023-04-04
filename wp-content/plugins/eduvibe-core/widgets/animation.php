<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for animation.
 *
 * @since 1.0.0
 */
class Animation extends Widget_Base {

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
		return 'eduvibe-animation';
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
		return __( 'Animation', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-animation';
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
        return [ 'jquery-tilt', 'eduvibe-animation' ];
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
		return [ 'eduvibe', '3d', 'effect', 'hover', 'image', 'tilt', 'parallax', 'mouse', 'move', 'tracker', 'scrolling', 'animation', 'vertical', 'horizontal' ];
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
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
	protected function register_controls() {
        $primary_color = eduvibe_get_config( 'primary_color', '#525FE1' );
        
  		$this->start_controls_section(
            'section_animation',
            [
                'label' => __( 'Animation', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'       => __( 'Animation Type', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => 'mouse-track',
                'options'     => [
                    'animated-image'              => __( 'Animated Image', 'eduvibe-core' ),
                    'animated-color'              => __( 'Animated Color', 'eduvibe-core' ),
                    'infinite-animation'          => __( 'Infinite Animation', 'eduvibe-core' ),
                    'infinite-animation-parallax' => __( 'Infinite Animation + Parallax', 'eduvibe-core' ),
                    'mouse-track'                 => __( 'Mouse Track', 'eduvibe-core' ),
                    'parallax'                    => __( 'Parallax', 'eduvibe-core' ),
                    'tilt'                        => __( 'Tilt', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'     => __( 'Content Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'image',
                'options'   => [
                    'image' => __( 'Image', 'eduvibe-core' ),
                    'icon'  => __( 'Icon', 'eduvibe-core' ),
                    'text'  => __( 'Text', 'eduvibe-core' ),
                    'color' => __( 'Color', 'eduvibe-core' )
                ],
                'condition' => [
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'image_type',
            [
                'label'     => __( 'Image Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'custom-image',
                'options'   => [
                    'custom-image'     => __( 'Custom Image', 'eduvibe-core' ),
                    'predefined-image' => __( 'Predefined Image', 'eduvibe-core' )
                ],
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ]
                            ]
                        ],
                        [
                            'name'     => 'animation_type',
                            'operator' => '===',
                            'value'    => 'animated-image'
                        ]
                    ]
                ]
            ]
        );

        $predefined_image = range( 1, 6 );
        $predefined_image = array_combine( $predefined_image, $predefined_image );

        $this->add_control(
            'predefined_image',
            [
                'type'      => Controls_Manager::SELECT,
                'label'     => __( 'Predefined Image', 'eduvibe-core' ),
                'default'   => 'hero-area-2-1.png',
                'options'   => [
                    'hero-area-2-1.png' => 'Image 1',
                    'hero-area-2-2.png' => 'Image 2',
                    'hero-area-2-3.png' => 'Image 3',
                    'hero-area-2-4.png' => 'Image 4',
                    'hero-area-2-5.png' => 'Image 5',
                    'hero-area-2-6.png' => 'Image 6'
                ],
                'condition' => [
                    'image_type'      => 'predefined-image',
                    'animation_type!' => 'animated-color',
                    'content_type'    => 'image',
                ]
            ]
        );

  		$this->add_control(
            'image',
            [
                'label'     => __( 'Image', 'eduvibe-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'image_type',
                                    'operator' => '===',
                                    'value'    => 'custom-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ],
                                [
                                    'name'     => 'image_type',
                                    'operator' => '===',
                                    'value'    => 'custom-image'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'         => 'thumbnail',
                'default'      => 'full',
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'       => __( 'Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'content_type'    => 'icon',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => __( 'Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Your Text', 'eduvibe-core' ),
                'condition'   => [
                    'content_type'    => 'text',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'animated_image_color_type',
            [
                'label'     => __( 'Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'eduvibe-animated-transform-1 8s linear infinite alternate forwards',
                'options'   => [
                    'eduvibe-animated-transform-1 8s linear infinite alternate forwards' => __( 'Type 1', 'eduvibe-core' ),
                    'eduvibe-animated-transform-2 8s ease-in-out infinite'               => __( 'Type 2', 'eduvibe-core' ),
                    'eduvibe-animated-transform-3 8s ease-in-out alternate infinite'     => __( 'Type 3', 'eduvibe-core' ),
                    'eduvibe-animated-transform-4 8s infinite'                           => __( 'Type 4', 'eduvibe-core' ),
                    'eduvibe-animated-transform-5 5s linear infinite'                    => __( 'Type 5', 'eduvibe-core' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget img, {{WRAPPER}} .eduvibe-animation-widget span.eduvibe-animation-widget-color' => '-webkit-animation: {{VALUE}}; -moz-animation: {{VALUE}}; -ms-animation: {{VALUE}}; -o-animation: {{VALUE}}; animation: {{VALUE}};'
                ],
                'condition' => [
                    'animation_type' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
            'infinite_animation_type',
            [
                'label'     => __( 'Infinite Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'eduvibe-circle-small 15s normal infinite linear',
                'options'   => [
                    'eduvibe-circle-small 15s normal infinite linear'         => __( 'Circle Small', 'eduvibe-core' ),
                    'eduvibe-circle-medium 25s normal infinite linear'        => __( 'Circle Medium', 'eduvibe-core' ),
                    'eduvibe-circle-large 35s normal infinite linear'         => __( 'Circle Large', 'eduvibe-core' ),
                    'eduvibe-fade-in-out 5s normal infinite linear'           => __( 'Fade In Out', 'eduvibe-core' ),
                    'eduvibe-flipX 2s infinite'                               => __( 'flipX', 'eduvibe-core' ),
                    'eduvibe-flipY 2s infinite'                               => __( 'flipY', 'eduvibe-core' ),
                    'eduvibe-vsm-y-move 5s alternate infinite linear'         => __( 'Move Y Very Small', 'eduvibe-core' ),
                    'eduvibe-vsm-y-reverse-move 5s alternate infinite linear' => __( 'Move Y Very Small ( Reverse )', 'eduvibe-core' ),
                    'eduvibe-sm-y-move 15s alternate infinite linear'         => __( 'Move Y Small', 'eduvibe-core' ),
                    'eduvibe-md-y-move 25s alternate infinite linear'         => __( 'Move Y Medium', 'eduvibe-core' ),
                    'eduvibe-lg-y-move 35s alternate infinite linear'         => __( 'Move Y Large', 'eduvibe-core' ),
                    'eduvibe-sm-x-move 15s alternate infinite linear'         => __( 'Move X Small', 'eduvibe-core' ),
                    'eduvibe-md-x-move 25s alternate infinite linear'         => __( 'Move X Medium', 'eduvibe-core' ),
                    'eduvibe-lg-x-move 35s alternate infinite linear'         => __( 'Move X Large', 'eduvibe-core' ),
                    'eduvibe-sm-xy-move 5s alternate infinite linear'         => __( 'Move XY Small', 'eduvibe-core' ),
                    'eduvibe-md-xy-move 10s alternate infinite linear'        => __( 'Move XY Medium', 'eduvibe-core' ),
                    'eduvibe-lg-xy-move 15s alternate infinite linear'        => __( 'Move XY Large', 'eduvibe-core' ),
                    'eduvibe-sm-yx-move 5s alternate infinite linear'         => __( 'Move YX Small', 'eduvibe-core' ),
                    'eduvibe-md-yx-move 10s alternate infinite linear'        => __( 'Move YX Medium', 'eduvibe-core' ),
                    'eduvibe-lg-yx-move 15s alternate infinite linear'        => __( 'Move YX Large', 'eduvibe-core' ),
                    'eduvibe-rotate-x 15s normal infinite linear'             => __( 'Rotate X', 'eduvibe-core' ),
                    'eduvibe-rotate-y 15s normal infinite linear'             => __( 'Rotate Y', 'eduvibe-core' ),
                    'eduvibe-swing 5s infinite both'                         => __( 'Swing', 'eduvibe-core' ),
                    'eduvibe-zoom-in-out 3s normal infinite linear'           => __( 'Zoom In Out', 'eduvibe-core' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget img, {{WRAPPER}} .eduvibe-animation-widget i, {{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-text, {{WRAPPER}} .eduvibe-animation-widget span.eduvibe-animation-widget-color' => '-webkit-animation: {{VALUE}}; -moz-animation: {{VALUE}}; -ms-animation: {{VALUE}}; -o-animation: {{VALUE}}; animation: {{VALUE}};'
                ],
                'condition' => [
                    'animation_type' => [ 'infinite-animation-parallax', 'infinite-animation' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-animation-widget' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'enable_custom_duration',
            [
                'label'        => __( 'Custom Animation Duration', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'animation_type' => [ 'animated-image', 'animated-color', 'infinite-animation', 'infinite-animation-parallax' ]
                ]
            ]
        );
        
        $this->add_responsive_control(
            'custom_duration',
            [
                'label'        => __( 'Set Animation Duration', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 35,
                        'step' => 1
                    ]
                ],
                'description'  => __( 'Set custom animation duration in second( unit ).', 'eduvibe-core' ),
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget img, {{WRAPPER}} .eduvibe-animation-widget i, {{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-text, {{WRAPPER}} .eduvibe-animation-widget span.eduvibe-animation-widget-color' => '-webkit-animation-duration: {{SIZE}}s; -moz-animation-duration: {{SIZE}}s; -ms-animation-duration: {{SIZE}}s; -o-animation-duration: {{SIZE}}s; animation-duration: {{SIZE}}s;'
                ],
                'condition'    => [
                    'enable_custom_duration' => 'yes',
                    'animation_type'           => [ 'animated-image', 'animated-color', 'infinite-animation', 'infinite-animation-parallax' ]
                ]  
            ]
        );

        $this->add_responsive_control(
            'z_index',
            [
                'label'     => __( 'Z Index', 'eduvibe-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -100,
                'max'       => 999,
                'step'      => 1,
                'default'   => 0,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget' => 'z-index: {{SIZE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_along',
            [
                'label'       => __( 'Rotation Along', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'z-axis',
                'options'     => [
                    'x-axis'  => __( 'X - axis', 'eduvibe-core' ),
                    'y-axis'  => __( 'Y - axis', 'eduvibe-core' ),
                    'z-axis'  => __( 'Z - axis', 'eduvibe-core' )
                ],
                'condition'   => [
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );      
        
        $this->add_responsive_control(
            'rotate_x',
            [
                'label'               => __( 'Rotation X - axis', 'eduvibe-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateX({{SIZE}}deg); -moz-transform: rotateX({{SIZE}}deg); -ms-transform: rotateX({{SIZE}}deg); -o-transform: rotateX({{SIZE}}deg); transform: rotateX({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'x-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_y',
            [
                'label'               => __( 'Rotation Y - axis', 'eduvibe-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateY({{SIZE}}deg); -moz-transform: rotateY({{SIZE}}deg); -ms-transform: rotateY({{SIZE}}deg); -o-transform: rotateY({{SIZE}}deg); transform: rotateY({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'y-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'rotate_z',
            [
                'label'               => __( 'Rotation Z - axis', 'eduvibe-core' ),
                'type'                => Controls_Manager::SLIDER,
                'range'               => [
                    'px'              => [
                        'min'         => 0,
                        'max'         => 360,
                        'step'        => 1
                    ]
                ],
                'selectors'           => [
                    '{{WRAPPER}}'     => '-webkit-transform: rotateZ({{SIZE}}deg); -moz-transform: rotateZ({{SIZE}}deg); -ms-transform: rotateZ({{SIZE}}deg); -o-transform: rotateZ({{SIZE}}deg); transform: rotateZ({{SIZE}}deg);'
                ],
                'condition'           => [
                    'rotate_along'    => 'z-axis',
                    'animation_type!' => [ 'tilt', 'mouse-track', 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );
        
        $this->add_responsive_control(
            'item_opacity',
            [
                'label'        => __( 'Opacity', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'default'      => [
                    'size'     => 1
                ],
                'range'        => [
                    'px'       => [
                        'max'  => 1,
                        'step' => 0.01
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget' => 'opacity: {{SIZE}}'
                    
                ]
            ]
        );

        $this->add_responsive_control(
            'responsive_show_hide',
            [
                'label'           => __( 'Show / Hide', 'eduvibe-core' ),
                'description'     => __( 'To show or hide in the responsive devices.', 'eduvibe-core' ),
                'type'            => Controls_Manager::CHOOSE,
                'default'         => 'flex',
                'options'         => [
                    'flex'        => [
                        'title'   => __( 'Show', 'eduvibe-core' ),
                        'icon'    => ' eicon-preview-medium'
                    ],
                    'none'        => [
                        'title'   => __( 'Hide', 'eduvibe-core' ),
                        'icon'    => 'eicon-editor-close'
                    ]
                ],
                'selectors'       => [
                    '{{WRAPPER}} .eduvibe-animation-widget' => 'display: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tilt',
            [
                'label'     => __( 'Tilt', 'eduvibe-core' ),
                'condition' => [
                    'animation_type' => 'tilt'
                ]
            ]
        );

        $this->add_control(
            'maxtilt',
            [
                'label'       => __( 'maxTilt', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 20,
                'description' => __( 'Default: 20.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'perspective',
            [
                'label'       => __( 'Perspective', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1000,
                'description' => __( 'Transform perspective, the lower the more extreme the tilt gets. Default: 1000', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'scale',
            [
                'label'       => __( 'Scale', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 1,
                'description' => __( 'On hover it\'ll be scaled. Here, 1 = 100%, 1.5 = 150%, 2 = 200%, etc...Default: 1', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'tilt_speed',
            [
                'label'       => __( 'Speed', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 300,
                'description' => __( 'Speed of the enter/exit transition. Default: 300', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'glare',
            [
                'label'        => __( 'Glare', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'maxglare',
            [
                'label'        => __( 'maxGlare', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1
                    ]
                ],
                'default'      => [
                    'size'     => .3
                ],
                'description'  => __( 'Data range isrom 0 - 1. Default: .3', 'eduvibe-core' ),
                'condition'    => [
                    'glare'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'reset',
            [
                'label'        => __( 'Reset', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'description'  => __( 'Disabling this option will not reset the tilt element when the user mouse leaves the element.', 'eduvibe-core' ),
            ]
        );

        $this->add_control(
            'enable_axis',
            [
                'label'    => __( 'Enable Axis', 'eduvibe-core' ),
                'type'     => Controls_Manager::SELECT,
                'default'  => 'null',
                'options'  => [
                    'null' => __( 'Both', 'eduvibe-core' ),
                    'x'    => __( 'X', 'eduvibe-core' ),
                    'y'    => __( 'Y', 'eduvibe-core' )
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_mouse_track',
            [
                'label'     => __( 'Mouse Track', 'eduvibe-core' ),
                'condition' => [
                    'animation_type' => 'mouse-track'
                ]
            ]
        );

        $this->add_control(
            'mouse_speed',
            [
                'label'        => __( 'Speed', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -10,
                        'step' => 0.1,
                        'max'  => 10
                    ]
                ],
                'default'      => [
                    'size'     => 1.5
                ],
                'description'  => __( 'Negative value will work on mouse direction. Positive value will work on mouse reverse direction.', 'eduvibe-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_parallax',
            [
                'label'     => __( 'Parallax', 'eduvibe-core' ),
                'condition' => [
                    'animation_type' => [ 'parallax', 'infinite-animation-parallax' ]
                ]
            ]
        );

        $this->add_control(
            'x_axis_translation',
            [
                'label'        => __( 'X', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at horizontal(X) axis. unit: pixels', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 0
                ]
            ]
        );

        $this->add_control(
            'y_axis_translation',
            [
                'label'        => __( 'Y', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of scrolling at vertical(Y) axis.', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 110
                ]
            ]
        );

        $this->add_control(
            'x_axis_rotation',
            [
                'label'        => __( 'rotateX', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at horizontal(X) axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'y_axis_rotation',
            [
                'label'        => __( 'rotateY', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at vertical(Y) axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'z_axis_rotation',
            [
                'label'        => __( 'rotateZ', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of rotation at Z axis. unit: degrees', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => -1000,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ]
            ]
        );

        $this->add_control(
            'global_scale',
            [
                'label'        => __( 'scale( global )', 'elementor-hello-world' ),
                'type'         => Controls_Manager::SLIDER,
                'description'  => __( 'Value of global scale. unit: ratio', 'elementor-hello-world' ),
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 3
                    ]
                ],
                'default'      => [
                    'size'     => 1
                ]
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_big_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 1200px ).', 'eduvibe-core' ),
            ]
        );

        $this->add_control(
            'disable_parallax_at_responsive_small_tablet',
            [
                'label'        => __( 'Disable Parallax at Big Tablet.', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'label'        => __( 'Disable Parallax at Responsive Devices ( screen size < 992px ).', 'eduvibe-core' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label'        => __( 'Image', 'eduvibe-core' ),
                'tab'          => Controls_Manager::TAB_STYLE,
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '===',
                                    'value'    => 'animated-image'
                                ]
                            ]
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'image[url]',
                                    'operator' => '!==',
                                    'value'    => ''
                                ],
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'image'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => 'animated-color'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'        => __( 'Width', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%', 'em' ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget img'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'animation_type!' => 'animated-image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget img'
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'image_css_filters',
				'selector' => '{{WRAPPER}} .eduvibe-animation-widget img'
			]
		);

        $this->add_control(
            'image_backdrop_filter',
            [
                'label'    => __( 'Backdrop Filter', 'eduvibe-core' ),
                'type'     => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget img' => 'backdrop-filter: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label'     => __( 'Icon', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type'    => 'icon',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_control(
          'icon_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eduvibe-animation-widget svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'icon_bg_color',
            [
                'label'     => __( 'Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-animation-widget i, {{WRAPPER}} .eduvibe-animation-widget svg'   => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'       => __( 'Icon Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size'    => 35
                ],
                'range'       => [
                    'px'      => [
                        'max' => 750
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-animation-widget i, {{WRAPPER}} .eduvibe-animation-widget' => 'font-size: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget i'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget i'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_style',
            [
                'label'     => __( 'Text', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type'    => 'text',
                    'animation_type!' => [ 'animated-image', 'animated-color' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} span.eduvibe-animation-widget-text'
            ]
        );

        $this->add_control(
          'text_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.eduvibe-animation-widget-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} span.eduvibe-animation-widget-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'color_style',
            [
                'label'        => __( 'Color', 'eduvibe-core' ),
                'tab'          => Controls_Manager::TAB_STYLE,
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'content_type',
                                    'operator' => '===',
                                    'value'    => 'color'
                                ],
                                [
                                    'name'     => 'animation_type',
                                    'operator' => '!==',
                                    'value'    => [ 'animated-image', 'animated-color' ]
                                ]
                            ]
                        ],
                        [
                            'name'     => 'animation_type',
                            'operator' => '===',
                            'value'    => 'animated-color'
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'colors_color',
                'types'           => [ 'classic', 'gradient' ],
                'selector'        => '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color',
                'exclude'         => [ 'image' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $primary_color
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'color_height',
            [
                'label'        => __( 'Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 5,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 80
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_width',
            [
                'label'        => __( 'Width', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 5,
                        'step' => 5,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 80
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'color_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'color_border',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'color_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color'
            ]
        );

        $this->add_responsive_control(
            'color_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'condition'  => [
                    'animation_type!' => 'animated-color'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animation-widget .eduvibe-animation-widget-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
	}

  	/**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
	protected function render() {
        $settings       = $this->get_settings_for_display();
        $content_type   = '';
        $animation_type = $settings['animation_type'];

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'eduvibe-animation-widget',
                    'eduvibe-animation-display-type-' . esc_attr( $animation_type )
                ]
            ]
        );

        if ( 'animated-image' !== $animation_type && 'animated-color' !== $animation_type ) :
            $content_type = $settings['content_type'];
            $this->add_render_attribute( 'container', 'class', 'eduvibe-animation-content-type-' . esc_attr( $content_type ) );
        else :
            $this->add_render_attribute( 'container', 'class', 'eduvibe-animated-morph-type-' . esc_attr( $settings['animated_image_color_type'] ) );
        endif;

        if ( 'tilt' === $animation_type ) :
            $this->add_render_attribute(
                'container',
                [
                    'class'            => 'eduvibe-tilt-item',
                    'data-maxtilt'     => esc_attr( $settings['maxtilt'] ),
                    'data-perspective' => esc_attr( $settings['perspective'] ),
                    'data-scale'       => esc_attr( $settings['scale'] ),
                    'data-speed'       => esc_attr( $settings['tilt_speed'] ),
                    'data-axis'        => esc_attr( $settings['enable_axis'] )
                ]
            );

            if ( 'yes' === $settings['glare'] ) :
                $this->add_render_attribute( 'container', 'data-glare', 'true' );
                $this->add_render_attribute( 'container', 'data-maxglare', esc_attr( $settings['maxglare']['size'] ) );
            endif;

            if ( 'yes' !== $settings['reset'] ) :
                $this->add_render_attribute( 'container', 'data-reset', 'false' );
            endif;
        elseif ( 'mouse-track' === $animation_type ) :
            $this->add_render_attribute( 'container', 'class', 'eduvibe-mouse-track-item' );
        elseif ( 'parallax' === $animation_type || 'infinite-animation-parallax' === $animation_type  ) :

            $x_axis_translation = $settings['x_axis_translation']['size'] ? $settings['x_axis_translation']['size'] : 0;
            $y_axis_translation = $settings['y_axis_translation']['size'] ? $settings['y_axis_translation']['size'] : 0;
            $x_axis_rotation    = $settings['x_axis_rotation']['size'] ? $settings['x_axis_rotation']['size'] : 0;
            $y_axis_rotation    = $settings['y_axis_rotation']['size'] ? $settings['y_axis_rotation']['size'] : 0;
            $z_axis_rotation    = $settings['z_axis_rotation']['size'] ? $settings['z_axis_rotation']['size'] : 0;
            $global_scale       = $settings['global_scale']['size'] ? $settings['global_scale']['size'] : 1;

            $this->add_render_attribute(
                'container',
                [
                    'class'         => 'eduvibe-parallax-item',
                    'data-parallax' => '{"x": ' . esc_attr( $x_axis_translation ) . ', "y": ' . esc_attr( $y_axis_translation ) . ', "rotateX": ' . esc_attr( $x_axis_rotation ) . ', "rotateY": ' . esc_attr( $y_axis_rotation ) . ', "rotateZ": ' . esc_attr( $z_axis_rotation ) . ', "scale": ' . esc_attr( $global_scale ) . '}'
                ]
            );

            if ( 'yes' === $settings['disable_parallax_at_responsive_big_tablet'] ) :
                $this->add_render_attribute( 'container', 'class', 'eduvibe-parallax-disable-at-big-tablet' );
            endif;

            if ( 'yes' === $settings['disable_parallax_at_responsive_small_tablet'] ) :
                $this->add_render_attribute( 'container', 'class', 'eduvibe-parallax-disable-at-small-tablet' );
            endif;
        endif;
        
        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            if ( 'animated-image' !== $animation_type && 'animated-color' !== $animation_type  ) :
                if ( 'mouse-track' === $animation_type ) :
                    echo '<span data-depth="' . esc_attr( $settings['mouse_speed']['size'] ) . '">';
                endif;
                if ( 'image' === $content_type ) :
                    if ( 'custom-image' === $settings['image_type'] )  :
                        echo '<img src="' . esc_url( $this->render_image( $settings ) ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                    else :
                        echo '<img src="' . EDUVIBE_ASSETS_URL . 'images/predefined-images/' . esc_attr( $settings['predefined_image'] ) . '" alt="">';
                    endif;
                elseif ( 'icon' === $content_type ) :
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                elseif ( 'text' === $content_type ) :
                    echo $settings['text'] ? '<span class="eduvibe-animation-widget-text">' . esc_html( $settings['text'] ) . '</span>' : '';
                elseif ( 'color' === $content_type ) :
                    echo '<span class="eduvibe-animation-widget-color"></span>';
                endif;
                if ( 'mouse-track' === $animation_type ) :
                    echo '</span>';
                endif;
            elseif ( 'animated-image' === $animation_type ) :
                if ( 'custom-image' === $settings['image_type'] )  :
                    echo '<img src="' . esc_url( $this->render_image( $settings ) ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                else :
                    echo '<img src="' . EDUVIBE_ASSETS_URL . 'images/predefined-images/' . esc_attr( $settings['predefined_image'] ) . '" alt="">';
                endif;
            elseif ( 'animated-color' === $animation_type ) :
                echo '<span class="eduvibe-animation-widget-color"></span>';
            endif;
        echo '</div>';
    }

    /**
     * return image URL for static course categories
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $settings ) {
        $image     = $settings['image'];
        $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        if ( empty( $image_url ) ) :
            $image_url = $image['url'];
        else :
            $image_url = $image_url;
        endif;
        return $image_url;
    }
}