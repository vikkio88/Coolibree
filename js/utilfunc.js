/**
 * Coolibre-javascript utils function
 * ********** by vikkio88 --> vikkio88.altervista.org
 * 					<vikkio88@yahoo.it>
 * 	a simple jQuery functions group to animate the pages
 * 		for this light Blog Engine
 * 
 * */

function commentadd(url){
	$.get(url,function(data){$('#commbox').html(data);$('#commbox').show("slow");}).css("z-index",100);
}

function closecommbar(){
	$('#commbox').html("");
	//$('#commbox').hide("slow");
}

function checkargs(url){
		var a = document.location.href;
		var b = a.split("#");
		b=b[1];
//		alert(b);
		if (b=="newcomment"){
			commentadd(url);
		}
}

function find(val){
		//alert(val);
		url="./search.php?key="+val;
		$.get(url,function(data){
					$.notifyBar({ html: data, close:true, delay:1000000});
				});
}
