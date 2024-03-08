<?php
/**
 * Plugin Name: BMI Calculator Shortcode
 * Description: BMI Calculator Shortcode
 * Author: Viacheslav Adishchev
 * Version: 1.0
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_shortcode('klnph_bmi', function($attrs) {
	$attrs = shortcode_atts([
		'weight' => 80, 
		'height' => 180
	], $attrs );

    ob_start(); ?>

 <link rel="stylesheet" href="<?= plugin_dir_url( __FILE__ ) ?>bmi/style.css">
    <div class="bmi">
        <form autocomplete="off">
            <div class="bmi__form">
                <div class="bmi-row">
                    <div class="bmi-cell bmi__param">
                        Рост
                    </div>
                    <div class="bmi-cell">
                        <input class="calc__input" name="height" value="<?= $attrs['height'] ?>">
                    </div>
                    <div class="bmi-cell">
                        см
                    </div>
                </div>
                <div class="bmi-row">
                    <div class="bmi-cell bmi__param">
                        Вес
                    </div>
                    <div class="bmi-cell">
                        <input class="calc__input" name="weight" value="<?= $attrs['weight'] ?>">
                    </div>
                    <div class="bmi-cell">
                        кг
                    </div>
                </div>
                <div class="bmi-row">
                    <div class="bmi-cell"></div>
                    <div class="bmi-cell bmi__result">
                        <span>Индекс массы тела</span>
                        <div class="bmi__value"></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="bmi__chart">
            <div class="bmi__marker">&#9660;</div>
        </div>
        <div class="bmi__chart">
            <div class="bmi__range bmi__thinnes" data-bmi="18.5">&lt; 18.5</div>
            <div class="bmi__range bmi__normal" data-bmi="25">18.5&ndash;25</div>
            <div class="bmi__range bmi__overweight" data-bmi="30">25&ndash;30</div>
            <div class="bmi__range bmi__obese" data-bmi="35">&gt; 30</div>
        </div>

        <script src="<?= plugin_dir_url( __FILE__ ) ?>bmi/script.js"></script>
    </div>

<?php
    return ob_get_clean();
});

