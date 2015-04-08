$(function() {
	$('#uploadForm').submit(function() {
		var fd = new FormData($('#uploadForm').get(0));
		$.ajax({
			url : "/upload.php",
			type : "POST",
			data : fd,
			processData : false,
			contentType : false,
			dataType : 'json'
		}).done(function(data) {
			var img = $('<img>');
			img.attr('src', "data:image/jpeg;base64," + data.base64);
			$('#size28img').html('');
			$('#size28img').append(img);

			$('#detectImage #hiddenarea').html('');
			var counter = 0;
			for ( var y in data.pixel) {
				var line = data.pixel[y];
				for ( var x in line) {
					var hidden = $('<input>');
					hidden.attr('name', 'f' + counter);
					hidden.attr('type', 'hidden');
					hidden.attr('value', line[x]);
					counter++;
					$('#hiddenarea').append(hidden);
				}
			}
		});
		return false;
	});
	$('#detectImage').submit(function() {
		var amlUrl = $('#azuremlurl').val();
		if(amlUrl == null || amlUrl == ""){
			alert("Azure ML APIのURLを入力してください。")
			return false;
		}
		var input = $('<input>');
		input.attr('name', 'url');
		input.attr('type', 'hidden');
		input.attr('value', amlUrl);
		$('#hiddenarea').append(input);
		
		var apikey = $('#apikey').val();
		if(apikey == null || apikey == ""){
			alert("Azure ML APIのAPI KEYを入力してください。")
			return false;
		}
		var inputKey = $('<input>');
		inputKey.attr('name', 'api_key');
		inputKey.attr('type', 'hidden');
		inputKey.attr('value', apikey);
		$('#hiddenarea').append(inputKey);

		var fd = new FormData($('#detectImage').get(0));
		$('#result').html('<img src="/img/loading.gif" alt="loading" />');
		$.ajax({
			url : "/detect.php",
			type : "POST",
			data : fd,
			processData : false,
			contentType : false,
			dataType : 'json'
		}).done(function(data) {
			if (data.error != null) {
				$('#result').text(data.error.message);
			} else {
				$('#result').text(data.Results.output1.value.Values[0][795]);
			}
		});
		return false;
	});
});
