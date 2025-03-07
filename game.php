<?php
    // Check username is set otherwise kill the page
    if ( ! isset($_GET['username']) || strlen($_GET['username']) < 1  ) {
        die('Name parameter missing');
    }

    // Logout button in the HTML form
    if ( isset($_POST['logout']) ) {
        header('Location: index.php');
        return;
    }

    // Set up the values for the game...
    // 0 is Rock, 1 is Paper, and 2 is Scissors
    $names = array('Rock', 'Paper', 'Scissors');
    $human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

    $computer = rand(0,2); // Generate a play for the computer

    // Compare plays
    function check($computer, $human) {
        if ( $human == $computer ) {
            return "Tie";
        } else if (($human == 0 && $computer == 2) || ( $human == 1 && $computer == 0) || ( $human == 2 && $computer == 1)) { 
            return "You Win";
        } else {
            return "You Lose";
        }
        return false;
    }

    // Check to see who won
    $result = check($computer, $human);
?>

<!DOCTYPE html>
<html>
<head>
<title>Jack Marshall's Rock, Paper, Scissors Game</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Rock Paper Scissors</h1>
<?php
// Display a welcome message if username is set
if ( isset($_REQUEST['username']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['username']);
    echo "</p>\n";
}
?>
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<pre>
<?php
if ( $human == -1 ) { // Default select option in the HTML form
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) { // Test option (3) in the HTML form
    for($c=0;$c<3;$c++) {
        for($h=0;$h<3;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else { // Options 0-2 (Rock, Paper, or Scissors) in the HTML form
    print "Your Play=$names[$human] Computer Play=$names[$computer] <strong>Result=$result</strong>\n";
}
?>
</pre>
</div>
</body>
</html>
