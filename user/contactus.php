<?php
	require_once('include/header.php');
?>

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


<div class="locationleft">
  <p>&nbsp;</p>
    <div class="mainheader1" ><span class="head_text">Contact Us</span></div>
    <div class="contactDiv" >
	
    <form id="form1" name="form1" method="post" action="contactsubmit.php">
    <br />
    <div class="contactLabel" > Name : </div> <div class="contactinput" > <input class="text_inputbox1" type="text" name="name" id="name" /></div>
    <div class="cl" ></div>
    <div class="contactLabel"> Company : </div> <div class="contactinput" > <input class="text_inputbox1" type="text" name="company" id="company" /></div>
    <div class="cl"></div>
    <div class="contactLabel"> Email : </div> 
    <div class="contactinput" > <input class="text_inputbox1"  type="text" name="email" id="email" /></div>
    <div class="cl"></div>
    <div class="contactLabel"> Contact Purpose: </div> <div class="contactinput"  > <input class="text_inputbox1" type="text" name="contact" id="contact" /></div>
    <div class="cl"></div>
    <div class="contactLabel"> Subject : </div> <div class="contactinput" > <input class="text_inputbox1" type="text" name="subject" id="subject" /></div>
    <div class="cl"></div>
    <div class="contactLabel"> Description : </div> <div class="contacttxtdiv">  
      <textarea class="contacttxt text_inputbox2 "   name="des" id="des"></textarea>
    </div>
     <div class="cl"></div>
    
     <div align="right" class="contactLabel">  </div> 
     <div class="contactbuttonDiv" ><br /> <input  class="resetbutton" onmouseover="this.style.cursor = 'pointer';" name="Reset" type="reset" value="" />&nbsp;  <input class="submitbutton"  name="Submit" onmouseover="this.style.cursor = 'pointer';" type="submit" value="" />  </div>
      <div class="cl"></div>
    
      </form>
      
      
        </div>
  <p>&nbsp;</p>
</div>

</div> 










<div class="cl"></div>

<?php
	require_once('include/footer.php');
?>
<script language="JavaScript" type="text/javascript">
//You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("form1");
  frmvalidator.addValidation("name","req","Please enter your  Name");
  frmvalidator.addValidation("company","req","Please enter your Company");
  frmvalidator.addValidation("email","req","Please enter your Email");
  frmvalidator.addValidation("email","email");
  frmvalidator.addValidation("contact","req","Please enter your Contact Purpose");
  frmvalidator.addValidation("contact","req","Please enter your Contact Purpose");
  frmvalidator.addValidation("subject","req","Please enter your Subject");
  frmvalidator.addValidation("des","req","Please enter your Description");
  

</script>
