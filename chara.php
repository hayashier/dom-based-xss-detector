<?php
    $CHARA_PROTOTYPE_METHOD = array(
        'big',
        'blink',
        'bold',
        'charAt',
        'charCodeAt',
        'codePointAt',
        'concat',
        'endsWith',
        'fixed',
        'fontcolor',
        'fontsize',
        'includes',
        'indexOf',
        'italics',
        'lastIndexOf',
        'link',
        'localeCompare',
        'match',
        'normalize',
        'quote',
        'repeat',
        'replace',
        'search',
        'slice',
        'small',
        'split',
        'startsWith',
        'strike',
        'sub',
        'substr',
        'substring',
        'sup',
        'toLocaleLowerCase',
        'toLocaleUpperCase',
        'toLowerCase',
        'toSource',
        'toString',
        'toUpperCase',
        'trim',
        'trimLeft',
        'trimRight',
        'valueOf'
    );

    $CHARA_METHOD = array(
        'fromCharCode',
        'fromCodePoint',
        'prototype[@@iterator]',
        'raw'
    );

    $CHARA_PARSE = array();
    foreach ($CHARA_PROTOTYPE_METHOD as $element) {
        $CHARA_PARSE[] = $element;
    }
    foreach ($CHARA_METHOD as $element) {
        $CHARA_PARSE[] = $element;
    }

    $CHARA_PARSE_HEAD = array();
    foreach ($CHARA_PARSE as $source) {
        $CHARA_PARSE_HEAD[] = $source[0];
    }
