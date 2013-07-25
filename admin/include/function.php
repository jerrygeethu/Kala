<?php 

	#########################################################################################
	
	//to delete the file in folder when update the row
	function deletefile($folder,$filename)
	{
		@unlink(FILEPATH.$folder.'/'.$filename);
	}
	
	
	/********************************************************************************************/
	
										#Login#
	
	/********************************************************************************************/
	
	function check_login($str,$pwd)
	{
		$pwd=md5($pwd);
		$result='';
			$query = "select memberid from member where username = '" . $str ."' and pwd='" . $pwd ."'";
			$val = $GLOBALS['db']->query($query);
			if($val->num_rows>0)
			{
				$row = $val->fetch_assoc();
				
				$_SESSION['username']=$str;
				$_SESSION['memberid']=$row['memberid'];
				$result=1;
				
			}
			else
			{
				$result=2;
			}
			return $result;
	}
	

	/********************************************************************************************/
	
										#Manage Members#
	
	/********************************************************************************************/


	function insertmember($arr)
	{
		//$current_date=date("Y-m-d");
		$query ="insert into member(memberid,name,designation,username,pwd,date)
					values ('','" . $arr['name'] . "','" . $arr['designation'] . "','" . $arr['usrname'] . "','" . md5($arr['pwd']). "','" .CURRENT_DATE. "')";
		$result =$GLOBALS['db']->query($query);
		$id=$GLOBALS['db']->insert_id;
		return $id;
	}

	function showmember($start,$limit,$type='',$order='')
	{
		$query="select * from member order by ".$type." ".$order;
		$result1= $GLOBALS['db']->query($query);
		$totoal_count=$result1->num_rows;
		$query .= " limit  ".$start." , ".$limit;
		$s=$start;
		$value="";
		$i="";
		$f="";
		$result = $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0)
		{
			$i=$start+1;
			$f=$result->num_rows;				
			$value="<tr class=\"headding_style\">
						<td width=\"10%\" class=\"row_heading\">#</td>
						<td width=\"25%\" class=\"row_heading\"><a href=".MEMBER."?s=".$_SESSION['per_page']."&type=n&order=".$order." title=\"Click here to sort the data\">";
							if($type=='name')
							{
								$value.="<font color=\"#EE971C\">Member Name</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Member Name</font></a></td>";
							}
							
						$value.="<td width=\"30%\" class=\"row_heading\"><a href=".MEMBER."?s=".$_SESSION['per_page']."&type=d&order=".$order." title=\"Click here to sort the data\">";
							if($type=='designation')
							{
								$value.="<font color=\"#EE971C\">Designation</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Designation</font></a></td>";
							}
							
						$value.="<td width=\"15%\" class=\"row_heading\"><a href=".MEMBER."?s=".$_SESSION['per_page']."&type=j&order=".$order." title=\"Click here to sort the data\">";
							if($type=='date')
							{
								$value.="<font color=\"#EE971C\">Joinig Date</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Joinig Date</font></a></td>";
							}
							
						$value.="<td width=\"7%\" class=\"row_heading\" style=\"padding-left:18px;\">Edit</td>
						<td width=\"18%\" class=\"row_heading\">Delete</td>
					</tr>";


			while($row = $result->fetch_assoc())
			{
				$value.="<form name=\"mem\" id=\"mem\" action=\"add_member.php?s=".$_SESSION['per_page']."\" method=\"post\"><tr style=\" cursor: move;\"  class=\"td2\">";
				
				$value.="<td>".$i++."</td>";
				$value.="<td>".stripslashes(ucwords($row['name']))."</td>";
				$value.="<td>".stripslashes(ucwords($row['designation']))."</td>";
				$value.="<td>".ymdToDmy($row['date'])."</td>";
				$value.="<td>
					
						<input type=\"submit\" id=\"edit\" class=\"btn\" name=\"edit\" title=\"Click here to edit the data\" value=\"Edit\"/>&nbsp;
						<input type=\"hidden\" id=\"editid\"name=\"editid\" value=\"".$row['memberid']."\"/>";
					  
				$value.="</td>";
				$value.="<td><span style=\"cursor: pointer;\" title=\"Click here to delete the data\" onclick=\"deletefun(".$row['memberid'].",'add_member','member')\">Delete</span>&nbsp;</td>";
				$value.="</tr></form>";
			}
		}
			$data['tables']=$value;
			$data['last_count']=$i;
			$data['found_rows']=$f;
			$data['total_count']=$totoal_count;
			
			return $data;
	}
	
	function getData($id)
	{
		$query="select * from member where memberid=".$id;
		$result= $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0) 
		{
			return $row = $result->fetch_assoc();
		}
	}
	
	function editmember($arr)
	{
		$pas='';
		if(isset($arr['edit_id']) and $arr['edit_id']>0 )
		{	
			if($arr['pwd']!='***' and $arr['pwd']!='')
			{
				$pas=", pwd = '".md5($arr['pwd'])."'";
			}
						
			$query = "UPDATE member SET name = '".$arr['name']."' , designation='".$arr['designation']."' ,username = '" . $arr['usrname'] . "' ".$pas." where memberid = '" . $arr['edit_id'] ."'";
			$val=$GLOBALS['db']->query($query);
			return $val;
			
		}	
	}
	function deletemember($delid)
	{
		if(isset($delid) and $delid>0)
		{
				$query = "delete from member where memberid = '" . $delid ."'";
				$val = $GLOBALS['db']->query($query);
				
		}
	}
	
	//for user avilability (commen.js and checkusr.php)
	function post_check_usrname($str,$memberid)
	{
		if($memberid!='')
		{
			$memberid=" and memberid != '".$memberid."'";
		}
		$query = "select username from member where username = '" . $str ."'".$memberid;
		$val = $GLOBALS['db']->query($query);
		if($val->num_rows>0)
		{
			$value= "1";
		}
		else
		{
			$value= "2";
		}
		return $value;
	}
	
	
	/********************************************************************************************/
	
										#Manage Publications#
	
	/********************************************************************************************/
	
	function insertcategory($arr,$files)
	{
		$query ="insert into category(id,categoryname,articlename,date)
					values ('','" . $arr['categoryname'] . "','" . $arr['articlename'] . "','" .CURRENT_DATE. "')";
		$result =$GLOBALS['db']->query($query);
		
		$id=$GLOBALS['db']->insert_id;
		
		$filename=$id."_".$files['filename']['name'];
		
		$uploaddir =CATEGORY;
		
		$uploadfile = $uploaddir . $filename;
		
		move_uploaded_file($files['filename']['tmp_name'], $uploadfile);
		
		
		$query = "UPDATE category SET filename = '".$filename."'  where id = '" . $id ."'";
			$val=$GLOBALS['db']->query($query);
		return $id;
	}
	
	function showcategory($start,$limit,$type='',$order='')
	{
		$query="select * from category order by ".$type." ".$order;
		$result1= $GLOBALS['db']->query($query);
		$totoal_count=$result1->num_rows;
		$query .= " limit  ".$start." , ".$limit;
		$s=$start;
		$value="";
		$i="";
		$f="";
		$result = $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0)
		{
			$i=$start+1;
			$f=$result->num_rows;
			
			$value="<tr class=\"headding_style\">
						<td width=\"10%\" class=\"row_heading\">#</td>
						<td width=\"25%\" class=\"row_heading\"><a href=".ARTICLE."?s=".$_SESSION['per_page']."&type=c&order=".$order." title=\"Click here to sort the data\">";
							if($type=='categoryname')
							{
								$value.="<font color=\"#EE971C\">Category Name</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Category Name</font></a></td>";
							}
						
						$value.="<td width=\"25%\" class=\"row_heading\"><a href=".ARTICLE."?s=".$_SESSION['per_page']."&type=a&order=".$order." title=\"Click here to sort the data\">";
							if($type=='articlename')
							{
								$value.="<font color=\"#EE971C\">Article Name</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Article Name</font></a></td>";
							}
							
						$value.="<td width=\"25%\" class=\"row_heading\"><a href=".ARTICLE."?s=".$_SESSION['per_page']."&type=f&order=".$order." title=\"Click here to sort the data\">";
						if($type=='filename')
							{
								$value.="<font color=\"#EE971C\">Files</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Files</font></a></td>";
							}
							
						$value.="<td width=\"25%\" class=\"row_heading\"><a href=".ARTICLE."?s=".$_SESSION['per_page']."&type=ed&order=".$order.">";
							if($type=='date')
							{
								$value.="<font color=\"#EE971C\">Entry Date</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#FFFFFF\">Entry Date</font></a></td>";
							}
						
						$value.="<td width=\"7%\" class=\"row_heading\" style=\"padding-left:18px;\">Edit</td>
						<td width=\"18%\" class=\"row_heading\">Delete</td>
					</tr>";
			while($row = $result->fetch_assoc())
			{
				$fname=explode("_",$row['filename']);
				
				$value.="<form name=\"mem\" id=\"mem\" action=\"manage_publications.php?s=".$_SESSION['per_page']."\" method=\"post\"><tr style=\" cursor: move;\"  class=\"td2\" id=\"45\">";
				$value.="<td>".$i++."</td>";
				$value.="<td>".stripslashes(ucwords($row['categoryname']))."</td>";
				$value.="<td>".stripslashes(ucwords($row['articlename']))."</td>";
				$value.="<td><a style='color: #7A5020; text-decoration: none; font-weight:bold;' href='".BASEPATH."category/".$row['filename']."'>".$fname[1]."</a></td>";
				$value.="<td>".ymdToDmy($row['date'])."</td>";
				
				$value.="<td width=\"7%\"  align=\"right\">
					
							<input type=\"submit\" id=\"edit\" class=\"btn\" name=\"edit\" title=\"Click here to edit the data\" value=\"Edit\"/>
							<input type=\"hidden\" id=\"editid\"name=\"editid\" value=\"".$row['id']."\"/>
					  
						</td>";
				$value.="<td width=\"18%\" align=\"right\"><span style=\"cursor: pointer;\" title=\"Click here to delete the data\" onclick=\"deletefun(".$row['id'].",'manage_publications','your category')\">Delete</span>&nbsp;</td>";
				$value.="</tr></form>";
			}
		}
			$data['tables']=$value;
			$data['last_count']=$i;
			$data['found_rows']=$f;
			$data['total_count']=$totoal_count;
			
			return $data;
	}
	
	function cat_getData($id)
	{
		$query="select * from category where id=".$id;
		$result= $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0) 
		{
			return $row = $result->fetch_assoc();
		}
	}
	
	function editcategory($arr,$files)
	{
		if(isset($arr['edit_id']) and $arr['edit_id']>0 )
		{	
			$filename="";
		
			if($files!='')
			{		
				$filename=$arr['edit_id']."_".$files['filename']['name'];
		
				$uploaddir =CATEGORY;
				
				$uploadfile = $uploaddir . $filename;
				
				deletefile('category',$arr['old_file']);
				
				move_uploaded_file($files['filename']['tmp_name'], $uploadfile);
				
				$filename=", filename = '".$filename."'";
			}		
			$query = "UPDATE category SET categoryname = '".$arr['categoryname']."' , articlename='".$arr['articlename'] . "' ".$filename." where id = '" . $arr['edit_id'] ."'";
			$val=$GLOBALS['db']->query($query);
			return $val;
		}	
	}
	function deletecategory($delid,$filename)
	{
		if(isset($delid) and $delid>0)
		{
			$query = "delete from category where id = '" . $delid ."'";
			$val = $GLOBALS['db']->query($query);
			@unlink(CATEGORY.$filename);
		}
	}
	
	
	
	/********************************************************************************************/
	
										#Manage Events#
	
	/********************************************************************************************/	
	
	function insertevent($arr,$date1)
	{
		$query ="insert into event(eventid,eventname,date,description,currentdate)
					values ('','" . $arr['eventname'] . "','" . $date1 . "','" . $arr['description'] . "','" .CURRENT_DATE. "')";
		$result =$GLOBALS['db']->query($query);
		$id=$GLOBALS['db']->insert_id;
		return $id;
	}
	
	function showevent($start,$limit,$type='',$order='')
	{
		$query="select * from event order by ".$type." ".$order;
		$result1= $GLOBALS['db']->query($query);
		$totoal_count=$result1->num_rows;
		$query .= " limit  ".$start." , ".$limit;
		$s=$start;
		$value="";
		$i="";
		$f="";
		$result = $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0)
		{
			$i=$start+1;
			$f=$result->num_rows;
			
			$value="<tr class=\"headding_style\">
						<td width=\"10%\" class=\"row_heading\">#</td>
						<td width=\"25%\" class=\"row_heading\"><a href=".EVENT."?s=".$_SESSION['per_page']."&type=e&order=".$order.">";
							if($type=='eventname')
							{
								$value.="<font color=\"#EE971C\"> Event Name</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\"> Event Name</font></a></td>";
							}
						$value.="<td width=\"35%\" class=\"row_heading\"><a href=".EVENT."?s=".$_SESSION['per_page']."&type=d&order=".$order." title=\"Click here to sort the data\">";
						
							if($type=='description')
							{
								$value.="<font color=\"#EE971C\">Description</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\">Description</font></a></td>";
							}
						$value.="<td width=\"25%\" class=\"row_heading\"><a href=".EVENT."?s=".$_SESSION['per_page']."&type=ed&order=".$order." title=\"Click here to sort the data\">";
							if($type=='date')
							{
								$value.="<font color=\"#EE971C\"> Event Date</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\"> Event Date</font></a></td>";
							}
						$value.="<td width=\"7%\" class=\"row_heading headding_style1\" style=\"padding-left:18px;\">Edit</td>
						<td width=\"18%\" class=\"row_heading headding_style1\">Delete</td>
					</tr>";
			
			while($row = $result->fetch_assoc())
			{
				$value.="<form name=\"eve\" id=\"eve\" action=\"manage_events.php?s=".$_SESSION['per_page']."\" method=\"post\"><tr style=\" cursor: move;\"  class=\"td2\" id=\"45\" title=\"Click here to sort the data\">";
				$value.="<td>".$i++."</td>";
				$value.="<td>".stripslashes(ucwords($row['eventname']))."</td>";
				$value.="<td>".stripslashes(ucwords($row['description']))."</td>";
				$value.="<td>".ymdtodmy($row['date'])."</td>";
				
				$value.="<td width=\"7%\"  align=\"right\">
					
						<input type=\"submit\" id=\"edit\" class=\"btn\" name=\"edit\" title=\"Click here to edit the data\" value=\"Edit\"/>
					<input type=\"hidden\" id=\"editid\"name=\"editid\" value=\"".$row['eventid']."\"/>
					  
				</td>";
				$value.="<td width=\"18%\" align=\"right\"><span style=\"cursor: pointer;\" title=\"Click here to delete the data\" onclick=\"deletefun(".$row['eventid'].",'manage_events','your event')\">Delete</span>&nbsp;</td>";
				$value.="</tr>	</form>";
			}
		}
			$data['tables']=$value;
			$data['last_count']=$i;
			$data['found_rows']=$f;
			$data['total_count']=$totoal_count;
			
			return $data;
	}
	
	function event_getData($id)
	{
		$query="select * from event where eventid=".$id;
		$result= $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0) 
		{
			return $row = $result->fetch_assoc();
		}
	}
	
	function editevent($arr,$date1)
	{
		if(isset($arr['edit_id']) and $arr['edit_id']>0 )
		{	
			$query = "UPDATE event SET eventname = '".$arr['eventname']."' , date='".$date1."' ,description = '".$arr['description']."' where eventid = '" . $arr['edit_id'] ."'";
			$val=$GLOBALS['db']->query($query);
			return $val;
		}	
	}
	
	function deletevent($delid)
	{
		if(isset($delid) and $delid>0)
		{
				$query = "delete from event where eventid = '" . $delid ."'";
				$val = $GLOBALS['db']->query($query);
				
		}
	}
	
	/********************************************************************************************/
	
										#Manage Activities#
	
	/********************************************************************************************/	
	
	function insertactivity($arr,$files)
	{
		$query ="insert into testimony(testimonyid,name,date)
					values ('','" . $arr['name'] . "','" .CURRENT_DATE. "')";
		$result =$GLOBALS['db']->query($query);
		
		$id=$GLOBALS['db']->insert_id;
		
		$filename=$id."_".$files['filename']['name'];
		
		$uploaddir =TESTIMONY;
		$uploadfile = $uploaddir . $filename;
		
		move_uploaded_file($files['filename']['tmp_name'], $uploadfile);
				
		$query = "UPDATE testimony SET filename = '".$filename."'  where testimonyid = '" . $id ."'";
		$val=$GLOBALS['db']->query($query);
		
		return $id;
	}
	
	function showactivity($start,$limit,$type='',$order='')
	{
		$query="select * from testimony order by ".$type." ".$order;
		$result1= $GLOBALS['db']->query($query);
		$totoal_count=$result1->num_rows;
		$query .= " limit  ".$start." , ".$limit;
		$s=$start;
		$value="";
		$i="";
		$f="";
		$result = $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0)
		{
			$i=$start+1;
			$f=$result->num_rows;
			
			$value="<tr class=\"headding_style\">
						<td width=\"10%\" class=\"row_heading\">#</td>
						<td width=\"20%\" class=\"row_heading\"><a href=".ACTIVITY."?s=".$_SESSION['per_page']."&type=n&order=".$order." title=\"Click here to sort the data\">";
							if($type=='name')
							{
								$value.="<font color=\"#EE971C\">Activity Name</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\">Activity Name</font></a></td>";
							}
						$value.="<td width=\"35%\" class=\"row_heading\"><a href=".ACTIVITY."?s=".$_SESSION['per_page']."&type=f&order=".$order." title=\"Click here to sort the data\">";
						
							if($type=='filename')
							{
								$value.="<font color=\"#EE971C\">Files</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\">Files</font></a></td>";
							}
						$value.="<td width=\"10%\" class=\"row_heading\"><a href=".ACTIVITY."?s=".$_SESSION['per_page']."&type=ad&order=".$order." title=\"Click here to sort the data\">";
							if($type=='date')
							{
								$value.="<font color=\"#EE971C\">Entry Date</font></a></td>";
							}
							else
							{
								$value.="<font color=\"#ffffff\">Entry Date</font></a></td>";
							}
						$value.="<td width=\"7%\" class=\"row_heading headding_style1\" style=\"padding-left:18px;\">Edit</td>
						<td width=\"18%\" class=\"row_heading headding_style1\">Delete</td>
					</tr>";
			
			while($row = $result->fetch_assoc())
			{
				$fname=explode("_",$row['filename']);
				
				$value.="<form name=\"act\" id=\"act\" action=\"manage_activities.php?s=".$_SESSION['per_page']."\" method=\"post\"><tr style=\" cursor: move;\"  class=\"td2\" id=\"45\">";
				$value.="<td>".$i++."</td>";
				$value.="<td>".stripslashes(ucwords($row['name']))."</td>";
				$value.="<td><a style='color: #7A5020; text-decoration: none; font-weight:bold;' href='".BASEPATH."testimony/".$row['filename']."'>".$fname[1]."</a></td>";
				$value.="<td>".ymdtodmy($row['date'])."</td>";
				
				$value.="<td>
					
						<input type=\"submit\" id=\"edit\" class=\"btn\" name=\"edit\" title=\"Click here to edit the data\" value=\"Edit\"/>
						<input type=\"hidden\" id=\"editid\"name=\"editid\" value=\"".$row['testimonyid']."\"/>
					  
				</td>";
				$value.="<td><span style=\"cursor: pointer;\" title=\"Click here to delete the data\" onclick=\"deletefun(".$row['testimonyid'].",'manage_activities','your activity')\">Delete</span>&nbsp;</td>";
				$value.="</tr></form>";
			}
		}
			$data['tables']=$value;
			$data['last_count']=$i;
			$data['found_rows']=$f;
			$data['total_count']=$totoal_count;
			
			return $data;
	}
	
	function getData_activity($id)
	{
		$query="select * from testimony where testimonyid=".$id;
		$result= $GLOBALS['db']->query($query);
		if(isset($result) and $result->num_rows>0) 
		{
			return $row = $result->fetch_assoc();
		}
	}
	
	function editactivity($arr,$files)
	{
		if(isset($arr['edit_id']) and $arr['edit_id']>0 )
		{	
			$filename="";
		
			if($files!='')
			{		
				$filename=$arr['edit_id']."_".$files['filename']['name'];
		
				$uploaddir =TESTIMONY;
				
				$uploadfile = $uploaddir . $filename;
				
				deletefile('testimony',$arr['old_file']);
				
				move_uploaded_file($files['filename']['tmp_name'], $uploadfile);
				
				$filename=", filename = '".$filename."'";
			}		
				
			$query = "UPDATE testimony SET name = '".$arr['name']."' ".$filename ." where testimonyid = '" . $arr['edit_id'] ."'";
			$val=$GLOBALS['db']->query($query);
			return $val;
			
		}	
	}
	
	function deleteactivity($delid,$filename)
	{
		if(isset($delid) and $delid>0)
		{
			$query = "delete from testimony where testimonyid = '" . $delid ."'";
			$val = $GLOBALS['db']->query($query);
			@unlink(TESTIMONY.$filename);
		}
	}

?>
