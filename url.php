<?php
    $loc = 'window.location.';

    $URL_PARSE_PROPERTY = array(
        $loc.'hash',
        $loc.'host',
        $loc.'hostname',
        $loc.'href',
        $loc.'pathname',
        $loc.'port',
        $loc.'protocol',
        $loc.'search'
    );

    $URL_PARSE_METHOD = array(
        //$loc.'assign',
        //$loc.'reload',
        //$loc.'replace',
        $loc.'toString'
    );