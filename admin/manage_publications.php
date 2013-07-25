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

	$requird=array("categoryname","articlename");
	$requered2[]="";
	$flag=1;
	$insert='';
	$msg="";
	$msg1="";
	$update_val="";
	
	if(isset($_POST['edit']) and $_POST['edit']!='') 
	{
		$row = cat_getData($_POST['editid']);
		//print_r($row);
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
			
			$msg1=file_upload($_FILES,'category');
				
			
			if($msg1==1 and $flag==1)
			{		
				$insert=insertcategory($_POST,$_FILES);
				
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
				deletefile('category',$_FILES['filename']['name']);
				$msg1=file_upload($_FILES,'category');
				//echo	$msg1;
				
				if($msg1==1 and $flag==1)
				{		
					$update_val=editcategory($_POST,$_FILES);
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
				$update_val=editcategory($_POST,$name='');
				$msg1='Succesfully modified the record';
				$_POST='';
			}
		}
	
	}	
	
	if(isset($_GET['id']) and $_GET['id']!='') 
	{
		$row = cat_getData($_GET['id']);
		deletecategory($_GET['id'],$row['filename']);
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
	$no_of_rows=5;
	$pre=$start-$no_of_rows;
	$next=$start+$no_of_rows;
	
	$_SESSION['per_page']=$start;
					
	$type='id';
	
	if(isset($_GET['type']))
	{
		switch($_GET['type'])
		{
			case 'c':
				$type='categoryname';
				break;
			case 'a':
				$type='articlename';
				break;
			case 'f':
				$type='filename';
				break;
			case 'ed':
				$type='date';
				break;
			default:
				$type='id';
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
	
	$data=showcategory($start,$no_of_rows,$type,$order);
	
	require_once('include/header.php');
?>

	<td style="padding-top: 20px;" id="right-bg" align="LEFT" valign="top" width="889">
	
		<form id="pub" name="pub" method="post" action="manage_publications.php?s=<?php echo $_SESSION['per_page'];?>" enctype="multipart/form-data">
		
			<table border="0" cellpadding="0" cellspacing="0" width="90%">
				<tbody>
					<tr>
						<td height="28" class="titles">
							<?php 
								if(isset($_POST['edit']) and $_POST['edit']!='') 
								{
									echo 'Edit the Article';
								}
								else
								{ 
									echo 'Add New Article';
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
										<td width="17%" height="35" class="td1"><strong> Category</strong></td>
										<td width="83%" class="td1">
											<textarea rows="1" name="categoryname" class="textfield-01"><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['categoryname']));else if(isset($row['categoryname'])) echo stripslashes(ucwords($row['categoryname']));?></textarea>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('categoryname',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo "Please enter the Category name!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>

									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong> Article Name</strong> </td>
										<td width="83%" class="td1">
											<textarea rows="1" name="articlename" class="textfield-01"><?php if(isset($_POST[$btnname])) echo stripslashes(ucwords($_POST['articlename']));else if(isset($row['articlename'])) echo stripslashes(ucwords($row['articlename']));?></textarea>&nbsp;&nbsp;
											<?php
											   if(isset($_POST[$btnname]) and in_array('articlename',$requered2))
											   {
											?>
													<span  class="error_msg" id="search" >
														<strong><?php echo "Please enter the Article name!!"; ?></strong>
													</span>
											<?php	
											   }
											?>
										</td>
									</tr>
		
									<tr class="td3">
										<td width="17%" height="35" class="td1"><strong> File Name</strong></td>&nbsp;&nbsp;
										<td width="83%" class="td1">
											<input type="file" name="filename" id="file"/> 
											<?php 
											   if(isset($_POST['edit']))
											   {
													$fname=explode("_",$row['filename']);
													print "<a style='color: #7A5020; text-decoration: none; font-weight:bold;' href='".BASEPATH."category/".$row['filename']."'>".$fname[1]."</a>";
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
											
											
											
											
											<?php // 
											  if(isset($_POST['edit']) or isset($_POST['edit_id']) )
											  {
											?>	
												<input type="submit" id="btnup" name="btnup" class="submit_button1" value="Update"/>
												<input type="hidden" name="edit_id" id="edit_id" value="<?php if(isset($row['id'])) echo $row['id'];else echo $_POST['edit_id'];?>"/>	
												<input type="hidden" name="old_file" id="old_file" value="<?php if(isset($row['filename'])) echo $row['filename'];else echo $_POST['old_file'];?>"/>	
											<?php
											   }
											   else
											   {
											?>
												<input type="submit" id="btnsave" name="btnsave" class="submit_button1" value="Submit"/>
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
											
													<td width="18%" align="right" colspan='7'>
									<?php	
														if($pre>=0)
														{
									?>
															<a href="manage_publications.php?s=<?php print $pre;?>"   title="Go to previous set of data " ><< Previous</a>
									<?php
														}
														if($next<$data['total_count'])
														{
									?>
															<a href="manage_publications.php?s=<?php print $next;?>"  title="Go to next set of data " >Next >></a>
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
