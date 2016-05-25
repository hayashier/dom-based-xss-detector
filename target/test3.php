<?php
    echo "DOM based XSS test3.<br>";
?>

<html>
    <body>
        Display hash contents following...<br>
        <script>
			document.URL.match(/name=([^&]*)/);
            document.write(unescape(RegExp.$1));
        </script>
    </body>
</html>