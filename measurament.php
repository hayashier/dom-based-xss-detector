<?php
    $MEASURAMENT = array(
        'HTML' => array(
            'Encoder.encodeForHTML',
            'Encoder.encodeForJS'
        ),

        'HTML_ATTRIBUTE' => array(
            'Encoder.encodeForJS'
        ),

        'EVENT_HANDLER_OR_JS' => array(
            //???
        ),

        'CSS_ATTRIBUTE' => array(
            'Encoder.encodeForURL'
        ),

        'URL_ATTRIBUTE' => array(
            'Encoder.encodeForURL',
            'Encoder.encodeForJS'
        ),

        'ELEMENT' => array(
            'textContent'
        )
    );