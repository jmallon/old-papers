/* BUBBLE TOOLTIP */

function enableTooltip(id) {
	var links,i,h;
	if(!document.getElementById || !document.getElementsByTagName) return;
	h=document.createElement("span");
	h.id="btc";
	h.setAttribute("id","btc");
	h.style.position="absolute";
	document.getElementsByTagName("body")[0].appendChild(h);
	if(id==null) {
		links=document.getElementsByTagName("a");
	} else { 
		links=document.getElementById(id).getElementsByTagName("a");
	}
	for(i=0;i<links.length;i++) {
		prepareTooltip(links[i]);
    }
}

function prepareTooltip(el) {
	var tooltip,t,b,s;
	t=el.getAttribute("title");
	if(t==null || t.length==0) return;
	el.removeAttribute("title");
	tooltip=CreateEl("span","tooltip");
	s=CreateEl("span","bbltop");
	s.appendChild(document.createTextNode(t));
	tooltip.appendChild(s);
	b=CreateEl("b","bblbottom");
	tooltip.appendChild(b);
	setOpacity(tooltip);
	el.tooltip=tooltip;
	el.onmouseover=showTooltip;
	el.onmouseout=hideTooltip;
	el.onmousemove=Locate;
}

function showTooltip(e) {
	document.getElementById('btc').appendChild(this.tooltip);
	Locate(e);
}

function hideTooltip(e) {
	var d=document.getElementById('btc');
	if(d.childNodes.length>0) d.removeChild(d.firstChild);
}

function setOpacity(el) {
	el.style.filter="alpha(opacity:95)";
	el.style.KHTMLOpacity="0.95";
	el.style.MozOpacity="0.95";
	el.style.opacity="0.95";
}

function CreateEl(t,c) {
	var x=document.createElement(t);
	x.className=c;
	x.style.display="block";
	return(x);
}

function Locate(e){
	var posx=0,posy=0;
	if(e==null) e=window.event;
	if(e.pageX || e.pageY) {
		posx=e.pageX; posy=e.pageY;
    } else if(e.clientX || e.clientY) {
		if(document.documentElement.scrollTop) {
			posx=e.clientX+document.documentElement.scrollLeft;
			posy=e.clientY+document.documentElement.scrollTop;
        } else {
			posx=e.clientX+document.body.scrollLeft;
			posy=e.clientY+document.body.scrollTop;
		}
    }
	document.getElementById("btc").style.top=(posy+10)+"px";
	document.getElementById("btc").style.left=(posx-20)+"px";
}