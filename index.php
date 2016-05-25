<?php
	echo "DOM based XSS test.";
?>

<html>
	<body>
		Display hash contents following...
		<script>
			document.write(decodeURIComponent(location.hash));
		</script>
	</body>
</html>