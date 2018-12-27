<?php 
    // define variables and set to empty values
    $password = $username = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
?>

<head>
	<title>THE GAME</title>

	<link rel="stylesheet" href="game.css">
	<script src="globals.js"></script>
	<script src="Game/Commands/command.js"></script>
	<script src="Game/Items/baseitem.js"></script>
	<script src="Game/World/world.js"></script>
	<script src="Game/Player/inventory.js"></script>
	<script src="Game/Player/player.js"></script>
	<script src="Game/gamelog.js"></script>

	<!-- COMMANDS -->
	<script src="Game/Commands/Commands/help.js"></script>
	<script src="Game/Commands/Commands/move.js"></script>
	<script src="Game/Commands/Commands/devcommands.js"></script>	
	<script src="Game/Commands/Commands/player.js"></script>	
	<script src="Game/Commands/Commands/shop.js"></script>	

	<script src="Game/Commands/commands.js"></script>

	<script src="Game/game.js"></script>
</head>

<body>
	<nav class="nav">
		<ul>
			<li><a>About</a>
		</ul>
	</nav>

	<div class="htmlConsole">
		<div class="innerConsole">
			<span class="labels">
				<p id="console0">""</p>
				<p id="console1">""</p>
				<p id="console2">""</p>
				<p id="console3">""</p>
				<p id="console4">""</p>
				<p id="console5">""</p>
				<p id="console6">""</p>
				<p id="console7">""</p>
				<p id="console8">""</p>
				<p id="console9">""</p>
				<p id="console10">""</p>
				<p id="console11">""</p>
				<p id="console12">""</p>
				<p id="console13">""</p>
				<p id="console14">""</p>
				<p id="console15">""</p>
				<p id="console16">""</p>
				<p id="console17">""</p>
			</span>

			<input type="text" name="playerInput" autocomplete="off" id="input" style="width: 50%; margin-left: 25%;" onkeypress="return keyPressed(event)">

			<script type="text/javascript">
				function keyPressed(e) {
					var keynum;

					if (window.event) { // IE                    
						keynum = e.keyCode;
						
					} else if (e.which) { // Netscape/Firefox/Opera                   
						keynum = e.which;

					}

					// Enter keypress
					if (keynum == 13) {
						var textIn = document.getElementById('input').value;
						console.log("Sent input: " + textIn);
						SendKey(textIn);

						document.getElementById('input').value = '';

					}
				}
			</script>

			<!-- Start Game -->
			<script>
				console.log("Username: " + "<?php echo "$username"?>");
				console.log("Password: " + "<?php echo "$password"?>");

				StartGame("<?php echo "$username"?>");

			</script>
		</div>
	</div>
	
	<div class="bottombar">
		<p>Made by Mattias (Mew_) Viklund</p>
		<p>Sweden</p>

	</div>
</body>