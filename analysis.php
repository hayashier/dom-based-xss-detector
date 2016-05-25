<?php

class Analyzer {
    public $script = '';
    public $chara = '';

    public $URL_PARSE_PROPERTY;
    public $URL_PARSE_METHOD;
    public $URL_PARSE;

    public $CHARA_PROTOTYPE_METHOD;
    public $CHARA_METHOD;
    public $CHARA_PARSE;
    public $CHARA_PARSE_HEAD;

    public $DOM_SINK;
    public $DOM_SINK_HEAD;

    public $MEASURAMENT;
    public $ESCAPE_FUNCTION;
    public $SINK_CLASSIFY;
    public $DOM_DOCUMENT_SINK;


    function __construct($script) {
        require_once('url.php');
        require_once('chara.php');
        require_once('sink.php');
        require_once('sink_classify.php');
        require_once('escape.php');
        require_once('measurament.php');

        // Possible URL sources of DOM based XSS
        $this->URL_PARSE_PROPERTY = $URL_PARSE_PROPERTY;
        $this->URL_PARSE_METHOD = $URL_PARSE_METHOD;
        $this->URL_PARSE = $URL_PARSE;

        // Possible strings sources of DOM based XSS
        $this->CHARA_PROTOTYPE_METHOD = $CHARA_PROTOTYPE_METHOD;
        $this->CHARA_METHOD = $CHARA_METHOD;
        $this->CHARA_PARSE = $CHARA_PARSE;
        $this->CHARA_PARSE_HEAD = $CHARA_PARSE_HEAD;

        $this->DOM_SINK = $DOM_SINK;
        $this->DOM_SINK_HEAD = $DOM_SINK_HEAD;

        $this->MEASURAMENT = $MEASURAMENT;
        $this->ESCAPE_FUNCTION = $ESCAPE_FUNCTION;
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
                        $result = $this->parse_argument($argument, $match_sink, $index);
                        if ($result) {
                            var_dump($match_sink);var_dump($result[0]);
                        }
                    }
                    break;
                }
            }
        }
    }

    private function judge_sink($character, $index) {
        if (in_array($character, $this->DOM_SINK_HEAD)) {
            return $this->search_array($this->DOM_SINK, $index);
        }

        return false;
    }

    private function parse_argument($arg, $match_sink, $index) {
        $result = array();
        for ($i = 0; $i < strlen($arg); $i++) {
            // Parse URL and judge whether DOM based XSS source.
            if ($arg[$i] === 'l') { // 'l' is  head of 'location.*' of JavaScript method
                $url_source = $this->search_array($this->URL_PARSE, $index + strlen($match_sink) + $i + 1);
                if ($url_source) {
                    $result[] = $url_source;
                }
            }

            // Parse strings and judge whether DOM based XSS source.
            if (in_array($arg[$i], $this->CHARA_PARSE_HEAD)) {
                $strings_source = $this->search_array($this->CHARA_PARSE, $index + strlen($match_sink) + $i + 1);
                if ($strings_source) {
                    $result[] = $strings_source;
                }
            }
        }

        if (empty($result))
            return false;
        else
            return $result;
    }

    private function search_array($search, $index) {
        foreach($search as $element) {
            $compare = substr($this->script, $index, strlen($element));

            if (in_array($compare, $search)) {
                return $compare;
            }
        }

        return false;
    }
}