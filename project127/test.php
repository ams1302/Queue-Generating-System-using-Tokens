<!DOCTYPE html>
    <html>    
        <head>        
        <title>jQuery DatePicker</title>        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="src/jquery.simple-dtpicker.js"></script>
        <link type="text/css" href="src/jquery.simple-dtpicker.css" rel="stylesheet" />
            </head>
            <body>
            <h3>Inline</h3>	<div id="date_picker"> </div>	<script type="text/javascript">		$(function(){			$('#date_picker').dtpicker();		});	</script>	<h3>Append to Input-field</h3>	<input type="text" name="date" value="">	<script type="text/javascript">		$(function(){			$('*[name=date]').appendDtpicker();		});	</script>	<h3>Append to Input-field (Inline)</h3>	<input type="text" name="date2" value="2012/01/01 10:00">	<script type="text/javascript">		$(function(){			$('*[name=date2]').appendDtpicker({"inline": true});		});	</script>
                                
            </body>
            </html>