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

	$requird=array("name");
	$requered2[]="";
	$flag=1;
	$insert='';
	$msg="";
	$msg1="";
	$update_val="";
	
	if(isset($_POST['edit']) and $_POST['edit']!='') 
	{
		$row = getData_activity($_POST['editid']);
	}
	
	$btnname='btnsave';
	
	if(isset($_POST['btnsave']) || isset($_POST['btnup']))
	{
		foreach($requird as $key=>$value)
		{
			  
			   if($_POST[$value]=='')
			   {
					   $requered2[]=$value;
					   $flag=0;
			   }
			  
		}
	}
	
	if(isset($_POST['btnsave']))
	{
		
		if($_FILES['filename']['name']=="")
		{
			$requered2[]='filename';
			$flag=0;
			$msg1='Please upload the files!!';
		}
		if($flag==1)
		{
			
			$msg1=file_upload($_FILES,'testimony');
				
			
			if($msg1==1 and $flag==1)
			{		
				$insert=insertactivity($_POST,$_FILES);
				
				$msg1='Succesfully inserted the record';
				$_POST='';
			}
			else
			{
				$requered2[]='filename';
				$flag=0;
			}
		}
		
	}
	if(isset($_POST['btnup']) and $_POST['btnup']!='') 
	{
		$btnname='btnup';
		
		if($flag==1)
		{		
			if($_FILES['filename']['name']!="")
			{
				deletefile('testimony',$_FILES['filename']['name']);
				$msg1=file_upload($_FILES,'testimony');
				//echo	$msg1;
				
				if($msg1==1 and $flag==1)
				{		
					$update_val=editactivity($_POST,$_FILES);
					$msg1='Succesfully modified the record';
					$_POST='';
				}
				else
				{
					$requered2[]='filename';
					$flag=0;
				}
			}
			else
			{
				$update_val=editactivity($_POST,$name='');
				$msg1='Succesfully modified the record';
				$_POST='';
			}
		}
	
	}

	if(isset($_GET['id']) and $_GET['id']!='') 
	{
		$row = getData_activity($_GET['id']);
		deleteactivity($_GET['id'],$row['filename']);
		$row='';
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
	$no_of_rows=2;
	$pre=$start-$no_of_rows;
	$next=$start+$no_of_rows;
	
	$_SESSION['per_page']=$start;	
	
	$type='testimonyid ';
	
	if(isset($_GET['type']))
	{
		switch($_GET['type'])
		{
			case 'n':
				$type='name';
				break;
			case 'f':
				$type='filename';
				break;
			case 'ad':
				$type='date';
				break;
			default:
				$type='testimonyid ';
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
	
	$data=showactivity($start,$no_of_rows,$type,$order);
	
	require_once('include/header.php');
?>

	<td style="padding-top: 20px;" id="right-bg" align="LEFT" valign="top" width="889">
	
		<form id="activity" name="activity" method="post" action="manage_activities.php?s=<?php echo $_SESSION['per_page'];?>" enctype="multipart/form-data">
		
			<table border="0" cellpadding="0" cellspacing="0" width="90%">
				<tbody>
					<tr>
						<td height="28" class="titles">
							<?php 
								if(isset($_POST['edit']) and $_POST['edit']!='') 
								{
									echo 'Edit the Activity';
								}
								else
								{ 
									echo 'Add New Activity';
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
										<td width="17%" height="35" class="td1"><strong> Testimonial Name</strong</td>
										<td width="83%" class="td1">
											<textarea rows="1" name="name" class="textfield-01"><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['name']));else if(isset($row['name'])) echo stripslashes(ucwords($row['name']));?></textarea>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('name',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo "Please enter the Activity name!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>
		
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong> File Name</strong></td>&nbsp;&nbsp;
										<td width="83%" class="td1">
											<input type="file" name="filename" id="file"/> &nbsp;&nbsp;
											<?php 
											   if(isset($_POST['edit']))
											   {
													$fname=explode("_",$row['filename']);
													print "<a  style='color: #7A5020; text-decoration: none; font-weight:bold;' href='".BASEPATH."testimony/".$row['filename']."'>".$fname[1]."</a>";
											   }
											   else
											   {
													echo "";
											   }
											   if(isset($_POST[$btnname]) and in_array('filename',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo $msg1;?></strong>
													</span>
											<?php	
											   }
											?>
											
											<!--<div class="submit_button" style="margin-left:0px;">Browse</div>-->
										</td>
									</tr>
									
									<tr class="td3">
										<td width="17%" height="40" class="td1"></td>
										<td width="83%" class="td1">
											<?php 
											   if(isset($_POST['edit']) or isset($_POST['edit_id']) )
											   {
											?>	
												<input type="submit" id="btnup" name="btnup" class="submit_button1" value="Update"/>
												<input type="hidden" name="edit_id" id="edit_id" value="<?php if(isset($row['testimonyid'])) echo $row['testimonyid'];else echo $_POST['edit_id'];?>"/>	
												<input type="hidden" name="old_file" id="old_file" value="<?php if(isset($row['filename'])) echo $row['filename'];else echo $_POST['old_file'];?>"/>	
											<?php
											   }
											   else
											   {
											?>
												<input type="submit" id="btnsave" name="btnsave" class="submit_button_event" value="Save"/>
												<input type="reset" id="btncansel" name="btncansel" class="submit_button_event" style="margin-left:138px;" value="Cancel"/>
											<?php
											   }
											   if($insert!='' or $update_val==1)
											   {
											?>
													<br/> <br/><span class="textfield-01" style="color:#7A5020;background-color:#F3E8D8;" id="search" align="center" >
														<strong><?php echo $msg1; ?></strong>
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
									
									
									<?php 
										if($data['total_count']>0)
										{
									
											print $data['tables']; 
											if($data['total_count']>$no_of_rows)
											{
									?>
									
												<tr style="cursor: move;" class="td2" id="44">
											
													<td width="18%" align="right" colspan='3'>
									<?php	
														if($pre>=0)
														{
									?>
															<a href="manage_activities.php?s=<?php print $pre;?>"   title="Go to previous set of data " ><< Previous</a>
									<?php
														}
									?>
															<td width="18%" align="right" colspan='3'>
									<?php
														if($next<$data['total_count'])
														{
									?>
															<a href="manage_activities.php?s=<?php print $next;?>"  title="Go to next set of data " >Next >></a>
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
												<td width="100%" colspan='6' align="center"><h3> No Records found </h3></td>
											  </tr>
									<?php
										}
										require_once('include/footer.php');
									?>

