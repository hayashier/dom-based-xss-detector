<?php
    echo "DOM based XSS test1.<br>";
?>

<html>
    <body>
        Display hash contents following...<br>
        <script>
            document.write(decodeURIComponent(location.hash));
        </script>
    </body>
</html>