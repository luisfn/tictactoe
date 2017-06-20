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
        .result {
            display: none;
        }

        .btn {
            margin-bottom: 20px;
            margin-top: 20px;
        }

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

    <div class="row">
        <div class="col-md-6 text-center">
            <h1>Tic Tac Toe</h1>
            <p class="lead">A PHP written Game</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 text-center">
            <table align="center">
                <tr>
                    <td class="cell cell_0_0 clickable" id="cell_0_0"></td>
                    <td class="cell cell_0_1 clickable" id="cell_0_1"></td>
                    <td class="cell cell_0_2 clickable" id="cell_0_2"></td>
                </tr>
                <tr>
                    <td class="cell cell_1_0 clickable" id="cell_1_0"></td>
                    <td class="cell cell_1_1 clickable" id="cell_1_1"></td>
                    <td class="cell cell_1_2 clickable" id="cell_1_2"></td>
                </tr>
                <tr>
                    <td class="cell cell_2_0 clickable" id="cell_2_0"></td>
                    <td class="cell cell_2_1 clickable" id="cell_2_1"></td>
                    <td class="cell cell_2_2 clickable" id="cell_2_2"></td>
                </tr>
            </table>
            <input type="button" value="New Game" class="btn btn-primary" onclick="reset()">
        </div>

        <div class="col-md-6">
            <div class="jumbotron result">
                <h1 class="message"></h1>
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">

    var playerSymbol = "X";
    var botSymbol = "O";
    var gameIsRunning = true;

    /**
     * Makes every position able to click
     */
    $('.cell').on( "click", function() {
        if ($(this).hasClass('clickable') && gameIsRunning) {
            var id = $(this).attr('id');

            markPosition(id, playerSymbol)
            sendPlayerSelection(id, 'human');
        }
    });

    /**
     * Mark position position on the board
     */
    function markPosition(id, symbol) {
        var el = $('#' + id);
        el.html(symbol);
        el.removeClass('clickable');
    }

    /**
     * Replicate the game board state on the ui
     */
    function loadGameBoard() {
        var board = $.getJSON( "/getGameState");

        board.done(function(data){
            for (x in data) {
                for ( y in data[x]) {
                    if (data[x][y]) {
                        var identifier = 'cell_' + x + '_' + y;
                        markPosition(identifier, data[x][y].symbol);
                    }
                }
            }
        });
    }

    /**
     * Send a player choice to the backend
     * @param cellIdentifier
     */
    function sendPlayerSelection(id, playerType) {
        var pos = id.split('_');
        var data = {'x': pos[1], 'y': pos[2], 'type' : playerType};

        $.ajax({
            type: "POST",
            url: "/makeMove",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            success: function(data) {
                if (data.won === true) {
                    gameIsRunning = false;
                    $('.result').show();
                    $('.message').html(data.msg);
                    return;
                }

                if (data.remainingMoves == 0) {
                    $('.result').show();
                    $('.message').html('It\'s a draw =^_^=');
                }

                if (playerType == 'human') {
                    makeBotMove();
                }
            }
        });
    }

    /**
     * Get next Bot move
     */
    function makeBotMove() {
        var move = $.getJSON( "/getBotMove");
        move.done(function(data){
            var id = 'cell_' + data[0] + '_' + data[1];

            sendPlayerSelection(id, 'bot');
            markPosition(id, botSymbol);
        });
    }

    /**
     * Reset game data
     */
    function reset() {
        gameIsRunning = true;
        $('.result').hide();
        $.get( "/reset").done(function(){
            $('.cell').html('').addClass('clickable');
        });
    }

    loadGameBoard();
</script>

</body>
</html>
