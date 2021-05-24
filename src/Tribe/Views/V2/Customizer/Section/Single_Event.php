<?php
/**
 * The Events Calendar Customizer Section Class
 * Single Event
 *
 * @since TBD
 */

namespace Tribe\Events\Views\V2\Customizer\Section;

/**
 * Month View
 *
 * @since TBD
 */
final class Single_Event extends \Tribe__Customizer__Section {

	/**
	 * ID of the section.
	 *
	 * @since TBD
	 *
	 * @access public
	 * @var string
	 */
	public $ID = 'single_event';

	/**
	 * Allows sections to be loaded in order for overrides.
	 *
	 * @var integer
	 */
	public $queue_priority = 20;

	/**
	 * This method will be executed when the Class is Initialized.
	 *
	 * @since TBD
	 */
	public function setup() {
		parent::setup();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setup_arguments() {
		$this->arguments = [
			'priority'	=> 10,
			'capability'  => 'edit_theme_options',
			'title'	   => esc_html__( 'Single Event', 'the-events-calendar' ),
			'description' => esc_html__( 'Options selected here will override what was selected in the "Global Elements" section on Single Event views.', 'the-events-calendar' ),
		];
	}


	/**
	 * {@inheritdoc}
	 */
	public function setup_defaults() {
		$this->defaults = [
			'post_title_color_choice' => 'default',
			'post_title_color'        => '#141827',
			'details_bg_color'        => '#e5e5e5',
		];
	}

	public function setup_content_settings() {
		$this->content_settings = [
			'post_title_color_choice' => [
				'sanitize_callback'	   => 'sanitize_key',
				'sanitize_js_callback' => 'sanitize_key',
			],
			'post_title_color'        => [
				'sanitize_callback'	   => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
			'details_bg_color'        => [
				'sanitize_callback'	   => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			],
		];
	}

	public function setup_content_headings() {
		$this->content_headings = [
			'font_colors' => [
				'priority'	 => 0,
				'type'		 => 'heading',
				'label'    => esc_html__( 'Set Font Colors', 'the-events-calendar' ),
			],
			'single_view_separator' => [
				'priority'	 => 10,
				'type'		 => 'separator',
				'active_callback' => function() {
					// Heading should not show if the new Single View is enabled.
					return ! tribe_events_single_view_v2_is_enabled();
				},
			],
			'adjust_appearance' => [
				'priority'	 => 20,
				'label'    => esc_html__( 'Adjust Appearance', 'the-events-calendar' ),
				'active_callback' => function() {
					// Heading should not show if the new Single View is enabled.
					return ! tribe_events_single_view_v2_is_enabled();
				},
			],
		];
	}

	public function setup_content_controls() {
		$customizer = tribe( 'customizer' );
		$this->content_controls = [
			'post_title_color_choice' => [
				'priority' => 5,
				'type'     => 'radio',
				'label'    => esc_html__( 'Event Title Color', 'the-events-calendar' ),
				'choices'  => [
					'default' => esc_html__( 'Use General', 'the-events-calendar' ),
					'custom'  => esc_html__( 'Custom', 'the-events-calendar' ),
				],
			],
			'post_title_color'        => [
				'priority' => 6, // Should come immediately after post_title_color_choice
				'type'     => 'color',
				'active_callback' => function( $control ) use ( $customizer ) {
					$setting_name = $customizer->get_setting_name( 'post_title_color_choice', $control->section );
					$value = $control->manager->get_setting( $setting_name )->value();
					return $this->defaults['post_title_color_choice'] !== $value;
				},
			],
			'details_bg_color'        => [
				'priority'    => 25,
				'type'        => 'color',
				'label'       => esc_html__( 'Event Details Background Color', 'the-events-calendar' ),
				'active_callback' => function() {
					// Control should not show if the new Single View is enabled.
					return ! tribe_events_single_view_v2_is_enabled();
				},
			],
		];
	}

	/**
	 * Filters the Single Event section CSS template to add Views v2 related style templates to it.
	 *
	 * @since 5.3.1
	 *
	 * @param string                      $css_template The CSS template, as produced by the Single Event.
	 * @param \Tribe__Customizer__Section $section      The Single Event section.
	 * @param \Tribe__Customizer          $customizer   The current Customizer instance.
	 *
	 * @return string The filtered CSS template.
	 */
	public function get_css_template( $css_template ) {
		if (
			$this->should_include_setting_css( 'post_title_color_choice' )
			&& $this->should_include_setting_css( 'post_title_color' )
		) {
			$css_template .= '
				--tec-color-text-event-title: <%= single_event.post_title_color %>;
			';
		}

		return $css_template;
	}
}
