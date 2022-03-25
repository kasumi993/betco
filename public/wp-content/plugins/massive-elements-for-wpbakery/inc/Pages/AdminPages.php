<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Pages;

use Inc\Api\Callbacks\ManagerCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class AdminPages extends BaseController {

	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();

	public $subpages = array();

	public $settings = array();
	public $sections = array();

	public $fields = array();

	public function register() {
		$this->settings       = new SettingsApi();
		$this->callbacks      = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();
		$this->setPages();
		//$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings->addPages( $this->pages )->/*withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->*/register();
	}

	public function setPages() {
		$this->pages = array(
			array(
				'page_title' => 'Massive Elements for WPBakery',
				'menu_title' => 'Massive Elements',
				'capability' => 'manage_options',
				'menu_slug'  => 'weavc',
				'callback'   => array( $this->callbacks, 'adminDashboard' ),
				'icon_url'   => 'dashicons-editor-code',
				'position'   => 110,
			),
		);
	}

/*	public function setSubpages() {
		$this->subpages = array(
			array(
				'parent_slug' => 'prime_vc',
				'page_title'  => 'Custom Post Types',
				'menu_title'  => 'CPT',
				'capability'  => 'manage_options',
				'menu_slug'   => 'prime_cpt',
				'callback'    => '<h1> Great </h1>',
			),
		);
	}*/

	// Admin Custom Fields

	public function setSettings() {
		$args = array(
			array(
				'option_group' => 'prime_vc_options_group',
				'option_name'  => 'weavc',
				'callback'     => array( $this->callbacks_mngr, 'checkboxSanitize' ),
			),
		);

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array(
			array(
				'id'       => 'prime_vc_admin_index',
				'title'    => '',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page'     => 'weavc',
			),
		);

		$this->settings->setSections( $args );
	}

	public function setFields() {

		$args = array();
		foreach ( $this->shortcodes as $key => $value ) {
			$args[] = array(
				'id'       => $key,
				'title'    => $value . '<br> <p style="font-size: 9px; color: #999; margin: 0, padding: 0;">' . $value . ' shortcode for vc</p>',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page'     => 'weavc',
				'section'  => 'prime_vc_admin_index',
				'args'     => array(
					'option_name' => 'weavc',
					'label_for'   => $key,
					'class'       => 'ui-toggle',
				),
			);
		}
		$this->settings->setFields( $args );
	}
}