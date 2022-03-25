<?php
/**
 * @package  MEWVC
 */

namespace Inc\Base;

use Inc\Extensions\Params\DateTime;
use Inc\Extensions\Params\Heading;
use Inc\Extensions\Params\Margin;
use Inc\Extensions\Params\Number;
use Inc\Extensions\Params\Padding;
use Inc\Extensions\Params\Slider;
use Inc\Extensions\Params\SwitchParam;
use Inc\Extensions\Params\NoticeParam;
use Inc\Extensions\Params\RadioParam;

class Params {
	public $switchparams;

	public function register() {
		 new SwitchParam();
		 new NoticeParam();
		 new RadioParam();
		 new Number();
		 new Heading();
		 new DateTime();
		 new Slider();
		 new Margin();
		 new Padding();
	}
}