// JavaScript Document
function showtime(){
	"use strict";
	var oDt=new Date();
	var sTime="";
	if(oDt.getHours()<10){
		sTime+="0"+oDt.getHours()+":";
	}else{
		sTime+=oDt.getHours()+":";
	}
	if(oDt.getMinutes()<10){
		sTime+="0"+oDt.getMinutes()+":";
	}else{
		sTime+=oDt.getMinutes()+":";
	}
	if(oDt.getSeconds()<10){
		sTime+="0"+oDt.getSeconds();
	}else{
		sTime+=oDt.getSeconds();
	}
	document.getElementById("displaytime").innerHTML="<span>"+"&nbsp;&nbsp;"+sTime+"</span>";
}	
window.onload = function(){
	"use strict";
	var oDt=new Date();
	var sWd="";
	var iTimerid="";
	var iWeekDay=oDt.getDay();
	switch(iWeekDay){
		case 0:
			sWd="星期日";break;
		case 1:
			sWd="星期一";break;
		case 2:
			sWd="星期二";break;
		case 3:
			sWd="星期三";break;
		case 4:
			sWd="星期四";break;
		case 5:
			sWd="星期五";break;
		case 6:
			sWd="星期六";break;
	}
	var iMonth=parseInt(oDt.getMonth())+1;
	document.getElementById("displaydate").innerHTML="<span>"+oDt.getFullYear()+"年"+iMonth+"月"+oDt.getDate()+"日"+"&nbsp;"+sWd+"</span>";
	iTimerid = window.setInterval(showtime(),1000);
	
	if(document.getElementById("a1")!=null){
		document.getElementById("a1").onmouseover=function(){
			document.getElementById("advImage").src="images/b_ad1.jpg";
		}
	}
	if(document.getElementById("a2")!=null){
		document.getElementById("a2").onmouseover=function(){
			document.getElementById("advImage").src="images/b_ad2.jpg";
		}
	}
	if(document.getElementById("a3")!=null){
		document.getElementById("a3").onmouseover=function(){
			document.getElementById("advImage").src="images/b_ad3.jpg";
		}
	}
	if(document.getElementById("a4")!=null){
		document.getElementById("a4").onmouseover=function(){
			document.getElementById("advImage").src="images/b_ad4.jpg";
		}
	}
};
