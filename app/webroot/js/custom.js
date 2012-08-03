$(document).ready(function(){

var layout =  'default';
//Initialize
$("#content > div:not(:first-child)").hide();
$('a[rel*=facebox]').facebox();




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
        var url   = data.url;
        var image = data.image;
  
		if(image == null || image == ''){
			var params =  {title : title,article : url};
			
		}else{
			var params =  { title: title, article : url, image: image };
			
			}
        FB.api('/me/adanews:preview', 'post', params, function(response) {
			
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



$(".removepost").live('click',function(){
	loadLoader('.showStatusRecentShares');
	var r_id=this.id;
	FB.api(
             r_id,
               'delete',
                function(response) {
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