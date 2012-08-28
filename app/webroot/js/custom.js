$(document).ready(function(){

var layout =  'default';
//Initialize
$("#content > div:not(:first-child)").hide();
$('a[rel*=facebox]').facebox();





//load the last ten shares
setTimeout(function() {
	
	loadLoader(".showStatusRecentShares");
	 FB.api('/me',function(user){
		 	console.log(user);
		 	var user = user.id;
			var channel = 1;
		 
		 $.post("http://www.globalsocialreader.com/facebookresponses/getlasttenshares",{userId : user , channelId : channel},function(lastTenShares){
			 
			 
			removeLoader(".showStatusRecentShares");
				 
				 shared = (jQuery.parseJSON(lastTenShares));
			  for(var a=0; a<shared.length;a++){
				 
				 $("#r-shares").append(shared[a]);
				 }
			 
			 });
		
		 
		 });
		
	},3000);
	
	
	
	
	
	
	
	
$("#tester").click(function(){

	linkProperties = getLinkProperties(this);
	
	});

$(".mainMenuLink").click(function(){

    $("#content> div:not(:#feedRecordDisplay"+$(this).attr('rel')+")").fadeOut("slow");
    $("#feedRecordDisplay"+$(this).attr('rel')).fadeIn("slow");
    return false;
});


$(".showPreRouteBox").click(function(){
$.get("/feedrecords/viewajax/"+ $(this).attr('rel'), function(data){
showLightBox(data);});
  
});


$(document).bind('reveal.facebox', function() {
$(".changeFeedrecordSocialStatus").click(function(){
var thisobj = $(this);
$.get("/feedsocialsettings/onoffsocial/"+ $(this).attr('rel'), function(data){

    if(data == 0){
      
      thisobj.attr({src: "/img/icons/off_small.jpg"});
    }else{
       thisobj.attr({src: "/img/icons/on_small.jpg"});
    }
});



});
});


$("#changeGlobalShareNumber").change(function(){

	loadLoader('.showStatus');
	var thisObj = $(this);
	var channelId = $(this).attr('rel');


	$.get("/channelsreaders/setNewShareLimit/"+channelId+"/"+ $(this).val(), function(data){

    if(data == 0){

      thisObj.attr({src: "/appproperties/"+layout+"/img/off.png"});
    }else{

       thisObj.attr({src: "/appproperties/"+layout+"/img/on.png"});
    }
	removeLoader('.showStatus');
});



	});


$("#changeGlobalSocialVisibility").click(function(){
	
	loadLoader('.showStatus');
	var thisObj = $(this);
	var layout = $(this).attr('name');
	$.get("/channelsreaders/onOffGlobalSocialStatus/"+ $(this).attr('rel'), function(data){

    if(data == 0){
      
      thisObj.attr({src: "/appproperties/"+layout+"/img/off.png"});
    }else{
		
       thisObj.attr({src: "/appproperties/"+layout+"/img/on.png"});
    }
	removeLoader('.showStatus');
});

	
	
	});


$(document).bind('reveal.facebox', function() {
$("#shareIt").click(function(){

var shareIt = $(this);
var channelId=$(this).attr('rel');
$.get("/feedrecords/shareit/"+ $(this).attr('rel'), function(data){

		if(data==null){
			return false;	
		}
        var title = data.title;
        var url   = data.directUrl;
        var image = data.image;
  
		if(image == null || image == ''){
			var params =  {article : url};
			
		}else{
			var params =  {article : url };
			
			}
        FB.api('/me/adanews:preview', 'post', params, function(response) {
			console.log(response.error);
          if (!response || response.error) {
           $("#test").text(response.error);
          } else {
            //$("#test").text("id : "+response.id);// read the response ID -lasantha
			$.post('/facebookresponses/saveresponses/',{ channel: channelId,response:response.id}, function(data) {
				var li="<li id=\""+response.id+"_li\">"+ title +"<img id=\""+ response.id +"\" class='removepost' alt='' src='/img/remove-share-button.jpg\'></li>";
			 $("#r-shares").append(li);
			});
			//window.location.replace(url);
          }
        });
    
	
    
},'json');


});
});



$("#removeShare").live('click',function(){
	console.log('in');
	loadLoader('.showStatusRecentShares');
	var r_id=$(this).attr('rel');
	console.log(r_id);
	FB.api(
             r_id,
               'delete',
                function(response) {
					console.log(response);
                 if (!response || response.error) {
					   removeLoader('.showStatusRecentShares');
                       return false
                 } else {
                     $.post('/facebookresponses/daleteresponses/'+r_id, function(data) {
						 if(data==1 || data==true){
					 		$('#'+r_id+"_li").remove();
							removeLoader('.showStatusRecentShares');
						 }
					});
                  }
     });
            
});

});

//**//
$('.changeFeedrecordSocialStatuso').live('click',function(){
	var thisobj = $(this);
	$.get("/feedsocialsettings/onoffsocial/"+ $(this).attr('rel'), function(data){
	
		if(data == 0){
		  
		  thisobj.attr({src: "/img/icons/off_small.jpg"});
		}else{
		   thisobj.attr({src: "/img/icons/on_small.jpg"});
		}
	});
	








	
	
});
//**//




function showLightBox(data){
$.facebox(data)

}

function loadLoader(onThisPlace){
	
	
	$(onThisPlace).html("<img src='/img/loading-small.gif' />");
	}
	
function removeLoader(fronThisPlace){
	$(fronThisPlace).html("");
	}
	
function checkLikes(likes,pageid){
	if(likes==0){
		$.get("/channels/chaecklikes/"+pageid, function(data){
			showLightBox(data);
		});	
	}
}


function getLinkProperties(linkurl){
	
			$.post("/feedrecords/givefeedrecordsforurl/",{url : encodeURIComponent(linkurl)}, function(data){
			console.log(data);
		});
	
	}

