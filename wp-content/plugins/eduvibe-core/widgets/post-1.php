<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for post.
 *
 * @since 1.0.0
 */
class Post_One extends Widget_Base {
    use \EduVibe_Core\Traits\Posts;
    use \EduVibe_Core\Traits\Slider_Arrows;
    use \EduVibe_Core\Traits\Slider_Dots;
    use \EduVibe_Core\Traits\Grid, \EduVibe_Core\Traits\Slider {
        \EduVibe_Core\Traits\Slider::settings insteadof \EduVibe_Core\Traits\Grid;
        \EduVibe_Core\Traits\Grid::settings as grid_settings;
    }

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
        return 'eduvibe-post-one';
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
        return __( 'Post 1( Grid / Carousel )', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-posts-grid';
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
        return [ 'eduvibe-slick' ];
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
        return [ 'eduvibe-slick' ];
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
        return [ 'eduvibe', 'query', 'blog', 'post', 'archive', 'posts', 'loop', 'slider', 'carousel' ];
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

    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 3;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 2;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 1;
    protected $category_taxonomy    = 'category';
    protected $default_content_type, $default_display_type, $post_type;

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_posts',
            [
                'label' => __( 'Post', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Type', 'eduvibe-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'eduvibe-core' ),
                    'slider' => __( 'Slider', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => __( 'Style 1', 'eduvibe-core' ),
                    '2'   => __( 'Style 2', 'eduvibe-core' ),
                    '3'   => __( 'Style 3', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
			'active_white_bg', [
				'label'        => __( 'Active White Background', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'eduvibe-post-thumb'
            ]
        );
        
        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Image Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 200,
                        'step' => 10,
                        'max'  => 800
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .edu-blog .thumbnail img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Read More' , 'eduvibe-core' ),
                'condition'   => [
                    'style'   => '1'
                ]
            ]
        );

        $this->end_controls_section();

        $this->query();

        $this->grid_settings();

        $this->settings();

        $this->arrows();

        $this->dots();
    }

    /**
     * return post featured image
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $image_id, $settings ) {
        $image_size = $settings['thumb_size_size'];

        if ( 'custom' === $image_size ) :
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumb_size', $settings );
        else :
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        endif;
        
        return '<img src="' . esc_url( $image_src ). '" alt="' . esc_attr( eduvibe_thumbanil_alt_text( $image_id ) ) . '" />';
    }

    /**
     * return number of posts to show for load more button
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function load_more_button_page_number( $settings ) {
        global $wp_query;
        $number_of_posts = $settings['per_page']['size'];
        return $wp_query->$number_of_posts;
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
        $settings  = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'container', 'class', 'eduvibe-blog-post eduvibe-post-one-wrapper' );
        $this->add_render_attribute( 'container', 'class', 'eduvibe-post-one-style-' . esc_attr( $settings['style'] ) );
        $this->add_render_attribute( 'container', 'class', 'eduvibe-post-one-' . esc_attr( $settings['display_type'] ) );
        $this->add_render_attribute( 'single-wrapper', 'class', 'eduvibe-post-one-single-' . esc_attr( $settings['display_type'] ) );

        if ( 'yes' === $settings['active_white_bg'] ) :
            $this->add_render_attribute( 'container', 'class', 'active-white-bg' );
        endif;

        if ( 'grid' === $settings['display_type'] ) :
            $this->add_render_attribute( 'container', 'class', 'eduvibe-row' );
            $grid_desktop_column = 12/$settings['desktop_grid_columns'];
            $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
            $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
            $grid_column = 'eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );
            $this->add_render_attribute( 'single-wrapper', 'class', $grid_column );
        else :
            $this->add_render_attribute( 
                'container', 
                [
                    'class'                   => 'eduvibe-slider-item',
                    'data-slidestoshow'       => intval( esc_attr( $settings['desktop_columns']['size'] ) ),
                    'data-tablet-items'       => intval( esc_attr( $settings['tablet_columns']['size'] ) ),
                    'data-mobile-items'       => intval( esc_attr( $settings['mobile_columns']['size'] ) ), 
                    'data-small-mobile-items' => intval( esc_attr( $settings['small_mobile_columns']['size'] ) ),
                    'data-slidestoscroll'     => intval( esc_attr( $settings['slides_to_scroll']['size'] ) ),
                    'data-speed'              => intval( esc_attr( $settings['transition_duration'] ) ),
                    'data-navigation'         => esc_attr( $settings['arrows_and_dots'] ),
                    'data-direction'          => esc_attr( $direction )
                ]
            );

            if ( 'yes' === $settings['autoplay'] ) :
                $this->add_render_attribute( 'container', 'data-autoplay', 'true' );
                $this->add_render_attribute( 'container', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
                if ( 'yes' === $settings['pause'] ) :
                    $this->add_render_attribute( 'container', 'data-pauseonhover', 'true' );
                endif;
            endif;

            if ( 'yes' === $settings['loop'] ) :
                $this->add_render_attribute( 'container', 'data-loop', 'true' );
            endif;

            if ( 'arrows' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
                $this->add_render_attribute( 'container', 'data-arrow-prev', esc_attr( $settings['arrows_prev_icon']['value'] ) );
                $this->add_render_attribute( 'container', 'data-arrow-next', esc_attr( $settings['arrows_next_icon']['value'] ) );
                $this->add_render_attribute( 'container', 'class', 'arrow-position-' . esc_attr( $settings['arrows_position'] ) );
            endif;
        endif;

        if ( 'default' === $settings['date_format'] ) :
            $date = get_option( 'date_format' );
        elseif ( 'custom' === $settings['date_format'] ) :
            $date = $settings['custom_date_format'];
        else :
            $date = $settings['date_format'];
        endif;

        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $settings['per_page']['size'],
            'orderby'        => $settings['order_by'],
            'order'          => $settings['order'],
            'post__in'       => $settings['specific_post_include'],
            'post__not_in'   => $settings['specific_post_exclude']
        );

        if ( 'yes' === $settings['enable_only_featured_posts'] ) :
            $args['meta_query'][] = array( 'key' => '_thumbnail_id' );
        endif;

        if ( 'yes' === $settings['ignore_sticky'] ) :
            $args['ignore_sticky_posts'][] = true;
        endif;

        if ( ! empty( $settings['include_categories'] ) ) :
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $category_slug,
                    'field'    => 'term_id',
                    'terms'    => $settings['include_categories']
                )
            );
        endif;

        $wp_query = new \WP_Query( $args );
        if ( $wp_query->have_posts() ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    global $post;
                    $the_id = get_the_ID();
                    echo '<div ' . $this->get_render_attribute_string( 'single-wrapper' ) . '>';
                        include EDUVIBE_PLUGIN_DIR . 'widgets/styles/posts/post-' . $settings['style'] . '.php';
                    echo '</div>';
                endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
    }
}