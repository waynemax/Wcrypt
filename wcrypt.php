<?php

/*
		name: "wcrypt" encryption (01.08.2015)
		date of creation file - 09.09.2015
		last edit time: 22.11.2015
		Max Wayne
		wcrypt.php
		version : 2.1
		iamvaustin@gmail.com	
	 								*/
		$___XSTROKE___ = array();
		$___YSTROKE___ = array();
		$___XSTROKE2___ = array();
		$___YSTROKE2___ = array();
				
		$stroke_num_array_first = 20;
		$stroke_num_array_last = 39;
		
		require_once("w_data.php");
		
		//wcrypts functions
		
		class wcrypt {
				
				const version = 2.1;
				
				private static function mb_ord_utf8($stroke){
					$ord = ord(substr($stroke, $off, 0x0001)); 
					if($ord >= 128){      
						if($ord < 224) $byte = 0x0002;             
						else if ($ord < 240) $byte = 0x0003;        
						else if ($ord < 248) $byte = 0x0004;   
						$codetemp = $ord - 192 - ($byte > 0x0002 ? 32 : 0) - ($byte > 0x0003 ? 16 : 0);
						for($i = 0x0002; $i <= $byte; $i++){
							$off++;
							$code2 = ord(substr($stroke, $off, 0x0001)) - 128;     
							$codetemp = $codetemp*64 + $code2;
						}
						$ord = $codetemp;
					}
					return $ord;
				}	
			
				function wc_en($str,$db){
					global 	$stroke_num_array_first,
							$stroke_num_array_last;
					if($db){
						global 	$___YSTROKE___2,
								$___XSTROKE___2;
								$___YSTROKE___ = $___YSTROKE___2;
								$___XSTROKE___ = $___XSTROKE___2;
					} else {
						global $___YSTROKE___,$___XSTROKE___;
					}

					$stroke_num = mt_rand($stroke_num_array_first,$stroke_num_array_last);
					$strokeToString = $stroke_num.'';			
					$key = '';
					$array = array();
					$pattern = '423';
					$counter = mb_strlen($pattern)-1;

					for($i=0; $i<16; $i++){
						$z = rand(0,$counter);
						$key.= mb_substr(($pattern),$z,1,"UTF-8");
						array_push($array,mb_substr(($pattern),$z,1,"UTF-8"));
					}

					$md = array($key,$array);

					for($i=0; $i < (mb_strlen($str,"UTF-8")); $i++){
						$res.= str_replace(array('0000','000','00','.','0101','1111','111'),array('9','8','7','|','-','V',':'),(decbin($this->mb_ord_utf8(mb_substr($str,$i,1,"UTF-8"))))).'5';
					} 

					$v = 0;
					
					for($j=0;$j < mb_strlen($res,'UTF-8');$j++){
						if($v == 15) $v = 0;
						if($res[$j]=='1') $res[$j] = $md[0][$v];	
						$v++;
					}

					$res = str_replace($___XSTROKE___[$stroke_num],$___YSTROKE___[$stroke_num],$res);
					
					return $strokeToString[0].join('',array_slice($md[1],0,8)).$res.join('',array_slice($md[1],8,8)).$strokeToString[1];
				}
			
				function wc_de($str,$db){

					$strokeToString1 = intval(mb_substr($str,0,1));
					$strokeToString2 = intval(mb_substr($str,mb_strlen($str)-1,1));
					$stroke_num = intval($strokeToString1.$strokeToString2);
					$str = mb_substr($str,1,mb_strlen($str)-2);

					global $stroke_num_array_first,$stroke_num_array_last;

					if($db){
						global 	$___YSTROKE___2,
								$___XSTROKE___2;
								$___YSTROKE___ = $___YSTROKE___2;
								$___XSTROKE___ = $___XSTROKE___2;
					} else {
						global 	$___YSTROKE___,
								$___XSTROKE___;
					}

					$array = array();
					$result = array();
					$v = 0;

					for($j=0;$j < mb_strlen($str,'UTF-8');$j++){
						array_push($array,$str[$j]);
					}

					$str = str_replace($___YSTROKE___[$stroke_num],$___XSTROKE___[$stroke_num],join('',array_slice($array,8,mb_strlen($str,'UTF-8')-16)));
					$md = join('',array_slice($array,0,8)).join('',array_slice($array,count($array)-8,8));

					for($j=0; $j < mb_strlen($str,'UTF-8'); $j++){
						if($v == 15) $v = 0;
						if($md[$v]==$str[$j]) $str[$j] = '1';	
						$v++;
					}

					$res = explode(5, $str);
					$res = array_slice($res,0,count($res)-1);

					foreach($res as $value){
						array_push($result,html_entity_decode('&#'.bindec((str_replace(array('9','8','7','|','-','V',':'),array('0000','000','00','','0101','1111','111'),$value))).';',ENT_NOQUOTES,'UTF-8'));
					}

					return join('',$result);
				}
		
		}
?>