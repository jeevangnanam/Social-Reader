<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
		$appId = '260093750761802';
        echo $this->Html->css(array(
           
            'custom',
            '/js/facebox/src/facebox'
        ));
        echo $this->Layout->js();
        echo $this->Html->script(array(
            'jquery/jquery.min',
			'facebox/src/facebox',
            'custom'
        ));

        ?>
    </head>
    <body style="margin:0px;padding:0px;">

                    <?php
                   
                    echo $content_for_layout;
                    ?>

       
        <div id="fb-root"></div>
    <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '<?php echo $appId; ?>', // App ID
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
    };

    // Load the SDK Asynchronously
    (function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
  </script>
    </body>
</html>