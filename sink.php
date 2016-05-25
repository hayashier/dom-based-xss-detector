<?php
    $DOM_SINK = array(
        'innerHTML',
        'outerHTML',
        'setAttribute',
        'setTimeout',
        'setInterval',
        'new Function',
        'url',
        'expression',
        'write',
        'writeln'
    );
    $DOM_SINK_HEAD = array();

    foreach ($DOM_SINK as $sink) {
        $DOM_SINK_HEAD[] = $sink[0];
    }