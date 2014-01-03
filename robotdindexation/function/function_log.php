<?php
function JEREM_log($variable, $lib = '')
	{
			if(!file_exists("JEREM.log"))
			file_put_contents("JEREM.log", "");
		
			if(is_array($variable)) 
			{
				foreach ($variable as $variabless => $value) 
				{
					file_put_contents('JEREM.log', '-----'.''.$variabless.' => '.$value.' \r\n'. 		file_get_contents('JEREM.log'));
				}
			
					file_put_contents('JEREM.log', date('[j/m/y H:i:s]').' - '.$lib.' = \r\n'. file_get_contents('JEREM.log'));
			}
			
		else
		{
			file_put_contents('JEREM.log', date('[j/m/y H:i:s]').' - '.$lib.' = '.$variable.' \r\n'. file_get_contents('JEREM.log'));
			echo '<br/>';
		}
	}
?>