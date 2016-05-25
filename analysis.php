<?php

class Analyzer {
    public $script = '';
    public $chara = '';

    public $URL_PARSE_PROPERTY;
    public $URL_PARSE_METHOD;
    public $DOM_SINK;
    public $DOM_SINK_HEAD;
    public $MEASURAMENT;
    public $ESCAPE_FUNCTION;
    public $CHARA_PROTOTYPE_METHOD;
    public $CHARA_METHOD;
    public $SINK_CLASSIFY;
    public $DOM_DOCUMENT_SINK;


    function __construct($script) {
        require_once('url.php');
        require_once('chara.php');
        require_once('sink.php');
        require_once('sink_classify.php');
        require_once('escape.php');
        require_once('measurament.php');

        $this->URL_PARSE_PROPERTY = $URL_PARSE_PROPERTY;
        $this->URL_PARSE_METHOD = $URL_PARSE_METHOD;
        $this->DOM_SINK = $DOM_SINK;
        $this->DOM_SINK_HEAD = $DOM_SINK_HEAD;
        $this->MEASURAMENT = $MEASURAMENT;
        $this->ESCAPE_FUNCTION = $ESCAPE_FUNCTION;
        $this->CHARA_PROTOTYPE_METHOD = $CHARA_PROTOTYPE_METHOD;
        $this->CHARA_METHOD = $CHARA_METHOD;
        $this->SINK_CLASSIFY = $SINK_CLASSIFY;
        $this->DOM_DOCUMENT_SINK = $DOM_DOCUMENT_SINK;

        $this->script = $script;
    }

    public function analyze($character, $index) {
        $position = $index;
        $match_sink = $this->judge_sink($character, $index);
        if ($match_sink) {
            $position = $position + strlen($match_sink) + 1;
            for ($i = $position; $i < strlen($this->script); $i++) {
                $nest = 1;
                if ($this->script[$i] === '(') {
                    $nest++;
                }
                if ($this->script[$i] === ')') {
                    $nest--;
                }

                if ($nest === 0) {
                    $argument_strings = substr($this->script, $position, $i - $position + 1);
                    $arguments = explode(',', $argument_strings);

                    foreach($arguments as $argument) {
                        var_dump($argument);
                    }
                    break;
                }
            }
        }
    }

    private function judge_sink($character, $index) {
        if (in_array($character, $this->DOM_SINK_HEAD)) {
            foreach($this->DOM_SINK as $sink) {
                $compare = substr($this->script, $index, strlen($sink));

                if (in_array($compare, $this->DOM_SINK)) {
                    return $compare;
                }
            }
        }

        return false;
    }
}