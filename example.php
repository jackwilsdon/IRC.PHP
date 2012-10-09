<?PHP
//////////////////////////////////////////////////
//  _____ _____   _____   _____  _    _ _____   //
// |_   _|  __ \ / ____| |  __ \| |  | |  __ \  //
//   | | | |__) | |      | |__) | |__| | |__) | //
//   | | |  _  /| |      |  ___/|  __  |  ___/  //
//  _| |_| | \ \| |____ _| |    | |  | | |      //
// |_____|_|  \_\\_____(_)_|    |_|  |_|_|      //
//   by Jack Wilsdon (http://jackwilsdon.tk)    //
//////////////////////////////////////////////////
// IRC.PHP Class allows for a direct interface  //
//              from PHP to IRC.                //
//////////////////////////////////////////////////
//                Example Code                  //
//            (to be run from CLI)              //
//////////////////////////////////////////////////

// Require the class
require("irc.class.php");

// Generate a random username
$username = "ircPHP-".rand(1, 100);

// Channel to join
$channel = "##programmers";

// Create an instance of the class
$irc = new IRC("irc.freenode.net", $username);

// Loop until exit
while (!$exit) {
	while($data = fgets($irc->ircConnection)) { // Loop whilst data is available
		
		// Snippets taken from ircBotPHP, check it out! (http://github.com/crazyman10123/ircBotPHP/)
		
		// Explode data for checking stuff
		$newline_data = str_replace(array(chr(10), chr(13)), '', $data);
		$exploded_data = explode(" ", $newline_data);

		// Check for server connection (message 001)
		if ($exploded_data[1] == "001") {
			echo "Connected to server!\n";
			sleep(10); // Wait a bit
			$irc->joinChannel($channel); // Join channel
			echo "Joined channel!\n";
		}
		
		// Reply to messages
		if ($exploded_data[1] == "PRIVMSG" && $exploded_data[2] != $username) {
			$irc->message($exploded_data[2], "You said '".substr($exploded_data[3], 1)."'"); // Send message back to sender
			echo $exploded_data[2]." said '".substr($exploded_data[3], 1)."'\n"; // Log it
		}
		
	}
}
?>