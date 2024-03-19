<?php
/**
 * Plugin Name: KLNPH Shortcode
 * Description: KLNPH Shortcode
 * Author: Viacheslav Adishchev
 * Version: 1.0.1   
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

 <link rel="stylesheet" href="<?= plugin_dir_url( __FILE__ ) ?>bmi/style.css?ver=1.0.1">
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
            </div>
        </form>

        <div class="bmi__result">
            <span>Индекс массы тела</span>
            <div class="bmi__result-value"></div>
            <div class="bmi__result-info"></div>
        </div>
        <div class="bmi__chart">
            <div class="bmi__marker">&#9660;</div>
        </div>
        <div class="bmi__chart">
            <div class="bmi__range bmi__thinnes" data-bmi="14" data-title="Выраженный дефицит массы тела"></div>
            <div class="bmi__range bmi__thinnes" data-bmi="16" data-title="Выраженный дефицит массы тела">&lt; 16</div>
            <div class="bmi__range bmi__thinnes" data-bmi="18.5" data-title="Недостаточная (дефицит) масса тела">16&ndash;18.5</div>
            <div class="bmi__range bmi__normal" data-bmi="25" data-title="Норма">18.5&ndash;25</div>
            <div class="bmi__range bmi__overweight" data-bmi="30" data-title="Избыточная масса тела (предожирение)">25&ndash;30</div>
            <div class="bmi__range bmi__obese" data-bmi="35" data-title="Ожирение первой степени">30&ndash;35</div>
            <div class="bmi__range bmi__obese" data-bmi="40" data-title="Ожирение второй степени">35&ndash;40</div>
            <div class="bmi__range bmi__obese" data-bmi="42" data-title="Ожирение третьей степени (морбидное)">&gt; 40</div>
        </div>

        <script src="<?= plugin_dir_url( __FILE__ ) ?>bmi/script.js?ver=1.0.2"></script>
    </div>

<?php
    return ob_get_clean();
});

