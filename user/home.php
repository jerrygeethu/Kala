<?php
	ob_start();
	session_start();
	$_SESSION['username']='';

	require_once('../admin/include/database.php');
	require_once('../admin/include/function.php');
	$msg='';
	
	if(isset($_POST['go']))
	{
		$login=check_login($_POST['name'],$_POST['pwd']);
		if($login==1)
		{
			header('Location: ../admin/add_member.php');
		}
		else
		{
			$msg="Invalid username or password";
		}
	}
	
	require_once('include/header.php');

?>



<div class="contentleft" align="left">     <!-- ContentLeft Div  Open  -->

<div class="leftnav"> <!-- leftnav Div  Open  -->

 	<div align="center">
      <p><br />
        <strong>	<a class="link2" href="events.html">Event calendar</a><br />
          <a class="link2" href="photogallery.html">Photo gallery</a><br />
          <a class="link2" href="events.html">Recent events</a>          </strong></p>
      <p><br />
        </p>
 	</div>
    
   <div class="loginbox" align="center"> <br />
   
   <div class="loginboxhead text_label" align="left" >&nbsp; Member login </div>
   <div class="loginboxlabel" align="left" >
   
   		<form action="" method="post">
        	<span class="text_label">  &nbsp; user name:</span>
            <input class="text_inputbox" name="name" type="text" /> <br /> <br />
          
         	<div style="padding-left: 2px;"><span class="text_label">  &nbsp; password:</span>&nbsp;
         	<input class="text_inputbox" name="pwd" type="password" /></div>
          	
            <div align="right"; style="width:160px; padding-top:10px;">
            <input class="go_button" onmouseover="this.style.cursor = 'pointer';" name="go" id="go" type="submit" value="" />
          	</div> 
            <?php echo $msg;?>
          	</form> 
            
 	    
   </div>
    	</div> 
        <p>&nbsp;</p>
 	 
   			</div>

</div> 

<div class="contenttext" align="left">
  <p>We are an ever growing network of like-minded friends and families based across the length and breadth of United Kingdom committed to promoting Kerala's rich and varied artistic, literary and cultural heritage among international community, particularly younger British Malayalees.</p>
  <p>Creativity, be it art, literature or any other form has the ability to exhilarate, enthral and expand the mind. For us, a few friends now settled in UK, but originally from different parts of Kerala, this was also a strong common bond, which held us together. As we adapted to the British ways of life and were exposed to its rich culture, we also took pride in our own literary roots and artistic heritage, which we wished our children to have the opportunity to value and appreciate. We hoped it would enrich their lives as British Malayalees. Kerala Arts &amp; Literary Association (KALA) was thus started in October 1996.</p>
  <p>We take pride in our heritage and hope you enjoy the site.</p>
  <p>&nbsp;</p>
</div> 

<div class="cl"></div>

<?php
	require_once('include/footer.php');
?>
