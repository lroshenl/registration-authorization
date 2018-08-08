$( "#dialog_registration" ).dialog({ autoOpen: true });
$( "#opener_registration" ).click(function() {
  $( "#dialog_registration" ).dialog( "open" );
  $("#dialog_registration").trigger("reset");
  return false;
});
$( "#dialog_autorization" ).dialog({ autoOpen: false });
$( "#opener_autorization" ).click(function() {
  $( "#dialog_autorization" ).dialog( "open" );
  $( "#dialog_registration" ).dialog( "close" );
  return false;
});
$( "#opener_registration" ).click(function() {
  $( "#dialog_registration" ).dialog( "open" );
  $("#dialog_registration").trigger("reset");
  $( "#dialog_autorization" ).dialog( "close" );
  return false;
});

$(document).ready(function() { //sending data from register form
	$("#first").bind("click",function() {
    $.post("register.php",{login:$("#login_registration").val(),
    password:$("#password_registration").val(),
    confirm_password:$("#confirm_password").val(),
    email:$("#email_registration").val(),
    name:$("#name_registration").val(),
  },function(data)
  {
    data = JSON.parse(data);
    for(var id in data)
    {
      if (data[id]=="success")
      {
        alert(data[id]);
        $("#dialog_registration").trigger("reset");
      }
      else {
        alert(data[id]);
      }
    }
  });
    return false;
	});
});

function delete_cookie ( cookie_name )//deleting cookie
{
  var cookie_date = new Date ( );
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}

$('#MyButton').hide();//hiding botoom

var button = document.querySelector("#MyButton");
  button.addEventListener("click", function() {
    delete_cookie("login");
    location.reload();
  });

$(document).ready(function() {//sending data from autorization form
	$("#second").bind("click",function() {
    $.post("autorization.php",{login:$("#login_autorization").val(),
    password:$("#password_autorization").val(),
  },function(data){
    data = JSON.parse(data);
    for(var id in data){
      if(data[id]=="success"){
        $("#dialog_autorization").trigger("reset");
        $( "#dialog_registration" ).dialog( "close" );
        $( "#dialog_autorization" ).dialog( "close" );
        location.reload();
      }
      else{
        alert(data[id]);
      }
    }
  });
    return false;
	});
});
