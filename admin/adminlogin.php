<?php
	session_start();
	$_SESSION['username']='';

	require_once('include/database.php');
	require_once('include/function.php');
	
	$msg='';
	
	if(isset($_POST['btn']))
	{
		if($_POST['name']!='' and $_POST['pwd']!='')
		{
			$login=check_login($_POST['name'],$_POST['pwd']);
			if($login==1)
			{
				header('Location: add_member.php');
			}
			else
			{
				$msg="<span class=\"error_msg\" id=\"search\"><strong>Invalid username or password</strong></span>";
			}
		}
		else
		{
			$msg="<span style=\"color:#7A5020;\"><strong>Please enter username and password!!</strong></span>";
		}
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>


		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Kala Admin Login</title>
		<link href="style/style.css" rel="stylesheet" type="text/css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		


		<script type="text/javascript" src="js/ddaccordion.js"></script>
		
		<script language="JavaScript" src="js/calendar.js"></script>

		

		<script language="JavaScript" src="js/commen.js"></script>
		
		
	</head>
	
	<body>
	
		<center>
			<div id="container">
				<form action="adminlogin.php" method="post">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  
						<tbody>
							<tr>
								<td width="433" height="100" align="left" bgcolor="#8b5a21"><div id="headr"></div></td>
								<td width="889" height="86" align="left" bgcolor="#8b5a21">
		 
									<table width="230" border="0" align="right">
										<tr>
											<td width="43">&nbsp;<a class="top-link" href="add_member.php">Home</a></td>
											<td width="41">&nbsp;<a href="logout.php" class="top-link">Logout</a></td>
											<td width="132">&nbsp;<a class="top-link" href="#">&nbsp;</a></td>
										</tr>
									</table>     
								</td>
							</tr> 
							
							<div class="clear"></div>
							
							<table width="350" border="0" align="center" cellpadding="0" cellspacing="0"  >

								<tr> 
									<td height="80"> </td>
								</tr>
								
								<tr>
									<td height="39" bgcolor="#fcb040" class="titles" ><strong>Admin login </strong> </td>
								</tr>
								
								<tr>
									<td bgcolor="#FFFFFF"></td>
								</tr>
								
								<tr>
									<td height="5">&nbsp;</td>
								</tr>
								
								<tr>
									<td> 
									
										<table border="0" cellpadding="0" cellspacing="0" height="98" width="100%" >  
											<tr class="td3">
												<td width="41%" class="td1" height="30"> <strong> Username: </strong> </td>
												<td colspan="2" class="td1">
													<label><input type="text" name="name" id="name" class="logininput" /></label>
												</td>
											</tr>

											<tr class="td3">
												<td width="41%" class="td1" height="30"> <strong> Password: </strong> </td>
												<td colspan="2" class="td1">
													<label><input type="password" name="pwd" id="pwd" class="logininput" /></label>
												</td>
											</tr>

											<tr class="td3">
												<td height="26" class="td1"  >&nbsp;</td>
												<td width="56%" class="td1" >
													<input type="submit" class="login_button" name="btn" id="btn" value="login"  />
													
												</td>
											</tr>
											
											<?php 
												if($msg!='')
												{
											?>
											
													<tr class="td3">
														<td width="41%" class="td1" height="30" colspan="3">
															<?php echo $msg;?>
														</td>
													</tr>
											<?php 
												}
											?>
										</table>
										
									</td>
								</tr>					
							</table>
	<!--*******************************************************************************footer.php*************************************************************************-->														
																
																
							<tr class="nodrag nodrop">
								<td colspan="5"><div id="innerText"></div>
									<table border="0" cellpadding="3" cellspacing="0" width="97%"></table>
								</td>
								<td width="0%" colspan="2" valign="bottom" style="text-align: left;"><br />
								<br />
								<br /></td>
							</tr>
							
						
							<tr>
								<td colspan="2" align="left">
									<div class="clear"></div>
									<div id="footer">
										<table width="200" border="0" align="center">
											<tr>
												<td><span class="style4"><font color="#FFFFFF"><a class="top-link" href="adminlogin.php">Admin Home</a></font></span></td>
												<td><span class="style4"><font color="#FFFFFF"><a class="top-link" href="../home.php">Website</a></font></span></td>
												<td><span class="style4"><font color="#FFFFFF"><a class="top-link" href="logout.php">Logout</a></font></span></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</form>	
			</div>
		</center>

	</body>

</html>
