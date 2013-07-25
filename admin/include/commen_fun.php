<?php
//echo CATEGORY;
	function file_upload($file,$folder)
	{
		//$uploaddir ='/var/www/kala/'.$folder.'/';
		print_r($file);
	 	echo $uploadfile =CATEGORY . basename($file['filename']['name']);
		if (file_exists($uploadfile))
		{
			$msg= $_FILES['filename']['name'] . ' already exists. ';
		}
		else if(($file['filename']['type']!= "application/pdf") and  ($file['filename']['type']!= "text/plain"))
		{
			$msg='Please upload only pdf or text file';
		}
		else
		{
			$msg=1;
		}
		return $msg;
	}
	
////////////////////////////////////////////////////////////
//Convert date format from d/m/y to y-m-d
//Arguments:String,char
//return: String
	function dmyToymd($dmydate, $needle="/")
	{
		$darr = array();
		$darr = split($needle, $dmydate);
		if (count($darr) == 3)
		return date("Y-m-d", mktime(0,0,0,$darr[1],$darr[0],$darr[2]));
		else
			return "2009-01-01";
	}
	
////////////////////////////////////////////////////////////

//Convert date format  from y-m-d to d/m/y
	function ymdToDmy($ymddate, $needle="-",$bit=0)
	{
		
		if($bit==1)
		$data=explode(" ",$ymddate);
		else
		$data[0]=$ymddate;
		
		
		$dat=explode($needle,$data[0]);
		$dmydate=$dat[2]."/".$dat[1]."/".$dat[0];
		return $dmydate;
	}
////////////////////////////////////////////////////////////
	
	
	
?>
