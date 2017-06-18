<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tic Tac Toe">
    <meta name="author" content="Luis Fernando do Nascimento">
    <link rel="icon" href="../../favicon.ico">

    <title>Tic Tac Toe</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <style>
        .cell {
            border: solid #0e0e0e;
            height: 80px;
            width: 80px;
            text-align: center;
            font-size: 40px;
            cursor: pointer;
        }

        .cell_0_0 {
            border-width: 0 5px 5px 0;
        }

        .cell_0_1 {
            border-width: 0 0 5px 0;
        }

        .cell_0_2 {
            border-width: 0 0 5px 5px;
        }

        .cell_1_0 {
            border-width: 0 5px 0 0;
        }

        .cell_1_1 {
            border-width: 0 0 0 0;
        }

        .cell_1_2 {
            border-width: 0 0 0 5px;
        }

        .cell_2_0 {
            border-width: 5px 5px 0 0;
        }

        .cell_2_1 {
            border-width: 5px 0 0 0;
        }

        .cell_2_2 {
            border-width: 5px 0 0 5px;
        }
    </style>
</head>

<body>
<div class="container">

    <input type="button" value="Make Call" onclick="makeCall()">
    <input type="button" value="Reset" onclick="reset()">

    <div>
        <h1>Tic Tac Toe</h1>
        <p class="lead">A PHP written Game</p>
    </div>

    <table>
        <tr>
            <td class="cell clickable cell_0_0"></td>
            <td class="cell clickable cell_0_1"></td>
            <td class="cell clickable cell_0_2"></td>
        </tr>
        <tr>
            <td class="cell clickable cell_1_0"></td>
            <td class="cell clickable cell_1_1"></td>
            <td class="cell clickable cell_1_2"></td>
        </tr>
        <tr>
            <td class="cell clickable cell_2_0"></td>
            <td class="cell clickable cell_2_1"></td>
            <td class="cell clickable cell_2_2"></td>
        </tr>
    </table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">

    var playerMark = "X";
    var botMark    = "O";


    $('.clickable').click(function() {
        var classes = ($(this).attr('class').split(' '));

        $('.' + classes[2]).html(playerMark);

        $(this).removeClass('clickable');
    });


    function makeCall() {
        $.getJSON( "/getNextMove", function( json ) {
            console.log( "JSON Data: " + json );
        });
    }

    function reset() {
        $.getJSON( "/reset", function( json ) {
            console.log( "JSON Data: " + json );
        });
    }
</script>

</body>
</html>
