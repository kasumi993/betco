<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc;

final class Extensions {
	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [
			//Extensions\IconAnimation::class,
			//Extensions\AnimateBox::class,
			//Extensions\InfoBox::class,
			Extensions\Accordion::class,
			Extensions\PrimeTab::class,
			Extensions\Testimonial::class,
			Extensions\TeamMember::class,
			Extensions\Separator::class,
			Extensions\FlipBox3D::class,
			Extensions\Modal::class,
			Extensions\CssTooltip::class,
			Extensions\PricingTable::class,
			Extensions\BeforeAfter::class,
			Extensions\ContentBlock::class,
			Extensions\HoverEffects\HoverEffects::class,
			Extensions\PageTransition::class,
			Extensions\PrimeModal::class,
			Extensions\ScrollNotification::class,
			Extensions\MasonryGallery::class,
			Extensions\ZoomMagnifier::class,
			Extensions\VideoGallery::class,
			Extensions\ShadowBox::class,
			Extensions\ImageHotspot\ImageHotspot::class,
			Extensions\ProfileCard::class,
			Extensions\TimeLine::class,
			Extensions\CountDown\CountDown::class,
			Extensions\ProgressBar::class,
			Extensions\UndoRedo::class,
			Extensions\CounTer::class,
		];

	}

	/**
	 * Loop through the classes::class, initialize them::class,
	 * and call the register() method if it exists
	 *
	 * @return
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$extensions = self::instantiate( $class );
			if ( method_exists( $extensions, 'extensions_register' ) ) {
				$extensions->extensions_register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class class from the services array
	 *
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$extensions = new $class();

		return $extensions;
	}

}