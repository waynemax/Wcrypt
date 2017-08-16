<?
	require_once("wcrypt.php");
	$wcrypt = new wcrypt;
	$a =  $wcrypt->wc_en("php encode example");
?>
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>wcrypt</title>
		<script src="w_data.js"></script>
		<script src="wcrypt.js"></script>
	</head>
	<body>
	<script>
		var strOut = [];
		window.onload = function(){
				strOut.push("<?=$a;?>");
				strOut.push("<?=$wcrypt->wc_de($a);?>");
				var jsIn = wcrypt_encode("js encode example");
				strOut.push(jsIn, wcrypt_decode(jsIn));
				document.body.innerHTML = strOut.join('<br>');
		};
		</script>
	</body>
</html>
