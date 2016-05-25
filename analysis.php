<?php

require_once('url.php');
require_once('chara.php');
require_once('sink.php');
require_once('escape.php');
require_once('measurament.php');
require_once('analysis.php');


class Analyzer {
    public $script = '';
    public $chara = '';

    function __constructor($script) {
        $this->script = $script;
    }
    function analyze($character) {
        var_dump($character);
    }
}