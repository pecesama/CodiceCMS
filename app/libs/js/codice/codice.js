$(document).ready(function(){
	var VALID_NOT_EMPTY = RegExp(".+");
	var VALID_NUMERIC = RegExp("[0-9]+");
	var VALID_EMAIL = RegExp("^[a-zA-Z0-9]{1}([\._a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+){1,3}$");
	var VALID_URL = RegExp("^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$");

	/* Carga footer y links via ajax. Es mas divertido ¿que no? */
	$.ajax({
		url: relativePathToApp + 'index/ajax/index_sidebars',
		success: function(data) {
			$("div#contenido").append(data);
			$.ajax({
				url: relativePathToApp + 'index/ajax/index_footer',
				success: function(data) {
					$("div#contenido").append(data);
				}
			});
		}
	});

	/*
	 * Comments validations.
	 */
	var datos = new Object();
	var mensaje = new Object();

	mensaje["loading"] = "<div id=\"loading\">Por favor espere un momento...</div>";

	$("form#commentform").submit(function(){
		
		datos["resultado"] = $("form#commentform input#resultado").val();
		if(!VALID_NUMERIC.test(datos["resultado"])){
			alert("Escribe el resultado de la suma 2 + 3.");
			$("form#commentform input#resultado").focus();
			return false;
		}else{
			if(datos["resultado"] != 5){
				alert("Por favor, escribe correctamente la suma de 2 + 3");
				$("form#commentform input#resultado").focus();
				return false;
			}
		}
		
		datos["author"] = $("form#commentform input#author").val();
		if(!VALID_NOT_EMPTY.test(datos["author"])){
			alert("Escribe tu nombre.");
			$("form#commentform input#author").focus();
			return false;
		}

		datos["email"] = $("form#commentform input#email").val();
		if(!VALID_EMAIL.test(datos["email"])){
			alert("El email escrito es incorrecto.");
			$("form#commentform input#email").focus();
			return false;
		}

		datos["url"] = $("form#commentform input#url").val();
		if(VALID_NOT_EMPTY.test(datos["url"])){
			if(!VALID_URL.test(datos["url"])){
				alert("El Website tiene formato incorrecto. \n\n El formato correcto debe llevar http:// al inicio.");
				$("form#commentform input#url").focus();
				return false;
			}
		}

		datos["content"] = $("form#commentform textarea#content").val();
		if(!VALID_NOT_EMPTY.test(datos["content"])){
			alert("Escribe un comentario primero.");
			$("form#commentform textarea#content").focus();
			return false;
		}

		datos["id"] = 0;
		datos["formAction"] = $("form#commentform").attr("action");

		$.ajax({
			url: datos["formAction"],
			cache: false,
			beforeSend: function(){
				$("form#commentform input#resultado").attr("disabled", true);
				$("form#commentform input#author").attr("disabled", true);
				$("form#commentform input#email").attr("disabled", true);
				$("form#commentform input#url").attr("disabled", true);
				$("form#commentform input#suscribe").attr("disabled", true);
				$("form#commentform textarea#content").attr("disabled", true);
				$("form#commentform input#submit").attr("disabled", true);

				$("div.commentlist").append(mensaje["loading"]);
				$.scrollTo("div#loading", 200);
			},
			global: false,
			type: "POST",
			data: ({resultado: datos["resultado"], author: datos["author"],url: datos["url"], content: datos["content"], email: datos["email"]}),
			dataType: "html",
			success: function(msg){
				datos["id"] = msg;
				datos["created"] = date("Y-m-d G:i:s", time());

				datos["content"] = str_replace("<","&lt;",datos["content"]);
				datos["content"] = str_replace(">","&gt;",datos["content"]);
				datos["content"] = str_replace("\n","<br>",datos["content"]);
				
				mensaje["comentario"] = "\
				<div class=\"comentario\" id=\"comment-" + $.trim(datos["id"]) + "\"> \
					<div class=\"waiting\">Tu mensaje está en espera de aprobación. Muchas gracias por comentar!</div>\
					<img alt=\"\" src=\"http://www.gravatar.com/avatar/" + md5(datos["email"]) + "}?s=50\" class=\"avatar avatar-50 photo\" width=\"50\" height=\"50\"> \
					<p class=\"comment_author\"> \
						<a href=\"" + datos["url"] + "\" class=\"url\">" + datos["author"] + "</a> \
					</p> \
					<div class=\"comment_meta commentmetadata\"> \
						<p> \
							<a href=\"#comment-" + datos["id"] + "\">" + datos["created"] + "</a> \
						</p> \
					</div> \
					<div class=\"comment_txt\"> \
						<p>" + datos["content"] + "</p> \
					</div> \
				</div> \
				";

				$("div#loading").fadeOut("slow"); 
				$("div#loading").remove();

				$("form#commentform input#resultado").removeAttr("disabled");
				$("form#commentform input#author").removeAttr("disabled");
				$("form#commentform input#email").removeAttr("disabled");
				$("form#commentform input#url").removeAttr("disabled");
				$("form#commentform input#suscribe").removeAttr("disabled");
				$("form#commentform textarea#content").removeAttr("disabled");
				$("form#commentform input#submit").removeAttr("disabled");

				$("div.commentlist").append(mensaje["comentario"]);
				$.scrollTo("div#comment-" + $.trim(datos["id"]), 200);

				$("form#commentform textarea#content").val("");
				alert("Thanks for commenting " + datos["author"] + ".");
			},
			error: function(xhr,error){
				alert("Algo andubo mal con tu conexión a internet. Por favor intenta una vez mas.");
			}
		});

		return false;
	});
});
