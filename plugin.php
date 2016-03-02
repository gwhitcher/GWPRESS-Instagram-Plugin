<?php
//Admin listing
if(empty($plugins)) {
    $plugins = array();
}
$plugin = array(
    'plugin_title' => 'Instagram',
    'plugin_url' => '/admin/plugin/instagram',
    'plugin_description' => 'This is an Instagram feed plugin for GWPRESS.'
);
array_push($plugins, $plugin);

//Routes
if(empty($plugin_routes)) {
    $plugin_routes = array();
}
$plugin_route = array(
    'plugin_url' => '/admin/plugin/instagram',
    'plugin_page_name' => 'instagram/instagram.php'
);
array_push($plugin_routes, $plugin_route);

class InstagramPlugin {

    public function instagram_feed_data() {
        include(__DIR__."/config.php");
        $url = "https://api.instagram.com/v1/users/".$user_id."/media/recent?access_token=".$access_token."&count=".$count;
        if(!empty($_GET['max_id'])) {
            $url .= "&max_id=".$_GET['max_id'];
        }

        /*
        $url = "https://api.instagram.com/v1/tags/".$tag."/media/recent?client_id=".$client_id."&access_token=".$access_token."&count=".$count;
        if(!empty($_GET['max_id'])) {
            $url .= "&max_tag_id=".$_GET['max_id'];
        }
        */
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($ch);
        curl_close($ch);

        $instaData = json_decode($json);
        return $instaData;
    }

    public function instagram_feed($instaData) {
        //Turns off errors if any values are missing.  This will enable throughout GWPRESS use with caution.
        ini_set('error_reporting', E_STRICT);

        //Display for page view
        echo '<marquee behavior="scroll" direction="left" onMouseOver="this.setAttribute(\'scrollamount\', 0, 0);" OnMouseOut="this.setAttribute(\'scrollamount\', 6, 0);">';
        echo '<ul class="slide">';
        foreach ($instaData->data as $post) {
            echo '<li>';
            echo '<a target="blank" data-toggle="modal" data-target="#myModal'.$post->id.'">';
            echo '<img class="instagram-small" src="'.$post->images->low_resolution->url.'" alt="'.$post->caption->text.'" />';
            echo '</a>';
            echo '</li>';

            echo '<div id="myModal'.$post->id.'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'.htmlentities($post->caption->text).'</h4>
      </div>
      <div class="modal-body">
        <img class="img-responsive" src="'.$post->images->standard_resolution->url.'" alt="'.$post->caption->text.'" />
        <p><div class="label label-default">Description</div><br/>'.htmlentities($post->caption->text).' | '.htmlentities(date("F j, Y, g:i a", $post->caption->created_time)).'</p>
        <p><div class="label label-default">Link to Instagram post</div><br/><a href="'.$post->link.'" target="_blank">'.$post->link.'</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
        }
        echo '</ul></marquee>';
    }
}