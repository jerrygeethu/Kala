<?php 
	session_start();

	if($_SESSION['username']=='')
	{
		header('Location: ../user/home.php');
		exit;
	}
	require_once('include/database.php');
	require_once('include/index.php');
	require_once('include/function.php');
	require_once('include/commen_fun.php');
	
	
	
	$requird=array("eventname","date1","description");
	$requered2[]="";
	$flag=1;
	$insert='';
	$msg="";
	$update_val="";
	$date1="";
	
	$btnname='btnsave';
	
	if(isset($_POST['edit']) and $_POST['edit']!='') 
	{
		$row = event_getData($_POST['editid']);
	}
	
	
	
	if(isset($_POST['btnsave']))
	{
		foreach($requird as $key=>$value)
		{
			  
			   if($_POST[$value]=='')
			   {
					   $requered2[]=$value;
					   $flag=0;
			   }
			   	if($_POST['date1']=='date1')
				{
					 $requered2[]='date1';
						   $flag=0;
				}
					else
				{
					$date1=dmyToymd($_POST['date1']);
					//$flag=1;
				}
			   
		}
	
			
		
		if($flag==1)
		{
			
			$insert=insertevent($_POST,$date1);
			$msg="Succesfully inserted the record";
			$_POST='';
		}
	} 
	if(isset($_POST['btnup']) and $_POST['btnup']!='') 
	{
		$btnname='btnup';
		foreach($requird as $key=>$value)
		{
			  
			   if($_POST[$value]=='')
			   {
					   $requered2[]=$value;
					   $flag=0;
			   }
			  
		}
			
		if($flag==1)
		{
			$date1=dmyToymd($_POST['date1']);
			$update_val=editevent($_POST,$date1);
			if($update_val==1)
			{
				$btnname='btnsave';
				$msg="Succesfully modified the record";
			}
			
			$_POST='';
		}
	}
	if(isset($_GET['id']) and $_GET['id']!='') 
	{
		deletevent($_GET['id']);
	}
	
	
	if((isset($_GET['s']))&&($_GET['s']!=""))
	{
		$start=$_GET['s'];
	}
	else
	{
		$start=0;
	}
	if($start<0)
		$start=0;
	$no_of_rows=5;
	$pre=$start-$no_of_rows;
	$next=$start+$no_of_rows;	
	
	$_SESSION['per_page']=$start;	
	
	$type='eventid ';
	if(isset($_GET['type']))
	{
		switch($_GET['type'])
		{
			case 'e':
				$type='eventname';
				break;
			case 'd':
				$type='description';
				break;
			case 'ed':
				$type='date';
				break;
			default:
				$type='eventid ';
		}
	}
	
	if(isset($_GET['order']))
	{
		if($_GET['order']=='ASC')
		{
			$order='DESC';
		}
		else
		{
			$order='ASC';
		}
	}
	else
	{
		$order='ASC';
	}
	
	$data=showevent($start,$no_of_rows,$type,$order);
	
	require_once('include/header.php');
?>
	<td style="padding-top: 20px;" id="right-bg" align="LEFT" valign="top" width="889">
		<form id="events" name="events" method="post" action="manage_events.php?s=<?php echo $_SESSION['per_page'];?>">
			<table border="0" cellpadding="0" cellspacing="0" width="90%">
				<tbody>
				
					<tr>
						<td height="28" class="titles">
							<?php 
								if(isset($_POST['edit']) and $_POST['edit']!='') 
								{
									echo 'Edit the Event';
								}
								else
								{ 
									echo 'Create New Event';
								}
							?>
						</td>
					</tr>
					
					<tr>
						<td align="center" height="10"><font color="#ff0000"></font></td>
					</tr>
					
					<tr>
						<td valign="top">
							<table border="0" cellpadding="0" cellspacing="0" height="35" width="100%">
								<tbody>
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>Add Event Name</strong></td>
										<td width="285" class="td1">
											<textarea rows="1" name="eventname" class="textfield-01"><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['eventname']));else if(isset($row['eventname'])) echo stripslashes(ucwords($row['eventname']));?></textarea>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('eventname',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo "Please enter the Event Name!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>
									
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>Date</strong></td>
										<td width="285" class="td1">
											<input type="text" name="date1" id="search" readonly="true" class="textfield-03" style='background-color:#FFFFFF;height:20px; border:1px solid #614019;'value="<?php if(isset($_POST[$btnname])) echo $_POST['date1'];else if(isset($row['date'])) echo ymdToDmy($row['date']); ?>"/>&nbsp;&nbsp;
											<label><img onclick="displayDatePicker('date1');" alt="calender" src="images/calendar_icon.gif" title="Calender"/> </label>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('date1',$requered2))
											   {
											?>
											
													<span class="error_msg" style="padding-left:58px;" >
														<strong><?php echo "Please enter the Date!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>

									<tr class="td3">
										<td width="17%" height="47" class="td1"><strong> Description</strong></td>
										<td width="83%" class="td1">
											<textarea name="description" class="textfield-02" cols="" rows=""><?php if(isset($_POST[$btnname])) echo stripslashes(ucfirst($_POST['description']));else if(isset($row['description'])) echo stripslashes(ucfirst($row['description']));?></textarea>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('description',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo "Please enter the description!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>
									
									<tr class="td3">
										<td width="17%" height="40" class="td1"></td>
										<td width="83%" class="td1">
											
											<?php 
											   if(isset($_POST['edit'])  or $btnname=='btnup')
											   {
											?>	
												<input type="submit" id="btnup" name="btnup" class="submit_button1" value="Update"/>
												<input type="hidden" name="edit_id" id="edit_id" value="<?php if(isset($row['eventid'])) {echo $row['eventid'];}else echo $_POST['edit_id'];?>"/>	
											<?php
											   }
											   else
											   {
											?>
													<input type="submit" id="btnsave" name="btnsave" class="submit_button_event" value="Save"/>
													<input type="reset" id="btncansel" name="btncansel" class="submit_button_event" style="margin-left:138px;" value="Cancel"/>
											<?php
											   }
											?><?php
												   if($insert!='' or $update_val==1)
												   {
												?>
														<br/> <br/><span class="textfield-01" style="color:#7A5020;background-color:#F3E8D8;" id="search" align="center" >
															<strong><?php echo $msg; ?></strong>
														</span>
												<?php	
												   }
											?>	
										</td>
									</tr>
								</tbody>
							</table>

						</td>
					</tr>
					
					<tr>
						<td align="center" height="10px;"><font color="#ff0000"></font></td>
					</tr>
					
					<tr>
					
						<td valign="top">
							<table id="table-1" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr class="nodrag nodrop" style="background-color: rgb(184, 184, 185);">
										<td align="right" width="3%"></td>
									</tr>
									
									<?php 
										if($data['total_count']>0)
										{
									
											print $data['tables']; 
											if($data['total_count']>$no_of_rows)
											{
									?>
									
												<tr style="cursor: move;" class="td2" id="44">
											
													<td width="18%" align="right" colspan='6'>
									<?php	
														if($pre>=0)
														{
									?>
															<a href="manage_events.php?s=<?php print $pre;?>"   title="Go to previous set of data " ><< Previous</a>
									<?php
														}
														if($next<$data['total_count'])
														{
									?>
															<a href="manage_events.php?s=<?php print $next;?>"  title="Go to next set of data " >Next >></a>
									<?php
														} 
									?> 			
													</td>
												</tr>
									<?php
											}
										}
										else
										{
									?>
											 <tr style="cursor: move;" class="td2" id="44">
												<td width="100%" colspan='4' align="center"><h3> No Records found </h3></td>
											  </tr>
									<?php
										}
										require_once('include/footer.php');
									?>

