var online= new Array();
var urlroot = "http://www.huicms.cn/";
var tOut = -1;
var drag = false;
var g_safeNode = null;
lastScrollY = 0;
var kfguin;
var ws;
var companyname;
var welcomeword;
var type;
var wpadomain;
var eid;

var Browser = {
	ie:/msie/.test(window.navigator.userAgent.toLowerCase()),
	moz:/gecko/.test(window.navigator.userAgent.toLowerCase()),
	opera:/opera/.test(window.navigator.userAgent.toLowerCase()),
	safari:/safari/.test(window.navigator.userAgent.toLowerCase())
};


if(kfguin)
{
	
  if(type==1 && kf_getCookie('hasshown')==0)
  {
  	  companyname = companyname.substr(0,15);	   	  
      welcomeword = kf_processWelcomeword(welcomeword);
  	  
  	  kfguin = kf_getSafeHTML(kfguin);
  	  companyname = kf_getSafeHTML(companyname);
  	  
  	  welcomeword = welcomeword.replace(/<br>/g,'\r\n');
  	  welcomeword = kf_getSafeHTML(welcomeword);
  	  welcomeword = welcomeword.replace(/\r/g, "").replace(/\n/g, "<BR>");
  
      window.setTimeout("kf_sleepShow()",200);
  }
  window.setTimeout("kf_moveWithScroll()",1);
}

function kf_getSafeHTML(s)
{
	var html = "";
	var safeNode = g_safeNode;
	if(!safeNode){
		safeNode = document.createElement("TEXTAREA");
	}
	if(safeNode){
		if(Browser.moz){
			safeNode.textContent = s;
		}
		else{
			safeNode.innerText = s;
		}
		html = safeNode.innerHTML;
		if(Browser.moz){
			safeNode.textContent = "";
		}
		else{
			safeNode.innerText = "";
		}
		g_safeNode = safeNode;
	}
	return html;
}

function kf_moveWithScroll() 
{ 
	 if(typeof window.pageYOffset != 'undefined') { 
        nowY = window.pageYOffset; 
     } 
     else if(typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') { 
        nowY = document.documentElement.scrollTop; 
     } 
     else if(typeof document.body != 'undefined') { 
        nowY = document.body.scrollTop; 
     }  

		percent = .1*(nowY - lastScrollY);
		if(percent > 0) 
		{
			percent=Math.ceil(percent);
		} 
		else
		{
			percent=Math.floor(percent);
		}

	 //document.getElementById("_Ten_rightDiv").style.top = parseInt(document.getElementById("_Ten_rightDiv").style.top) + percent+"px";
	 if(document.getElementById("kfpopupDiv"))
	 {
	 	document.getElementById("kfpopupDiv").style.top = parseInt(document.getElementById("kfpopupDiv").style.top) + percent+"px";
	 }
	 lastScrollY = lastScrollY + percent;
	 tOut = window.setTimeout("kf_moveWithScroll()",1);
}

function kf_hide() 
{
	if(tOut!=-1)
	{
		clearTimeout(tOut);   
		tOut=-1;
	}
	kf_setCookie('hasshown', 1, '', '/', wpadomain); 
}

function kf_hidekfpopup()
{
	if(tOut!=-1)
	{
		clearTimeout(tOut);   
		tOut=-1;
	}
	document.getElementById("kfpopupDiv").style.visibility = "hidden";
	document.getElementById("kfpopupDiv").style.display = "none";
	tOut=window.setTimeout("kf_moveWithScroll()",1);
	kf_setCookie('hasshown', 1, '', '/', wpadomain); 
}

function kf_getPopupDivHtml(kfguin,reference,companyname,welcomeword, wpadomain)
{
	var temp = '';
  	temp += '<span class="zixun0704_x"><a href="javascript:void(0);" onclick="kf_hidekfpopup();return false;"><!--关闭--></a></span>';
  	temp += '<img src="'+urlroot+'web/pic_zixun0704_nv.jpg" class="zixun0704_img" />';
  	temp += '<p class="zixun0704_font">'+welcomeword+'</p>';
  	temp += '<div class="zixun0704_button"><a href="javascript:void(0);" onclick="kf_openChatWindow(1,\'b\',\''+kfguin+'\')"><img src="'+urlroot+'web/pic_zixun0704QQ.jpg" /></a>&nbsp;<a href="javascript:void(0);" onclick="kf_hidekfpopup();return false;"><img src="'+urlroot+'web/pic_zixun0704_later.jpg" /></a></div>';
	
    return temp;
}

function kf_openChatWindow(flag, wpadomain, kfguin)
{
	window.open('http://b.qq.com/webc.htm?new=0&sid='+kfguin+'&eid='+eid+'&o=&q=7', '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');
	if(flag==1)
	{
		kf_hidekfpopup();
	}
	return false;
}

function kf_validateWelcomeword(word)
{
	var count = 0;
	
	for(var i=0;i<word.length;i++)
	{
		if(word.charAt(i)=='\n')
		{
			count++;
		}
		if(count>2)
		{
				return 2;
		}
	}
	if(word.length > 57+2*count)
	{
		return 1;
	}
	
	count = 0;
  var temp = word.indexOf('\n');
  while(temp!=-1)
  {
  	word = word.substr(temp+1); 
  	if(temp-1<=19) 
  	{
  		count += 19;
  	}
  	else if(temp-1<=38)
  	{
  		count += 38;
  	}
  	else if(temp-1<=57)
  	{
  		count += 57;
  	}
  	
  	temp = word.indexOf('\n');
  }
  count+=word.length;	
  if(count>57)
  {
  	return 3;
  }
  
  return 0;
}

function kf_processWelcomeword(word)
{
	word = word.substr(0,57+10);
	var result = '';
	var count = 0;	
	var temp = word.indexOf('<br>');
	
  while(count<57 && temp!=-1)
  {

  	if(temp<=19) 
  	{
  		count += 19;
  		if(count<=57)
  		{
  		   result += word.substr(0,temp+5);
  	  }
  	  else
  	  {
  	  	 result += word.substr(0,57-count>word.length?word.length:57-count);
  	  }
  	}
  	else if(temp<=38)
  	{
  		count += 38;
  		if(count<=57)
  		{
  		   result += word.substr(0,temp+5);
  	  }
  	  else
  	  {
  	  	 result += word.substr(0,57-count>word.length?word.length:57-count);
  	  }
  	}
  	else if(temp<=57)
  	{
  		count += 57;
  		if(count<=57)
  		{
  		   result += word.substr(0,temp+5);
  	  }
  	  else
  	  {
  	  	 result += word.substr(0,57-count>word.length?word.length:57-count);
  	  }
  	}
  	
  	word = word.substr(temp+5); 
  	temp = word.indexOf('<br>');
  }
  
  if(count<57)
  {
      result += word.substr(0,57-count>word.length?word.length:57-count);
  }
  
  return result;
}

function kf_setCookie(name, value, exp, path, domain)
{
	var nv = name + "=" + escape(value) + ";";

	var d = null;
	if(typeof(exp) == "object")
	{
		d = exp;
	}
	else if(typeof(exp) == "number")
	{
		d = new Date();
		d = new Date(d.getFullYear(), d.getMonth(), d.getDate(), d.getHours(), d.getMinutes() + exp, d.getSeconds(), d.getMilliseconds());
	}
	
	if(d)
	{
		nv += "expires=" + d.toGMTString() + ";";
	}
	
	if(!path)
	{
		nv += "path=/;";
	}
	else if(typeof(path) == "string" && path != "")
	{
		nv += "path=" + path + ";";
	}

	if(!domain && typeof(VS_COOKIEDM) != "undefined")
	{
		domain = VS_COOKIEDM;
	}
	
	if(typeof(domain) == "string" && domain != "")
	{
		nv += "domain=" + domain + ";";
	}

	document.cookie = nv;
}

function kf_getCookie(name)
{
	var value = "";
	var cookies = document.cookie.split("; ");
	var nv;
	var i;

	for(i = 0; i < cookies.length; i++)
	{
		nv = cookies[i].split("=");

		if(nv && nv.length >= 2 && name == kf_rTrim(kf_lTrim(nv[0])))
		{
			value = unescape(nv[1]);
		}
	}

	return value;
} 

function kf_sleepShow()   
{   
	kf_setCookie('hasshown', 0, '', '/', wpadomain); 
	var position_1 = (document.documentElement.clientWidth-381)/2+document.body.scrollLeft;
	var position_2 = (document.documentElement.clientHeight-159)/2+document.body.scrollTop; 
	popupDivHtml = '<div class="zixun0704" id="kfpopupDiv" onmousedown="MyMove.Move(\'kfpopupDiv\',event,1);"  style="z-index:10000; position: absolute; top: '+position_2+'px; left: '+position_1+'px;color:#000;font-size: 12px;cursor:move;height: 159px;width: 381px;">';
  	popupDivHtml += kf_getPopupDivHtml(kfguin,ws,companyname,welcomeword, wpadomain);
  	popupDivHtml += '</div>';
	if(document.body.insertAdjacentHTML)
	{
  		document.body.insertAdjacentHTML("beforeEnd",popupDivHtml);
	}
	else
	{
		$("#footer").before(popupDivHtml);
	}
} 

function kf_dealErrors() 
{
	kf_hide();
	return true;
}

function kf_lTrim(str)
{
  while (str.charAt(0) == " ")
  {
    str = str.slice(1);
  }
  return str;
}

function kf_rTrim(str)
{
  var iLength = str.length;
  while (str.charAt(iLength - 1) == " ")
  {
    str = str.slice(0, iLength - 1);
	iLength--;
  }
  return str;
}

window.onerror = kf_dealErrors;
var MyMove = new Tong_MoveDiv();   

function Tong_MoveDiv()
{ 
 	  this.Move=function(Id,Evt,T) 
 	  {    
 	  	if(Id == "") 
		{
			return;
		} 
 	  	var o = document.getElementById(Id);    
 	  	if(!o) 
		{
			return;
		}    
 	    evt = Evt ? Evt : window.event;    
 	    o.style.position = "absolute";    
 	    o.style.zIndex = 9999;    
 	    var obj = evt.srcElement ? evt.srcElement : evt.target;   
 	    var w = o.offsetWidth;      
 	    var h = o.offsetHeight;      
 	    var l = o.offsetLeft;      
 	    var t = o.offsetTop;  
 	    var div = document.createElement("DIV");  
 	    document.body.appendChild(div);   
 	    div.style.cssText = "filter:alpha(Opacity=10,style=0);opacity:0.2;width:"+w+"px;height:"+h+"px;top:"+t+"px;left:"+l+"px;position:absolute;background:#000";      
 	    div.setAttribute("id", Id +"temp");    
 	    this.Move_OnlyMove(Id,evt,T); 
 	}  
 	
 	this.Move_OnlyMove = function(Id,Evt,T) 
 	{    
 		  var o = document.getElementById(Id+"temp");    
 		  if(!o)
		  {
			return;
		  }   
 		  evt = Evt?Evt:window.event; 
 		  var relLeft = evt.clientX - o.offsetLeft;
 		  var relTop = evt.clientY - o.offsetTop;    
 		  if(!window.captureEvents)    
 		  {      
 		  	 o.setCapture();           
 		  }   
 		  else   
 		  {     
 		  	 window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);      
 		  }       
 		  			  
	      document.onmousemove = function(e)
	      {
	            if(!o)
	            {
	                return;
	            }
	            e = e ? e : window.event;
	
	        	var bh = Math.max(document.body.scrollHeight,document.body.clientHeight,document.body.offsetHeight,
	        						document.documentElement.scrollHeight,document.documentElement.clientHeight,document.documentElement.offsetHeight);
	        	var bw = Math.max(document.body.scrollWidth,document.body.clientWidth,document.body.offsetWidth,
	        						document.documentElement.scrollWidth,document.documentElement.clientWidth,document.documentElement.offsetWidth);
	        	var sbw = 0;
	        	if(document.body.scrollWidth < bw)
	        		sbw = document.body.scrollWidth;
	        	if(document.body.clientWidth < bw && sbw < document.body.clientWidth)
	        		sbw = document.body.clientWidth;
	        	if(document.body.offsetWidth < bw && sbw < document.body.offsetWidth)
	        		sbw = document.body.offsetWidth;
	        	if(document.documentElement.scrollWidth < bw && sbw < document.documentElement.scrollWidth)
	        		sbw = document.documentElement.scrollWidth;
	        	if(document.documentElement.clientWidth < bw && sbw < document.documentElement.clientWidth)
	        		sbw = document.documentElement.clientWidth;
	        	if(document.documentElement.offsetWidth < bw && sbw < document.documentElement.offsetWidth)
	        		sbw = document.documentElement.offsetWidth;
	             
	            if(e.clientX - relLeft <= 0)
	            {
	                o.style.left = 0 +"px";
	            }
	            else if(e.clientX - relLeft >= bw - o.offsetWidth - 2)
	            {
	                o.style.left = (sbw - o.offsetWidth - 2) +"px";
	            }
	            else
	            {
	                o.style.left = e.clientX - relLeft +"px";
	            }
	            if(e.clientY - relTop <= 1)
	            {
	                o.style.top = 1 +"px";
	            }
	            else if(e.clientY - relTop >= bh - o.offsetHeight - 30)
	            {
	                o.style.top = (bh - o.offsetHeight) +"px";
	            }
	            else
	            {
	                o.style.top = e.clientY - relTop +"px";
	            }
	      }
 		   
 		  document.onmouseup = function()      
 		  {       
 		   	   if(!o) return;       
 		   	   	
 		   	   if(!window.captureEvents) 
			   {
			   	  o.releaseCapture();  
			   }         		   	   	      
 		   	   else  
			   {
			   	  window.releaseEvents(Event.MOUSEMOVE|Event.MOUSEUP); 
			   }     
 		   	   	        
 		   	   var o1 = document.getElementById(Id);       
 		   	   if(!o1) 
			   {
			      return; 
			   }        		   	   	
 		   	   var l0 = o.offsetLeft;       
 		   	   var t0 = o.offsetTop;       
 		   	   var l = o1.offsetLeft;       
 		   	   var t = o1.offsetTop;   
 		   	   
 		   	   //alert(l0 + " " +  t0 +" "+ l +" "+t);     
 		   	   
 		   	   MyMove.Move_e(Id, l0 , t0, l, t,T);       
 		   	   document.body.removeChild(o);       
 		   	   o = null;      
 		}  
 	}  
 	
 	
 	this.Move_e = function(Id, l0 , t0, l, t,T)     
 	{      
 		    if(typeof(window["ct"+ Id]) != "undefined") 
			{
				  clearTimeout(window["ct"+ Id]);   
			}
 		    
 		    var o = document.getElementById(Id);      
 		    if(!o) return;      
 		    var sl = st = 8;      
 		    var s_l = Math.abs(l0 - l);      
 		    var s_t = Math.abs(t0 - t);      
 		    if(s_l - s_t > 0)  
			{
				if(s_t) 
				{
					sl = Math.round(s_l / s_t) > 8 ? 8 : Math.round(s_l / s_t) * 6; 
				}       
 		    		      
 		        else
				{
					sl = 0; 
				}            		      
			}        		    	   
 		    else
			{
				if(s_l)
				{
					st = Math.round(s_t / s_l) > 8 ? 8 : Math.round(s_t / s_l) * 6;   
				}          		    		    
 		        else  
			    {
			  	    st = 0;
			    }       		      	  
			}       
 		    	       		      	
 		    if(l0 - l < 0) 
			{
				sl *= -1; 
			}  		    	     
 		    if(t0 - t < 0) 
			{
				st *= -1; 
			}   		    	     
 		    if(Math.abs(l + sl - l0) < 52 && sl) 
			{
 		    	sl = sl > 0 ? 2 : -2; 					
			}    
 		    if(Math.abs(t + st - t0) < 52 && st) 
			{
	        	st = st > 0 ? 2 : -2;  					
			}      
 		    if(Math.abs(l + sl - l0) < 16 && sl) 
			{
 		    	sl = sl > 0 ? 1 : -1;  					
			}   
 		    if(Math.abs(t + st - t0) < 16 && st) 
			{
 		    	st = st > 0 ? 1 : -1;    					
			} 
 		    if(s_l == 0 && s_t == 0)
			{
     		    return;   				
			} 
 		    if(T)      
 		    {    
 		    	o.style.left = l0 +"px";    
 		    	o.style.top = t0 +"px";    
 		    	return;      
 		    }      
 		    else      
 		    {    
 		    	if(Math.abs(l + sl - l0) < 2) 
				{
					o.style.left = l0 +"px";  
				}       		    		 
 		    	else     
				{
					o.style.left = l + sl +"px";   
				}   		    	 
 		    	if(Math.abs(t + st - t0) < 2) 
				{
					o.style.top = t0 +"px";   
				}        		    		 
 		    	else    
				{
					o.style.top = t + st +"px";   
				}
 		    		         		    	
 		    	window["ct"+ Id] = window.setTimeout("MyMove.Move_e('"+ Id +"', "+ l0 +" , "+ t0 +", "+ (l + sl) +", "+ (t + st) +","+T+")", 1);      
 		    }     
 		}   
} 