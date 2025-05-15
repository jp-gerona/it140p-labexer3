<?php

function get_count($name,$code)
{
	$items = [
		"2022153329"=>"Julian Peter Gerona",
		"2022151535"=>"Jan Gabriel Rea",
		"2022153255"=>"Carl Francis Alcantara",
		"2022152009"=>"Luis Gerard Tiongco"
	];
	
	foreach($items as $item=>$count)
	{
		if(($item==$name) && ($code =="malayan2025"))
		{
			return $count. " - " .$item;
			break;
		}
                                    
	}
        return "No student info to be found for:"." ".$name;        
}

function calculate_($name, $code)
{
}