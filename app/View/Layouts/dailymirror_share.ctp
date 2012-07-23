<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
        <title>OG Sample Object - Sample Article</title>

        <meta property="fb:app_id" content="130340437106511" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo "The Indian Government has extended the ban on LTTE declaring that it continues to adopt a strong anti-India posture and pose a grave threat to the security of its citizens"; ?>" />
        <meta property="og:image" content="<?php echo $image; ?>" />
        <meta property="og:site_name" content="DailyMirror.com"/>
        <meta property="og:url" content="<?php echo $url; ?>" />
        


  
    </head>
    <body>
        <div id="fb-root"></div>
        <div id="main" class="container_16">
                <div id="content" class="grid_11">
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $content_for_layout;
                    ?>
                </div>

                
                <div class="clear"></div>
            </div>


    </body>
 </html>
