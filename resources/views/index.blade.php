<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
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

<input type="button" value="Make Call" onclick="makeCall()">
<input type="button" value="Reset" onclick="reset()">