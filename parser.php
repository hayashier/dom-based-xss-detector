<?php

require_once('analysis.php');

$target_file = './target/'.((isset($argv[1]))? $argv[1]: 'test2.php');
$contents = file($target_file);
$strings = implode('', $contents);
$tokens = token_get_all($strings);

foreach ($tokens as $token) {
    if ($token[0] !== T_INLINE_HTML) continue;
    $strings = $token[1];
    for ($i = 0; $i < strlen($strings); $i++) {
        if ($strings[$i] === '<') {
            if (strpos($strings, '<script>', $i) !== $i) continue;
              $begin = strpos($strings, '<script>', $i);
              $end = strpos($strings, '</script>', $i);
              $raw_script = substr($strings, $begin, $end-$begin);
              $script = trim(substr($raw_script, strlen('<script>'), strlen($raw_script) - strlen('</script>')));

              $analyzer = new Analyzer($script);
              for ($j = 0; $j < strlen($script); $j++) {
                $analyzer->analyze($script[$j], $j);
              }
              $i += strlen($script);
        }
    }
}
