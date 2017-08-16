<?php
/*
	 name: "wcrypt" encryption (01.08.2015)
	 date of creation file - 09.09.2015
	 last edit time: 13.11.2015
	 Max Wayne
	 w_data.php
	 iamvaustin@gmail.com	
	 						*/
		
	function wCryptDataGeneration($___XSTROKE___,$___YSTROKE___,$pathPhp,$pathJS){
		$outPHP = "<? \n";
		$outPHP.= "/*\n	name: wcrypt encryption (01.08.2015)\n	date of creation file - ".date('l jS \of F Y h:i:s A')."\n	last edit time: 12.11.2015\n	Max Wayne\n	".$pathPhp."\n	iamvaustin@gmail.com\n*/\n\n";
		$outPHP.="\n /* Original Hash */ \n\n";
		$outJS = "var __x__ = new Array();\nvar __y__ = new Array();\n";
		for($cc=20; $cc<40; $cc++){
			shuffle($___XSTROKE___);
			$f = '$'."___XSTROKE___['".$cc."'] = json_decode('".json_encode($___XSTROKE___)."'); \n";
			$outJS.= "	__x__['".$cc."'] = ".json_encode($___XSTROKE___).";\n";
			$outPHP.=$f;
		}
		for($cc=20; $cc<40; $cc++){
			shuffle($___YSTROKE___);
			$f = '$'."___YSTROKE___['".$cc."'] = json_decode('".json_encode($___YSTROKE___)."'); \n";
			$outJS.= "	__y__['".$cc."'] = ".json_encode($___YSTROKE___).";\n";
			$outPHP.=$f;
		}
		/*databases*/
		$outPHP.="\n /* Hash for Databases */ \n\n";
		for($cc=20; $cc<40; $cc++){
			shuffle($___XSTROKE___);
			$f = '$'."___XSTROKE___2['".$cc."'] = json_decode('".json_encode($___XSTROKE___)."'); \n";
			$outPHP.=$f;
		}
		for($cc=20; $cc<40; $cc++){
			shuffle($___YSTROKE___);
			$f = '$'."___YSTROKE___2['".$cc."'] = json_decode('".json_encode($___YSTROKE___)."'); \n";
			$outPHP.=$f;
		}
		$outPHP.= "?>";
		file_put_contents($pathPhp,$outPHP);
		file_put_contents($pathJS,$outJS);
	}
	
	/* Для обновления полной базы хеширования использовать функцию: */
	// # ВНИМАНИЕ! ВСЕ ДАННЫЕ, ЗАШИФРОВАННЫЕ С ПОМОЩЬЮ ПРЕДЫДУЩЕГО НАБОРА НЕВОЗМОЖНО БУДЕТ ВОССТАНОВИТЬ!
	$installHASH = false; //true - запустить
	$thisPath = "/";
	$filenamePHP = $thisPath."datacrypt.php";
	$filenameJS = $thisPath."w_data.js";
	if($installHASH){
		$___XSTROKE___ = array('02','03','04','05','06','22','33','44','32','54','76','25','38','23','28','29','24','93','39','35','45','46','94','26','43','34','42','44','44','52','82');
		$___YSTROKE___ = array('F','B','E','D','C','G','H','I','P','Q','Y','J','T','X','Z','M','N','O','S','U','L','=','_','?','.','#','@',',','!','^','*');
		wCryptDataGeneration($___XSTROKE___,$___YSTROKE___,$filenamePHP,$filenameJS);
		print("functions updated");
		exit;
	}
	include_once($filenamePHP);
?>