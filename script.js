$( "#dialog" ).dialog({ autoOpen: true });
$( "#opener" ).click(function() {
  $( "#dialog" ).dialog( "open" );
  $("#dialog").trigger("reset");
  return false;
});
$( "#dialog1" ).dialog({ autoOpen: false });
$( "#opener1" ).click(function() {
  $( "#dialog1" ).dialog( "open" );
  $( "#dialog" ).dialog( "close" );
  return false;
});
$( "#opener" ).click(function() {
  $( "#dialog" ).dialog( "open" );
  $("#dialog").trigger("reset");
  $( "#dialog1" ).dialog( "close" );
  return false;
});

$(document).ready(function() {
	$("#first").bind("click",function() {
    $.post("register.php",{login:$("#login").val(),
    password:$("#password").val(),
    confirm_password:$("#confirm_password").val(),
    email:$("#email").val(),
    name:$("#name").val(),
  },function(data)
  {
    data = JSON.parse(data);
    for(var id in data)
    {
      if (data[id]=="success")
      {
        alert(data[id]);
        $("#dialog").trigger("reset");
      }
      else {
        alert(data[id]);
      }
    }
  });
    //$("#dialog").trigger("reset");
    return false;
	});
});

$(document).ready(function() {
	$("#second").bind("click",function() {
    $.post("autorization.php",{login:$("#login1").val(),
    password:$("#password1").val(),
  },function(data)
  {
    data = JSON.parse(data);
    for(var id in data)
    {
      alert(data[id]);
      //$("#dialog").trigger("reset");
    }
  });
    //$("#dialog").trigger("reset");
    return false;
	});
});

/*$(document).ready(function() {
	$("#dialog1").submit(function() {
		$.ajax({
			type: "POST",
			url: "autorization.php",
			data: $(this).serialize()
		}).done(function() {
			$(this).find("input").val("");
			alert("Спасибо за заявку! Скоро мы с вами свяжемся.");
			$("#dialog1").trigger("reset");
		});
		return false;
	});
});
/*$(document).ready(function() {
	$("#dialog").submit(function() {
		$.ajax({
			type: "POST",
			url: "main.php",
			data: ({login: $("#login").val(),
        password: $("#password").val(),
        confirm_password: $("#confirm_password").val(),
        email: $("#email").val(),
        name: $("#name").val()
		}),
    dataType:"html"
	});
});
$("#form").trigger("reset");
});*/
