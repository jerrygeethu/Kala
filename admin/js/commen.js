
	ddaccordion.init({
				headerclass: "expandable", //Shared CSS class name of headers group that are expandable
				contentclass: "categoryitems", //Shared CSS class name of contents group
				revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
				mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
				collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
				defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
				onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
				animatedefault: false, //Should contents open by default be animated into view?
				persiststate: true, //persist state of opened contents within browser session?
				toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
				togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
				animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
				oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
					//do nothing
				},
				onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
					//do nothing
				}
			})



function deletefun(id,formname,type)
{ 
	var r=confirm("Delete "+type+"?");
	if (r==true)	
	{  
		window.location.href=formname+'.php?id='+id;
		alert ("The record succesfully deleted");
	}

	else
	{   
		return false;
	}
}


function usrname_check()
{

var s=document.getElementById('usrname').value;
var id=document.getElementById('mem_id').value;


if(id=='')
{
	id='';
}
//alert(id);
var window_url="checkusr.php?k="+s+'&id='+id;

//alert(window_url);

	var http = null; 

	var res;

	if(window.XMLHttpRequest)  http = new XMLHttpRequest(); 

	else 

	   if (window.ActiveXObject)  http = new ActiveXObject("Microsoft.XMLHTTP"); 

		  http.onreadystatechange = function()

		  { 

			if(http.readyState == 4)

			{

			   if(http.status == 200)

			   {

				 if (http.responseText!="")

				 {

					res=http.responseText;
//gives value of $message in checkusr.php


					if (res.indexOf("Failed")==-1)

					{
						
						if(res==1)
						{
							
							document.getElementById('check_username').innerHTML="Username already exist.Please select another username";
							document.getElementById('check_username').style.color='#912C2C';
							document.getElementById('user_name').style.visibility='hidden';
						}
						else
						{
							document.getElementById('check_username').innerHTML='Username available';
							document.getElementById('check_username').style.color='#26760B';
							document.getElementById('user_name').style.visibility='hidden';
						}
						
					}

					else

					{

						alert("Unable to Attach");

					}								

				  }

				  else

	    		   {

					alert("No response");

					}

				}

				else alert("Error code " + http.status);

			 

			}

		}

		http.open("GET",window_url,true); 

		http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 

		http.send(null);

	
}


//~ 
//~ 
