//Our home made library

window.ajax = new Object();
ajax.request = function (x, y) {
var param = y.parameters;
if(y.method != 'undefined'){if(y.method == 'post'){var method = 'POST';}else if(y.method == 'get'){var method = 'GET';}else{var method = y.method;}}else{var method ='GET';}
if(method == 'GET'){x = x + "?" + param;}

if(y.sync != 'undefined'){var sync=y.sync;}else{var sync="true";}
var c;
if (window.XMLHttpRequest){c=new XMLHttpRequest();}
else{c=new ActiveXObject("Microsoft.XMLHTTP");}
c.open(method, x , "true");
if(typeof y.contentType == 'undefined'){c.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
}else{if(y.contentType == false){}else if(y.contentType==true){c.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");}else{c.setRequestHeader("Content-Type", y.contentType);}
}
c.send(param);

c.onreadystatechange=function(){
  if (c.readyState==4 && (c.status==200 || c.status==404)){
      if(y.onSuccess=='undefined' || y.onSuccess==null){}else{new y.onSuccess(c.responseText);}}
    else if(c.readyState==2 && (c.status==200 || c.status==404)){try{new y.onCreate;}catch(e){}}}};

ajax.pulseFx=function(i,u,a){var Fx=new ajax.request(u,{method:a.method,parameters:a.parameters,onSuccess:function(r){new a.onSuccess(r);new ajax.updater(i,r,a.insertion);}});window['ex'+i]= setInterval(Fx,a.frequency*1000);}
ajax.updater=function(i,r,type){
    if(type==='top'){x(i).insertBefore(document.createTextNode(r),x(i).firstChild);}
    else if(type==='bottom'){x(i).appendChild(document.createTextNode(r));}
    else{x(i).innerHTML=r;}
}
ajax.stopPulseFx=function(i){clearInterval(window['ex'+i]);}

function x(x){var elements = new Array();

	for (var i = 0; i < arguments.length; i++) {

		var element = arguments[i];

		if (typeof element == 'string')

			element = document.getElementById(element);

		if (arguments.length == 1)

			return element;

		elements.push(element);

	}

	return elements;
}
function hidee(x){document.getElementById(x).style.display='none';}
function showw(x){document.getElementById(x).style.display='inline-block';}
function showwb(x){document.getElementById(x).style.display='block';}
