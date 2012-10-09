IRC.PHP
=======
Connecting IRC and PHP with ease
--------------------------------
This class is mostly documented, but some code is self explainatory. For an example, try running `example.php` in the command line, and check out it's source.
You should also try looking at `irc.class.php`, as it has some usage info on each method.

Documentation
=============
The Constructor
---------------
The constructor of this class is reasonably simple; you just need to pass it the IRC network and username.
> $irc = new IRC("irc.freenode.net", "##programmers");
From $irc, you can call any of the following methods on the connection;

message
-------
This method simply allows you to send a message to a recipient.
> $irc->message("jackwilsdon", "Hello there!");

action
------
This method calls the ACTION 'method' on the IRC network.
> $irc->action("slaps jackwilsdon");
This will output `<bot username> slaps jackwilsdon` on the IRC network. It may appear different, dependant on the user's client.

disconnect
----------
This method simply disconnects you from the server, but does not exit the PHP script.
Ensure that 'channel' is set to the current channel!
> disconnect("bye bye!", "##programmers");

joinChannel
-----------
This method joins a channel. It should only be called on join of the server. For changing channels, use changeChannel.
> joinChannel("##programmers");

changeChannel
-------------
This function moves you from one channel to another. You need to pass it the old and new channel names.
> changeChannel("##programmers", "#freenode");

rawCommand
----------
This sends a raw command to the server, such as `PRIVMSG tcial :Howdy!` or `NOTICE tcial :Hello!`.
> rawCommand("PRIVMSG tcial :Hello World!");

If you have any problems or questions, please don't hesitate to use the **issue tracker**!