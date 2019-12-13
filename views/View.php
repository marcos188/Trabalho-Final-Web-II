<?php
class View{
    public function render_index($message) {
        // load template from html
        $html = file_get_contents('Views/templates/index.html');
        //send HTML to output
        print $html;
	}
}
