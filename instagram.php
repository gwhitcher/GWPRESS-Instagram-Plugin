<style type="text/css">
    ul.slide {
        margin:0 0 15px 0;
        padding:0;
        height:300px;
        list-style-type:none;
    }
    ul.slide li{
        float:left;
        list-style-type:none;
        margin: 5px;
    }
    ul.slide .instagram-small {
        border:1px solid silver;
        height:300px;
        cursor: pointer; cursor: hand;
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Instagram Feed</h1>
<?php
//Copy this into your page to display your feed.
$plugin = new InstagramPlugin();
$instaData = $plugin->instagram_feed_data();
echo $plugin->instagram_feed($instaData);
?>
</div>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header">Instagram Marquee</h2>
    <p>Add these files to your CSS and JS files to enable a scrolling marquee of your Instagram feed.</p><br />
    <div class="form-group">
        <label for="css" class="col-sm-2 control-label">PHP</label>
        <div class="col-sm-10">
            <textarea class="form-control" readonly>
            //Copy this into your page to display your feed wrapped in a PHP tag.
            $plugin = new InstagramPlugin();
            $instaData = $plugin->instagram_feed_data();
            echo $plugin->instagram_feed($instaData);
            </textarea>
            <br />
        </div>

    </div>

    <div class="form-group">
        <label for="css" class="col-sm-2 control-label">CSS</label>
        <div class="col-sm-10">
    <textarea class="form-control" readonly><style type="text/css">
            ul.slide {
                margin:0;
                padding:0;
                height:100px;
                list-style-type:none;
            }
            ul.slide li{
                float:left;
                list-style-type:none;
                margin: 5px;
            }
            ul.slide .instagram-small {
                border:1px solid silver;
                height:100px;
                cursor: pointer; cursor: hand;
            }
        </style></textarea>
            <br />
        </div>

    </div>
    </div>