window.fbAsyncInit = function() {
      FB.init({
        appId      : '260093750761802', // App ID
        status     : false, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
	  
	  
	  	   FB.login(function(response) {
			   
   if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', function(response) {
     
		 id =  response.id;
       //console.log('Good to see you, ' + response.name + '.');
       
     });
   } else {
     //console.log('User cancelled login or did not fully authorize.');
     
     
   }
 });
 
 
	  
    };


if(id != NULL){

document.write("<table width='280'  height='60' border='0' cellpadding='5' cellspacing='0' style=\"background:#ffffff url('http://socialreader-dev.com/img/toolbar/toolbar-bg.jpg') no-repeat right top;\"><tr><td width='48'><img width='25' height='25' src='http://graph.facebook.com/"+id+"/picture'></td><td width='106'><img src='http://socialreader-dev.com/img/toolbar/on.png' alt='On' width='62' height='27'></td><td width='106'><img src='http://socialreader-dev.com/img/toolbar/fblike.jpg' alt='On'></td></tr></table>");



}