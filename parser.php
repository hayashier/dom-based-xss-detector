<?php

require_once('analysis.php');

$target_file = '.\\target\\'.((isset($argv[1]))? $argv[1]: 'test2.php');
$contents = file($target_file);
$strings = implode('', $contents);
$tokens = token_get_all($strings);

//echo '<pre>';
foreach ($tokens as $token) {
    if ($token[0] === T_INLINE_HTML) {
        $strings = $token[1];
        for ($i = 0; $i < strlen($strings); $i++) {
            if ($strings[$i] === '<') {
                if (strpos($strings, '<script>', $i) === $i) {
                    $begin = strpos($strings, '<script>', $i);
                    $end = strpos($strings, '</script>', $i);
                    $raw_script = substr($strings, $begin, $end-$begin);
                    $script = trim(substr($raw_script, strlen('<script>'), strlen($raw_script) - strlen('</script>')));

                    $analyzer = new Analyzer($script);
                    for ($i = 0; $i < strlen($script); $i++) {
                    	$analyzer->analyze($script[$i], $i);
                    }

                    $i += strlen($script);
                }
            }
        }

    }
}
//echo '</pre>';