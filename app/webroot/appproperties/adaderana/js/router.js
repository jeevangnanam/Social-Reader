if(jQuery){

$(document).ready(function(){
	
	if(document.referrer != ''){
		
		uri = parseUri(document.referrer);
		
		if(uri.host == 'www.facebook.com'){
			
			setTimeout(function() {
				 FB.login(function(response) {
   					if (response.authResponse) {
						 console.log('Welcome! Auth success');
						 FB.api('/me', function(response) {
							 
							
						   console.log('User is , ' + response.name + '.');
						 });
				   } else {
					 console.log('Login cancelled by user');
				   }
 				},{'scope' : 'user_likes,publish_actions,email,user_birthday,user_relationships,read_friendlists'});
				

				},3000);
			
			}
	}
	
	
	
	/*$('a[href*="nid="]').click(function(ev){
		ev.preventDefault();
		url = this.toString();
		
		
		 FB.api('/me/adanews:preview', 'post', {article : url}, function(response) {
			console.log(response);
          if (!response || response.error) {
           
          } else {
            //$("#test").text("id : "+response.id);// read the response ID -lasantha
			//$.post('http://www.globalsocialreader.com/facebookresponses/saveresponses/',{ channel: 1,response:response.id}, function(data) {
				
			//});
			//window.location.replace(url);
          }
        });
	
	
			setTimeout(function() {window.location = url;},3000);
				
				
				
		});
	*/
	
	
	
	
	});
}






if(jQuery){
$(document).ready(function(){
	

	var userId;
	var url = window.location.href;
	parsedUrl = parseUri(url);
	

	if(parsedUrl.queryKey.nid != null){ //nid check
		
     setTimeout(function() {//TIME out check	
	 
	     FB.api('/me', function(userDetails) {
			
				    $.post("http://www.globalsocialreader.com/channelsreaders/checkCurrentSocialStatusForChannel",{channel : 1,user : userDetails.id},function(currentSocialStatusResponse){	
					
						if(currentSocialStatusResponse == '1'){
							
							
							FB.api('/me/adanews:preview', 'post', {article : url}, function(response) {
								console.log(response);
							  if (!response || response.error) {
							   
							  } else {
								  
								   
								
								  console.log(response.id);
								  console.log(url);
								  console.log("user id " + userDetails.id);
								 
								//$("#test").text("id : "+response.id);// read the response ID -lasantha
								$.post('http://www.globalsocialreader.com/facebookresponses/saveresponses/',{ channel: 1,response : response.id, user : userDetails.id , url : url}, function(data) {
									console.log(data);
								});
								//window.location.replace(url);
							  }
							});
						}//checking social status
					});
			
				
		 });
	   },5000);//Time out ends
	}//nid check ends
	
	
	getLinkProperties("test");
});
}




function getLinkProperties(linkurl){
	$(document).ready(function(){
		
			jQuery.ajax = (function(_ajax){
    
    var protocol = location.protocol,
        hostname = location.hostname,
        exRegex = RegExp(protocol + '//' + hostname),
        YQL = 'http' + (/^https/.test(protocol)?'s':'') + '://query.yahooapis.com/v1/public/yql?callback=?',
        query = 'select * from html where url="{URL}" and xpath="*"';
    
    function isExternal(url) {
        return !exRegex.test(url) && /:\/\//.test(url);
    }
    
    return function(o) {
        

        var url = o.url;
        
        if ( /get/i.test(o.type) && !/json/i.test(o.dataType) && isExternal(url) ) {
            
            // Manipulate options so that JSONP-x request is made to YQL
            
            o.url = YQL;
            o.dataType = 'json';
            
            o.data = {
                q: query.replace(
                    '{URL}',
                    url + (o.data ?
                        (/\?/.test(url) ? '&' : '?') + jQuery.param(o.data)
                    : '')
                ),
                format: 'xml'
            };
            
            // Since it's a JSONP request
            // complete === success
            if (!o.success && o.complete) {
                o.success = o.complete;
                delete o.complete;
            }
            
            o.success = (function(_success){
                return function(data) {
                    
                    if (_success) {
                        // Fake XHR callback.
                        _success.call(this, {
                            responseText: (data.results[0] || '')
                                // YQL screws with <script>s
                                // Get rid of them
                                .replace(/<script[^>]+?\/>|<script(.|\s)*?\/script>/gi, '')
                        }, 'success');
                    }
                    
                };
            })(o.success);
            
        }
        
        return _ajax.apply(this, arguments);
        
    };
    
})(jQuery.ajax);
		});
		
		
		
		
/*	 linkurl = "http://sinhala.adaderana.lk/news.php?nid=26528";
			$.ajax("http://www.globalsocialreader.com/feedrecords/givefeedrecordsforurl/",{ url: encodeURIComponent(linkurl)}, function(data){
				//$.post("http://www.globalsocialreader.com/feedrecords/test/",{ url: encodeURIComponent(linkurl)}, function(data){
	
			
		});*/
	
	}


// parseUri 1.2.2
// (c) Steven Levithan <stevenlevithan.com>
// MIT License

function parseUri (str) {
	var	o   = parseUri.options,
		m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
		uri = {},
		i   = 14;

	while (i--) uri[o.key[i]] = m[i] || "";

	uri[o.q.name] = {};
	uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		if ($1) uri[o.q.name][$1] = $2;
	});

	return uri;
};

parseUri.options = {
	strictMode: false,
	key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
	q:   {
		name:   "queryKey",
		parser: /(?:^|&)([^&=]*)=?([^&]*)/g
	},
	parser: {
		strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
		loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
	}
};


