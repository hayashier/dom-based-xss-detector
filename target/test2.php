<?php
    echo "DOM based XSS test2.<br>";
?>

<!-- David Flanagan「JavaScript」, O'REILLY, p367(訳: 村上列) -->
<html>
    <body>
        Display hash contents following...<br>
        <script>
			var name = decodeURIComponent(window.location.search.substring(1)) || "";
            document.write(name);
        </script>
    </body>
</html>