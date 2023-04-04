<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for icon box.
 *
 * @since 1.0.0
 */
class Image_Icon_Box extends Widget_Base {

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
		return 'eduvibe-icon-box';
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
		return __( 'Icon/Image Box', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-icon-box';
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
		return [ 'eduvibe', 'icon box', 'image box', 'image', 'icon' ];
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
        
        $this->start_controls_section(
            'section_icon_box',
            [
                'label' => __( 'Image/Icon Box', 'eduvibe-core' )
            ]
        );

        $this->add_control(
	        'icon_or_image',
	        [
				'label'         => __( 'Icon/Image', 'eduvibe-core' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'label_block'   => true,
				'default'       => 'img',
	            'options'       => [
					'icon'      => [
						'title' => __( 'Icon', 'eduvibe-core' ),
						'icon'  => 'eicon-info-circle'
					],
					'img'       => [
						'title' => __( 'Image', 'eduvibe-core' ),
						'icon'  => 'eicon-image-bold'
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
                    'icon_or_image' => 'icon'
                ]
            ]
        );

        $this->add_control(
	        'image',
	        [
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
	                'url'   => Utils::get_placeholder_image_src()
	            ],
	            'condition' => [
	                'icon_or_image' => 'img'
	            ]
	        ]
	    );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'This is the heading', 'eduvibe-core' ),
                'placeholder' => __( 'Enter your title', 'eduvibe-core' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'details',
            [
                'label'       => __( 'Details', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'eduvibe-core' ),
                'placeholder' => __( 'Enter your description', 'eduvibe-core' ),
                'rows'        => 10
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __( 'Link', 'eduvibe-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'eduvibe-core' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'position',
            [
                'label'          => __( 'Icon Position', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'top'        => [
                        'title'  => __( 'Top', 'eduvibe-core' ),
                        'icon'   => 'eicon-v-align-top'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ]
            ]
        );

        $this->add_control(
            'icon_position_vertical_on_mobile',
            [
                'label'        => __( 'Vertical On Mobile', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'position!' => 'top'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'    => __( 'Title HTML Tag', 'eduvibe-core' ),
                'type'     => Controls_Manager::SELECT,
                'options'  => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p'
                ],
                'default'  => 'h6'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
          'icon_style',
            [
                'label'     => __( 'Icon', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'icon',
                    'icon[value]!' => ''
                ]
            ]
        );

        $this->add_control(
            'icon_box',
            [
                'label'        => __( 'Icon Box', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_responsive_control(
            'icon_box_size',
            [
                'label'        => __( 'Box Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 25,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 150
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'icon_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'       => __( 'Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px'      => [
                        'min' => 15,
                        'max' => 200
                    ]
                ],
                'default'     => [
                    'size'    => 30
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon, {{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
          'icon_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'icon_bg_color',
            [
                'label'     => __( 'Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'background-color: {{VALUE}};'
                ],
                'condition'    => [
                    'icon_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'icon_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'icon_border',
                'selector'  => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable',
                'condition' => [
                    'icon_box' => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
          'icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'icon_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'icon_box_shadow',
                'selector'  => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable',
                'condition' => [
                    'icon_box' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
          'image_style',
            [
                'label'     => __( 'Image', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'img',
                    'image[url]!'   => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'      => 'img_size',
				'default'   => 'thumbnail',
				'condition' => [
					'icon_or_image'   => 'img',
                    'image[url]!' => ''
				]
            ]
        );

        $this->add_control(
            'image_box',
            [
                'label'        => __( 'Image Box', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_responsive_control(
            'image_box_size',
            [
                'label'        => __( 'Box Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 25,
                        'max'  => 1000
                    ]
                ],
                'default'      => [
                    'size'     => 150
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'image_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label'       => __( 'Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'image_bg_color',
              [
                  'label'     => __( 'Background Color', 'eduvibe-core' ),
                  'type'      => Controls_Manager::COLOR,
                  'selectors' => [
                      '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'background-color: {{VALUE}};'
                  ],
                  'condition'    => [
                      'image_box' => 'yes'
                  ]
              ]
          );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'image_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable',
                'condition' => [
                    'image_box' => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
          'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'image_box' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'image_box_shadow',
                'selector'  => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-icon.eduvibe-icon-box-enable',
                'condition' => [
                    'image_box' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'vertical_alignment',
            [
                'label'     => __( 'Vertical Alignment', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'flex-start',
                'options'   => [
                    'flex-start' => __( 'Top', 'elementor' ),
                    'center'     => __( 'Middle', 'elementor' ),
                    'flex-end'   => __( 'Bottom', 'elementor' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper' => 'align-items: {{VALUE}};'
                ],
                'condition' => [
                    'position!' => 'top'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'        => __( 'Margin', 'eduvibe-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%', 'em' ],
                'default'      => [ 
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '15',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'title_style',
            [
                'label'      => __( 'Title', 'eduvibe-core' ),
                'type'       => Controls_Manager::HEADING,
                'separator'  => 'before',
                'condition'  => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-title'
            ]
        );

        $this->add_control(
          'title_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'title_hover_color',
            [
                'label'       => __( 'Hover Color', 'eduvibe-core' ),
                'type'        => Controls_Manager::COLOR,
                'description' => __( 'Only applicable if there is any link.', 'eduvibe-core' ),
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper a:hover .eduvibe-icon-box-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'description_style',
            [
                'label'      => __( 'Description', 'eduvibe-core' ),
                'type'       => Controls_Manager::HEADING,
                'separator'  => 'before',
                'condition'  => [
                    'details!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-content, {{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-content p',
                'condition'  => [
                    'details!' => ''
                ]
            ]
        );

        $this->add_control(
          'description_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-content, {{WRAPPER}} .eduvibe-icon-box-wrapper .eduvibe-icon-box-content p'   => 'color: {{VALUE}};',
                    'condition'  => [
                        'details!' => ''
                    ]
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
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'eduvibe-icon-box-wrapper',
                    'eduvibe-icon-box-' . esc_attr( $settings['icon_or_image'] ),
                    'eduvibe-icon-box-icon-position-' . esc_attr( $settings['position'] )
                ]
            ]
        );

        if ( 'top' !== $settings['position'] ) :
            if ( 'yes' === $settings['icon_position_vertical_on_mobile'] ) :
                $this->add_render_attribute( 'container', 'class', 'eduvibe-icon-box-vertical-on-mobile' );
            endif;
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            $icon_box = 'yes' === $settings['icon_box'] || $settings['image_box'] ? 'enable' : 'disable';
            echo '<div class="eduvibe-icon-box-icon eduvibe-icon-box-' . esc_attr( $icon_box ) . '">';
                if ( 'icon' === $settings['icon_or_image'] && ! empty( $settings['icon']['value'] ) ) :
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                elseif ( 'img' === $settings['icon_or_image'] && ! empty( $settings['image']['url'] ) ) :
                    $image = $settings['image'];
                    $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'img_size', $settings );
                    if ( empty( $image_url ) ) :
                        $image_url = $image['url'];
                    else :
                        $image_url = $image_url;
                    endif;
                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                endif;
            echo '</div>';
            echo '<div class="eduvibe-icon-box-content">';
                if ( isset( $settings['title'] ) && ! empty( $settings['title'] ) ) :
                    if ( ! empty( $settings['link']['url'] ) ) :
                        $this->add_render_attribute( 'url', 'href', esc_url( $settings['link']['url'] ) );
                        if ( $settings['link']['is_external'] ) :
                            $this->add_render_attribute( 'url', 'target', '_blank' );
                        endif;
                        if ( $settings['link']['nofollow'] ) :
                            $this->add_render_attribute( 'url', 'rel', 'nofollow' );
                        endif;
                        echo '<a ' . $this->get_render_attribute_string( 'url' ) . '>';
                    endif;

                    echo '<' . esc_attr( $settings['title_tag'] ) . ' class="eduvibe-icon-box-title">';
                        echo wp_kses_post( $settings['title'] );
                    echo '</' . esc_attr( $settings['title_tag'] ) . '>';

                    if ( ! empty( $settings['link']['url'] ) ) :
                        echo '</a>';
                    endif;
                endif;
                echo '<div class="eduvibe-icon-box-details">' . wpautop( wp_kses_post( $settings['details'] ) ) . '</div>';
            echo '</div>';
        echo '</div>';
    }
}