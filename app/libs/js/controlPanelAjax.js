$(document).ready(function(){
	$("td.actions a").click(function(){
		var debug = "";//borrame cuando termines
		var row = new Object();

		row["href"] = $(this).attr("href");
		row["action"] = $(this).attr("class");
		row["id"] = $(this).attr("title");

		if(row["action"] == "remove"){
			if(!confirm("are you serious?")){
				return false;
			}
			
			$.ajax({
				beforeSend: function(){
					$("tr#reg" + row["id"] + " td:eq(0)").prepend("<strong>Borrando, espere...</strong><br>");
				},
				cache: false,
				data: {id: row["id"]},
				dataType: "text",
				error: function(){
					alert("Algo andubo mal con tu conexión a internet. Por favor intenta una vez mas.");
				},
				success: function(){
					$("tr#reg" + row["id"]).fadeOut(400,function(){$("tr#reg" + row["id"]).remove();});
				},
				type: "GET",
				url: row["href"]
			});
			return false;
		}

		if(row["action"] == "approve"){
			if($("tr#reg" + row["id"] + " td:eq(1)").hasClass("false") || true){
				$.ajax({
					beforeSend: function(){
						$("tr#reg" + row["id"] + " td:eq(1)").html("Espere...");
					},
					cache: false,
					data: {id: row["id"]},
					dataType: "text",
					error: function(){
						alert("Algo andubo mal con tu conexión a internet. Por favor intenta una vez mas.");
					},
					success: function(){
						$("tr#reg" + row["id"] + " td:eq(1)").removeClass("false");
						$("tr#reg" + row["id"] + " td:eq(1)").addClass("true");
						$("tr#reg" + row["id"] + " td:eq(1)").html("published");
					},
					type: "GET",
					url: row["href"]
				});
			}else{
				alert("Ya está aprobado.");
				return false;
			}
			return false;
		}
	});
});