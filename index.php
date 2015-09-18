<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="bower_components/mustache/mustache.min.js" type="text/javascript" charset="utf-8"></script>
	<script>

	function display(){

		$.getJSON("ajaxGet.php").done(function(data){

			var template = "{{#.}}"+
			"<li>{{username}} {{password}}</li>"+
			"{{ /. }}";

			var html = Mustache.to_html(template, data);

			$('ul').html(html);

		}).fail(function(data){

			throw new Error(data.responseText);

		});

	}

	</script>
</head>
<body onload="display();">
	<fieldset>
		<legend>Test</legend>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
			<label for="username">USERNAME:<input type="text" name="username" id="username"></label><br>
			<label for="password">PASSWORD:<input type="text" name="password" id="password"></label><br>
			<input id="submit" type="submit" value="Submit">
		</fieldset>

		<ul>

		</ul>
		<script type="text/javascript">
		$(document).ready(function(){

			function long_pooling(counter){

				var deferred = $.Deferred();
				var passcounter = {'passcounter' : counter};

				$.ajax({
					url: "long_pooling.php",
					type: 'GET',
					async : true,
					cache : false,
					data: passcounter,
					dataType: 'json'})
				.done(function(data){

					deferred.resolve(data.passcounter);
					long_pooling(data.passcounter);
					display();

				}).fail(function(data){

					deferred.reject(data.passcounter);
					long_pooling();
					throw new Error(data.responseText);
					

				});

				return deferred.promise();
			}

			$('form').submit(function(e){

				e.preventDefault();

				$.post("ajaxPost.php",$(this).serialize()).done(function(data){

					

				}).fail(function(data){
					
					throw new Error(data.responseText);
				});

			});

			long_pooling().progress(function(status){

				console.log( status + " notifications.." );
				
			}).done(function(status){

				console.log( status + " things are going well" );

			}).fail(function(status){

				console.log( status + " you fail this time" );
			});
		});
</script>
</body>
</html>