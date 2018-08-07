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

$(document).ready(function() { //sending data from register form
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
    return false;
	});
});
function get_cookie ( cookie_name )//checking cookie
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

function delete_cookie ( cookie_name )//deleting cookie
{
  var cookie_date = new Date ( );
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}

$('#MyButton').hide();//hiding botoom

$(document).ready(function()
{
  if(get_cookie("login")!=null){
    $('#MyButton').show();
    $( "#dialog" ).dialog( "close" );
    $( "#dialog1" ).dialog( "close" );
    document.getElementById('text').innerHTML = "hello  "+get_cookie("login");
  }
});

var button = document.querySelector("#MyButton");
  button.addEventListener("click", function() {
    delete_cookie("login");
    location.reload();
  });

$(document).ready(function() {//sending data from autorization form
	$("#second").bind("click",function() {
    $.post("autorization.php",{login:$("#login1").val(),
    password:$("#password1").val(),
  },function(data)
  {
    data = JSON.parse(data);
    for(var id in data)
    {
      if(data[id]=="ohyenno"){
        $("#dialog1").trigger("reset");
        $( "#dialog" ).dialog( "close" );
        $( "#dialog1" ).dialog( "close" );
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
