<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
	<?php
	//echo $template;exit;
	$view = json_encode($template);
    echo htmlspecialchars_decode($view);
	
?>




	
</body>

</html>