<?php
/*
Plugin Name: Technical Problem Solver
Plugin URI: http://wordpress.org/extend/plugins/technical-problem-solver/
Description: Have a technical problem on your WordPress site? This plugin will give the answer. Or at least it tries to help you. :)
Author: Jeroen G
Version: 1.0
*/

function tps_get_answer($question) {
	// These are the possible answers
	$lyrics = "Have you tried updating?
Well, that is a problem, isn't it?
Please ask this question <a href=\"http://wordpress.org/support/\" target=\"_blank\">to one of my assistants</a>.
Is everything plugged in?
Let's try my own <a href=\"http://google.com\" target=\"_blank\">superknowledgedatabase</a>!
There is (probably) a <a href=\"http://wordpress.org/extend/plugins/search.php?q=$question\" target=\"_blank\">plugin</a> for that.
If you're a developer, take a look <a href=\"http://xref.yoast.com/\" target=\"_blank\">at this</a>.
<a href=\"http://lmgtfy.com/?q=$question\" target=\"_blank\">Let me Google that for you</a> :)
Have you searched on the <a href=\"http://wordpress.org/search/$question\" target=\"_blank\">briljant WordPress.org Codex</a>?
Are you sure that you wrote WordPress with a <a href=\"http://capitalp.org/\" target=\"_blank\">capital P</a>?
If you're a designer, make sure that you and your clients <a href=\"http://browsehappy.com/\" target=\"_blank\">browse happy</a>.
Code is Poetry. So why don't you search for a <a href=\"http://codepoet.com/\" target=\"_blank\">poet</a>?
If at first you don't succeed; call it version 1.0.
That isn't a bug! That's just a random feature!
Are all of the ',\"; in the right place?";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// We need some CSS to position the text and the form
function tps_css() {
	echo "
	<style type='text/css'>
	#tpspage {		
		margin: 20px;
		padding-top: 100px;
		padding-left: 200px;
		font-size: 12px;
	}
	</style>
	";
}

add_action( 'admin_head', 'tps_css' );

// The page on which you could ask everything :)
function tps_page() {
	echo "<div id=\"tpspage\">";
	if(isset($_POST['question'])) {
	$chosen = tps_get_answer($_POST['question']);
	echo "<h2 id='dolly'>$chosen</h2>";
	echo "<p><strong><a href=\"index.php?page=technical-problem-solver\">New question</a></strong></p>";
	}
	else {
	?>
	<h2>Technical Problem Solver</h2>
	<p>
	Stuck on an error while developing? Don't know what to do next? Use the <i>Tecnical Problem Solver</i>!
	<br />
	The very smart <i>Technical Problem Solver Engine</i> will give the answer ( or at least tries to help you. :) )
	<br />
	Please enter your question below and press the button.
	</p>
	<form method="POST" action="index.php?page=technical-problem-solver" />
	<input type="text" name="question" size="70" />
	<input type="submit" value="Give me the answer!" />
	</form>
	<?php
	}
	echo "</div>";
}

// Add the page, under the Dashboard menu
function tps_add_page() {
	add_dashboard_page('Technical Problem Solver', 'Problem Solver', 'manage_options', 'technical-problem-solver', 'tps_page');
}
add_action('admin_menu', 'tps_add_page');
?>
