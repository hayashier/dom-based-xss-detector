<?php
    $SINK_CLASSIFY = array(
        'HTML' => array(
            'innerHTML',
            'outerHTML'
        ),

        'EVENT_HANDLRE_OR_JS' => array(
            'setAttribute',
            'setTimeout',
            'setInterval',
            'new Function'
        ),

        'CSS_ATTRIBUTE' => array(
            'url',
            'expression'
        )
    );

    $DOM_DOCUMENT_SINK = array(
        'write',
        'writeln'
    );