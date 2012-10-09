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

class IRC
{

	// Create IRC connection holder
	public $ircConnection = "";

	// Class constructor
	// Usage: IRC(server, nick)
	public function IRC($server, $nick) {
		if ($this->ircConnection = fsockopen($server, 6667)) {
			fputs($this->ircConnection,"NICK ".$nick."\r\n");
			fputs($this->ircConnection,"USER ".$nick." * * :".$nick."\r\n");
		} else {
			die("Unable to connect!");
		}
	}
	
	// Personal message method
	// Usage: message(recipient, message)
	public function message($recipient, $message) {
		global $ircConnection;
		fputs($this->ircConnection, "PRIVMSG ".$recipient." :".$message."\r\n");
	}
	
	// Action method
	// Usage: action(recipient, action)
	public function action($recipient, $action) {
		global $ircConnection;
		fputs($this->ircConnection,"PRIVMSG ".$recipient." :".chr(1)."ACTION ".$action.chr(1)."\r\n");
	}
	
	// Disconnect method
	// Usage: disconnect(message, channel)
	public function disconnect($message, $channel) {
		global $ircConnection;
		fputs($this->ircConnection, "PART ".$channel." :".$message."\r\n");
		fclose($ircConnection);
	}
	
	// Join channel method
	// Usage: joinChannel(channel)
	public function joinChannel($channel) {
		global $ircConnection;
		fputs($this->ircConnection, "JOIN ".$channel."\r\n");
	}
	
	// Channel change method
	// Usage: changeChannel(old channel, new channel)
	public function changeChannel($oldChannel, $newChannel) {
		global $ircConnection;
		fputs($this->ircConnection, "PART ".$config->channel." :Changing channel to ".$channel."\r\n");
		fputs($this->ircConnection,"JOIN ".$channel."\r\n");
		$config->channel = $channel;
	}

	// Raw command method
	// Usage: rawCommand(command)
	public function rawCommand($command) {
		global $ircConnection;
		fputs($this->ircConnection, $command."\r\n");
	}
}
?>
