/**
 * Coolibre-Adminpanel utils
 * ********** by vikkio88 --> vikkio88.altervista.org
 * 					<vikkio88@yahoo.it>
 * 	a simple jQuery function group to animate the adminpanel
 * 		for this light Blog Engine
 * 
 * */

function load(){
		$('#target').hide();
		$('#passw').hide();
		$('#notification').hide();
		//$.notifyBar({ html: "This is 'Notify bar'!" });
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function insert(text){
	//a function that insert into id post some text passed as argoument
	$("#post").val(($("#post").val())+" "+text).focus();
}


function new_post(){
	//alert(value);
	/*if(value=="New Post"){
		$("#np").val("Close");*/
		url='./forms/newpost.txt';
		$.get(url,function(data){$('#target').html(data);});
		$('#target').show();
	/*else{
		$("#np").val("New Post");
		$('#target').hide("fast",function(){$('#target').html("");});
	}*/
}

function closetarget(){
	$('#target').hide("fast",function(){$('#target').html("");});
}

function closenotification(){
	$('#notification2').css("overflow","hidden").hide("fast",function(){$('#notification2').html("");});
}

function reqpasspost(action){
//		var top= ((($(window).height()/ 2)+($(window).scrollTop())) + "px");
//		var left=((($(window).width()/ 2)+($(window).scrollLeft())) + "px");
		url='./forms/passwdreq.txt';
		//action=todo='makepost';
		complete='<input type="button" onclick="'+action+'($(\'#pass\').val())" value="Send"/></form>';
		$.get(url,function(data){
					$.notifyBar({ html: data+complete, close:true, delay:1000000});
					$('#pass').focus();
				});
		
}
function makepost(passw){
	$('.notify-bar-close').click();
	//alert("neo sono dentro");
	tit=$('#title').val();
	post=$('#post').val();
	us=$('#user').html();
	//passw=$('#passw').html();
	url='../postman/poster.php';
	//alert(passw);
	$.post(url, { user: us, pass: passw, title: tit, message: post},
   function(data){
      $("#target").hide("slow",function(){$("#target").html("");$.notifyBar({ cls: "success", html: data});})
   });
	
}

function edit_post(){
		url='./forms/editpost.txt';
		$.get(url,function(data){$('#target').html(data);});
		$('#target').show();
}

function del_post(){
		url='./forms/delpost.txt';
		$.get(url,function(data){$('#target').html(data);});
		$('#target').show();
}

function drophtml(id){
		//alert(id);
		url='../postman/dropPost.php?pos='+id;
		$.get(url,function(data){
					$("#post").val(data);
					$.get("../postman/pos2id.php?pos="+id,function(data){$('#id2').html(data);});
					closenotification();
//					$('#notification').html('Selected id: <span id="idval">'+id+'</span>').show();
			});
}

function printpostlist(){
				url='../postman/listPosts.php';
		$.get(url,function(data){
			//$.notifyBar({ html: data, close:true, delay:1000000});
			hidebtn='<p style="float: left;font-size:0.8em"><a href="#" onclick="closenotification()">[X]</a></p><br /><h3>Here is the post list</h3>';
			$('#notification2').html(hidebtn+data).show().css("height","300px").css("overflow","auto").css("background","#F5F5F5");
		});
}

function makeeditpost(passw){
	$('.notify-bar-close').click();
	postv=$('#post').val();
	us=$('#user').html();
	idval=$('#id2').html();
	
	//passw=$('#passw').html();
	url='../postman/chompBody.php';
	//alert(idval);
	$.post(url, { user: us, pass: passw, body: postv, id: idval},
   function(data){
	  closenotification();
      $("#target").hide("slow",function(){$("#target").html("");$.notifyBar({ cls: "success", html: data});})
   });
}

function makedelpost(passw){
	$('.notify-bar-close').click();
	postv=$('#post').val();
	us=$('#user').html();
	idval=$('#id').val();
	//passw=$('#passw').html();
	url='../postman/delPost.php';
	//alert(passw);
	$.post(url, { user: us, pass: passw, body: postv, pos: idval},
   function(data){
	  closenotification();
      $("#target").hide("slow",function(){$("#target").html("");$.notifyBar({ cls: "success", html: data});})
   });	
}

function logout(){
		user=$('#user').html();
		$.notifyBar({ html: "Goodbye "+user+" !" });
		setTimeout('location.href="../index.php"', 3000);
}

function view_logs(passw){
	//alert(passw);
	if(passw=="")
		reqpasspost('view_logs');
	else{
		$('.notify-bar-close').click();
		us=$('#user').html();
		url="../include/logviewer.php";
		closebtn='<div style="margin: auto; border: 2px solid #000; width: 650px; padding: 8px;"><p style="float: right;font-size:0.8em"><a href="#" onclick="closetarget()">[X]</a></p><h3>Error Log viewer</h3>';
		endiv='</div>';
		$.post(url,{ user: us, pass: passw},function(data){
												data=ReplaceAll(data,"|*|","<br /><br />");
												$('#target').html(closebtn+data+endiv).show();
											});
	}
}

function ReplaceAll(Source,stringToFind,stringToReplace){
  var temp = Source;
    var index = temp.indexOf(stringToFind);
        while(index != -1){
            temp = temp.replace(stringToFind,stringToReplace);
            index = temp.indexOf(stringToFind);
        }
        return temp;
}

function edit_template(){
		url='./forms/edittemplate.txt';
		$.get(url,function(data){$('#target').html(data);});
		url='../template/style.css';
		$.get(url,function(data){$('#css').val(data);})
		url='../template/header.txt';
		$.get(url,function(data){$('#header').val(data);})
		url='../template/bar.txt';
		$.get(url,function(data){$('#bar').val(data);})
		url='../template/footer.txt';
		$.get(url,function(data){$('#footer').val(data);})
		$('#target').show();
}

function makeedittemp(passw){
		$('.notify-bar-close').click();
		//alert("ci arrivo");
		us=$('#user').html();
		css=$('#css').val();
		head=$('#header').val();
		navibar=$('#bar').val();
		foot=$('#footer').val();
		
		url='../template/modify.php';
		$.post(url,{user: us, pass: passw, style: css, bar: navibar, header: head, footer: foot},function(data){
							$("#target").hide("slow",function(){$("#target").html("");$.notifyBar({ cls: "success", html: data});});
						}
		);
}

function refresh(id){
		if (id!="css"){
			url='../template/'+id+'.txt';
			$.get(url,function(data){$('#'+id+'').val(data).focus();});
		}else{
			url='../template/style.css';
			$.get(url,function(data){$('#css').val(data).focus();});
		}

}
