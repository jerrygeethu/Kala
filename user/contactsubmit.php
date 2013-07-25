<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kala ContactUs</title>

<link href="css/style.css" rel="stylesheet" type="text/css"  />
<script src="js/validate.js" type="text/javascript"> </script>


<body>

<div class="mainwindow" align="center";> <!-- Main Window Div Open  -->
<div class="contentwindow"> <!-- Content Window Div  Open  -->
<div class="header" align="left"> <!-- Header Div  Open  -->
<img src="images/logo.png" alt="Logo" /> &nbsp;
</div> <!-- Header Div  Close  -->

<div class="topmenu" align="left"> <!-- Menu Div  Open  -->
  <strong> <a class="topmenuitem link2" href="home.html">home</a> </strong>
  <strong> <a class="topmenuitem link2" href="team.html">team</a> </strong>
  <strong> <a class="topmenuitem link2" href="publications.html">publications</a> </strong>
  <strong> <a class="topmenuitem link2" href="events.html">events</a> </strong>
  <strong> <a class="topmenuitem link2" href="photogallery.html">photo gallery</a> </strong>
  <strong> <a class="topmenuitem link2" href="activities.html">activities</a> </strong>
  <strong> <a class="topmenuitem link2" href="links.html">links</a> </strong>
  <strong> <a class="topmenuitem link2" href="contactus.html">contact us</a> </strong>

</div> <!-- Menu Div  Close  -->

<div class="contentleft" align="left">     <!-- ContentLeft Div  Open  -->

<div class="leftnav"> <!-- leftnav Div  Open  -->

 	<div align="center">
      <p><br />
        </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><strong><a class="link2" href="events.html">Event calendar</a></strong></p>
      <p><strong><a class="link2" href="photogallery.html">Photo gallery</a></strong></p>
      <p><strong><a class="link2" href="events.html">Recent events</a>          </strong></p>
      <p><br />
        </p>
 	</div>
    
   <div class="loginbox" align="center"> 
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p><br />
       </p>
   </div>
</div>

</div> 



<div class="contenttext" align="left">
<?php 

if(!empty($_POST))
{
	

 $keys=array_keys($HTTP_POST_VARS);

												$headers  = "MIME-Version: 1.0\r\n";
												$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
												/* additional headers 
												
												//$headers .= "Cc:info@sdws.info\r\n";
												$headers .= "Replay-to:info@sdws.info\r\n";
											$headers .= "Return-Path:".$_POST['email']."\r\n";
											* */
										//	echo $headers;
										    $headers .= "From:".$_POST['email']."\r\n";
											$subject="Kala Arts and Literary Association Contact Us Form Submission";
											$message='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><HTML><HEAD><META content="text/html; charset=iso-8859-1" http-equiv=Content-Type><META content="MSHTML 5.00.2920.0" name=GENERATOR><STYLE>.tb{border-color:#330000;border-style:solid;border-width:1;font-family:verdana,Arial;font-size:10pt;}</STYLE></HEAD><BODY bgColor=#ffffff><DIV>';
											$messagex.='<TABLE align=center border=1 bordercolorlight="#C0C0C0" bordercolordark="#FFFFFF" class=tb bgcolor=white>';
											for($i=0;$i<count($HTTP_POST_VARS);$i++){
											$messagex.='<TR><TD valign="top">'.$keys[$i].'&nbsp;:</TD><TD>'.nl2br($HTTP_POST_VARS[$keys[$i]]).'</TD></TR>';
											}
											$messagex.='</TABLE>';											
											$message.=$messagex;
											$message.='</DIV></BODY></HTML>';
											
										
											$send='tintu.primemove@gmail.com,enquiry@kala.org.uk';
											
											if(mail($send,$subject,$message,$headers)){ ?>
												<div align="center" style="color:red;font-size:18px;padding-top:20px;">Thank You</div>
												
												
												<?php	
											
													}else{ ?>
													<div align="center" style="color:red;font-size:18px;padding-top:20px;">Sending Failed</div>	
												
										<?php	}




	
	
}
	
	?>


 
 <div style="height:100px;">
 
 
 
 
 
 </div>
 
 
 
 
 
 
 
 
</div> 










<div class="cl"></div>

<div align="left" class="footer">
	<div class="footertabs" align="center" > <a class="footertabs" href="home.html">home</a></div>
	<div class="footertabs" style="width:130px;" align="center"> <a class="footertabs" href="photogallery.html">photo gallery</a></div>
	<div class="footertabs" style="width:80px;"> <a class="footertabs" href="events.html">events</a></div>
	<div class="footertabs" style="width:90px;" > <a class="footertabs" href="activities.html">activities</a></div>
	<div class="footertabs" style="width:70px;"> <a class="footertabs" href="team.html">team</a></div>
	<div class="footertabs"> <a class="footertabs" href="publications.html">publications</a></div>
	<div class="footertabs"> <a class="footertabs" href="links.html">&nbsp;&nbsp;&nbsp;links</a></div>
	<div class="footertabs"> <a class="footertabs" href="contactus.php">contact us</a></div>
    <div align="right" class="powered" ><a style="color:#FFFFFF; text-decoration:none;"  href="http://media.primemoveindia.com/" target="_blank">Powered by Prime Move Media</a>
</div>


</div>



</div> <!-- ContentLeft Div  Close  -->





</div><!-- Content Window  Close  -->
</div><!-- Main Window End   -->

</body>
</html>
