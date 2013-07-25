<?php 
ob_start();
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
	
	$requird=array("name","designation","usrname","pwd","pwd1");
	$requered2[]="";
	$flag=1;
	$insert='';
	$msg="";
	$usr_status="";
	$update_val="";
	$mem_id='';
	$type='';
	$order='';
	
	if(isset($_POST['edit']) and $_POST['edit']!='') 
	{
		$row = getData($_POST['editid']);
		$mem_id=$_POST['editid'];
		//print_r($row);echo "<br/>";
	}
	
	$btnname='btnsave';

		if(isset($_POST['btnsave']))
		{
			foreach($requird as $key=>$value)
			{
				  
				   if($_POST[$value]=='')
				   {
						   $requered2[]=$value;
						   $flag=0;
				   }
				   
				   if($_POST['pwd']!=$_POST['pwd1'] && $_POST['pwd1']!='')
				   {
					   $requered2[]='pwd2';
					   $flag=0;
				   }
				  
			}
			$check_val=post_check_usrname($_POST['usrname'],$_POST['edit_id']='');
			if($check_val==1)
			{
				 $usr_status="User name already exist";
				 $flag=0;
			}
			if($flag==1)
			{
				$insert=insertmember($_POST);
				if(isset($insert))
				{
					$msg="Succesfully inserted the record";
				}
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
				   
				   if($_POST['pwd']!=$_POST['pwd1'] && $_POST['pwd1']!='')
				   {
					   $requered2[]='pwd2';
					   $flag=0;
				   }
				  
			}
			
			$check_val=post_check_usrname($_POST['usrname'],$_POST['edit_id']);
			if($check_val==1)
			{
				 $usr_status="User name already exist";
				 $flag=0;
			}
				
			if($flag==1)
			{
				$update_val=editmember($_POST);
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
		deletemember($_GET['id']);
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
	
	
					
	$type='memberid';
	
	if(isset($_GET['type']))
	{
		switch($_GET['type'])
		{
			case 'n':
				$type='name';
				break;
			case 'd':
				$type='designation';
				break;
			case 'j':
				$type='date';
				break;
			default:
				$type='memberid';
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
	
	$data=showmember($start,$no_of_rows,$type,$order);
	require_once('include/header.php');
?>

	<td style="padding-top: 20px;" id="right-bg" align="LEFT" valign="top" width="889">
		<form id="add_member" name="add_member" method="post" action="add_member.php?s=<?php echo $_SESSION['per_page'];?>">
			<table border="0" cellpadding="0" cellspacing="0" width="90%">
				<tbody>
					<tr>
						<td height="28" class="titles">
							<?php 
								if(isset($_POST['edit']) and $_POST['edit']!='') 
								{
									echo 'Edit the Member';
								}
								else
								{ 
									echo 'Add New Member';
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
										<td width="17%" height="35" class="td1"><strong> Name</strong></td>
										<td width="83%" class="td1">
											<textarea rows="1" name="name" class="textfield-01" ><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['name']));else if(isset($row['name'])) echo stripslashes(ucwords($row['name']));?></textarea>&nbsp;&nbsp;
										<?php
								   if(isset($_POST[$btnname]) and in_array('name',$requered2))
								   {
								?>
									<span  class="error_msg" id="search" >
											<strong><?php echo "Please enter the name!!"; ?></strong>
										</span>
								<?php	
								   }
								?></td>
									</tr>
									
								
																								
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>Designation</strong></td>
										<td width="83%" class="td1">
											<textarea rows="1"  name="designation" class="textfield-01" id="search2"><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['designation'])); elseif(isset($row['designation']))echo stripslashes(ucwords($row['designation']));?></textarea>&nbsp;&nbsp;
										<?php
								   if(isset($_POST[$btnname]) and in_array('designation',$requered2))
								   {
								?>
									<span  class="error_msg" id="search" >
											<strong><?php echo "Please enter the designation!!"; ?></strong>
										</span>
								<?php	
								   }
								?></td>
									</tr>
					   
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>User name</strong></td>
										<td width="83%" class="td1">
											<textarea rows="1" name="usrname" class="textfield-01" id="usrname"  onkeyup="usrname_check();"><?php if(isset($_POST[$btnname])) echo stripslashes($_POST['usrname']); elseif(isset($row['username']))echo stripslashes($row['username']);?></textarea>&nbsp;&nbsp;
											<strong><span id='check_username'></span></strong>
										<?php
								   if(isset($_POST[$btnname]) and in_array('usrname',$requered2))
								   {
								?>
									<span  class="error_msg" id="search" >
											<strong id="user_name"><?php echo "Please enter the User name!!"; ?></strong>
										</span>
								<?php	
								   }
								?>
										</td>
									</tr>
							
								
								
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>Password</strong></td>
										<td width="83%" class="td1"><input type="password" name="pwd" class="textfield-01" value="<?php if(isset($_POST[$btnname])) echo $_POST['pwd']; elseif(isset($row['pwd'])) echo '***';?>" id="search3" />&nbsp;&nbsp;
										<?php
								  //if(isset($_POST['btnsave']) or isset($_POST['btnup']))
								  if(isset($_POST[$btnname]))
								   {
									if(in_array('pwd',$requered2))
									{
								?>
									<span  class="error_msg" id="search" >
											<strong><?php echo "Please enter the password!!"; ?></strong>
										</span>
								<?php	
									}
									else if(in_array('pwd2',$requered2))
									{
								?>
									<span  class="error_msg" id="search" >
											<strong><?php echo "Please enter the carrect password!!"; ?></strong>
										</span>
								<?php	
									}
								   }
								?>
										</td>
									</tr>
									
								
					 
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong>Confirm password</strong> </td>
										<td width="83%" class="td1"><input type="password" name="pwd1" class="textfield-01" id="search" value="<?php if(isset($_POST[$btnname]))echo $_POST['pwd1'];elseif(isset($row['pwd']))echo '***';?>"> &nbsp;&nbsp;
										<?php
								   if(isset($_POST[$btnname]) and in_array('pwd1',$requered2))
								   {
								?>
								
										<span  class="error_msg" id="search" >
											<strong><?php echo "Please enter the confirm password!!"; ?></strong>
										</span>
								<?php	
								   }
								?>
									</td>
									</tr>
								
								<input type="hidden" name="mem_id" id="mem_id" value="<?php echo $mem_id;?>"/>
								
									<tr class="td3">
										<td width="17%" height="40" class="td1"></td>
										<td width="83%" class="td1">
										<?php 
										   if(isset($_POST['edit'])  or $btnname=='btnup')
										   {
										?>	
											<input type="submit" id="btnup" name="btnup" class="submit_button1" value="Update"/>
											<input type="hidden" name="edit_id" id="edit_id" value="<?php if(isset($row['memberid'])) echo $row['memberid'];else echo $_POST['edit_id'];?>"/>	
										<?php
										   }
										   else
										   {
										?>
											<input type="submit" id="btnsave" name="btnsave" class="submit_button1" value="Submit"  />
										<?php
										   }
										   if($insert!='' or $update_val==1)
										   {
										?>
												<br/> <br/><span style="color:#7A5020;">
													<strong><?php echo $msg; ?></strong>
												</span>
										<?php	
										   }
										   if($usr_status!='')
										   {
										?>
												<br/> <br/><span style="color:#955151;">
													<strong><?php echo $usr_status; ?></strong>
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
															<a href="add_member.php?s=<?php print $pre;?>" class="a1"  title="Go to previous set of data " ><< Previous</a>
									<?php
														}
														
														
														
														
														if($next<$data['total_count'])
														{
									?>
															<a href="add_member.php?s=<?php print $next;?>" class="a2"  title="Go to next set of data " >Next >></a>
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
