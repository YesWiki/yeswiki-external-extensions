<?php 

// TODO :

// Parseur XML
 
if (!defined("WIKINI_VERSION"))
{
            die ("acc&egrave;s direct interdit");
}

if (!function_exists("wakka2callbackcarto"))
{
	function parsecarto($thing)
	{
		global $wiki;
		// Info Carto 
		if ($thing == "~~")
		{
			static $carto = 0;
			static $cartocpt = 0;
			($carto % 2 ? $cartocpt++ : "");
			if ($_SESSION['location'][$wiki->GetPageTag()][$cartocpt]=='NF') {
//			if ($_SESSION['location'][$cartocpt]=='NF') {
				$msg ="(Localit&eacute; non r&eacute;f&eacute;renc&eacute;e)";
			}
			if ($_SESSION['location'][$wiki->GetPageTag()][$cartocpt]=='AF') {
//			if ($_SESSION['location'][$cartocpt]=='AF') {
				$msg ="R�sultat approch&eacute; : ".$_SESSION['location_message'][$wiki->GetPageTag()][$cartocpt]." ";
			}
						
		 	return (++$carto % 2 ? "<a name=\"MAP_".$cartocpt."\">".$msg."</a>" : " <a href=\"#topmap\">(Carte)</a>");
		}
		
		// Info Carto 
		else if ($thing == "~*~")
		{
			return "";
		}	
		
		
	}

	


    function wakka2callbackcarto($things)
    {
            $thing = $things[1];

            global $wiki;
                
			if (preg_match("/(~\*~|~~)/s", $thing)) {
				$thing=preg_replace("/<br \/>/","", $thing);
				return parsecarto($thing);
			}
                
            // if we reach this point, it must have been an accident.
            return $thing;
    }
 
}
$plugin_output_new = preg_replace_callback("/(~\*~|~~)/ms", "wakka2callbackcarto", $plugin_output_new);


