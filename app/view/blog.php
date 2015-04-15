<?php
/**
 * blog.php
 *
 * View for the blog system.
 * 
 */

use axion\gui;
$blog_gui = new gui\Blog_gui();


$body = $blog_gui->show_all();
?>
[[NAV]]
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="content-main">
                <h2>Blog goes here</h2>

                <?php
                echo $body;
                ?>
            </div>
		</div>
	</div>
</div>

