<?php
    echo "DOM based XSS test2.<br>";
?>

<html>
    <body>
        Display hash contents following...<br>
        <script>
			var name = decodeURIComponent(window.location.search.substring(1)) || "";
            document.write(name);
        </script>
    </body>
</html>