// JavaScript Document
// Removes leading whitespaces
function LTriming( value ) {
	
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
}

// Removes ending whitespaces
function RTriming( value ) {
	
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
	
}

// Removes leading and ending whitespaces
function triming( value ) {
	
	return LTriming(RTriming(value));
	
}

function isvalidemail(value) {
	var emailexpr=/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
	return emailexpr.test(value);
}
function isvalidimgfile(value) {
	var fileexpr=/^.*(\.(gif|jpg|jpeg|GIF|JPG|JPEG))$/;
	return fileexpr.test(value);
}
function isvalidvideofile(value) {
	var fileexpr=/^.*(\.(avi|dat|mgp|mpeg|flv|wmv|AVI|DAT|MPG|MPEG|FLV|WMV))$/;
	return fileexpr.test(value);
}

//USE: onKeyPress="JavaScript: return keyRestrict(event,'0123456789');"
function keyRestrict(e, validchars) { 
	var key='', keychar='';
	key = getKeyCode(e);
	if (key == null) return true;
	keychar = String.fromCharCode(key);
	keychar = keychar.toLowerCase();
	validchars = validchars.toLowerCase();
	if (validchars.indexOf(keychar) != -1)
	  return true;
	if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
	  return true;
	return false;
}
function getKeyCode(e) {
	if (window.event)
	return window.event.keyCode;
	else if (e)
	return e.which;
	else
	return null;
}
function url_check(url)
{
	var urlRegxp = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([\w]+)(.[\w]+){1,2}$/;
	return urlRegxp.test(url);
}
function isProper(string)
{
	if (!string)
		return false;
	var iChars = "*|,\":<>[]{}`\';()@&$#% ";
	for (var i = 0; i < string.length; i++)
	{
		if (iChars.indexOf(string.charAt(i)) != -1)
			return false;
	}
	return true;
}
function $I(id)
{
	return document.getElementById(id);
}
function $V(id)
{
	return $I(id).value;
}
function AddToOptionList(OptionList, OptionValue, OptionText)
{
	// Add option to the bottom of the list
	OptionList[OptionList.length] = new Option(OptionText, OptionValue);
}
function ClearOptions(OptionList)
{
	// Always clear an option list from the last entry to the first
	for (x=OptionList.length; x >= 0; x--)
	{
		OptionList[x] = null;
	}
}
function selcheckbox(initial,num)
{
	var check="";
	var id;
	for(var i=0;i<num;i++)
	{
		id=initial+i;
		if($I(id).checked)
			check+=$I(id).value+",";
	}
	return rtrim(check,",");
}
function numselcheckbox(initial,num)
{
	var count=0;
	var id;
	for(var i=0;i<num;i++)
	{
		id=initial+i;
		if($I(id).checked)
			count++;
	}
	return count;
}
function ltrim(str,char)
{
	if(str.length>0)
	{
		while(str.substring(0,1)==char)
			str=str.substring(1,str.length);
	}
	return str;
}
function rtrim(str,char)
{
	if(str.length>0)
	{
		while(str.substring(str.length-1,str.length)==char)
			str=str.substring(0,str.length-1);
	}
	return str;
}
function trim(str,char)
{
	return rtrim(ltrim(str,char),char);
}
function isValidImageFile(image)
{
	var ext=image.substring(image.length-4,image.length);
	var allowed=Array(".jpg",".gif",".png");
	for(var i=0;i<allowed.length;i++)
	{
		if(ext.toLowerCase()==allowed[i])
			break;
	}
	if(i==allowed.length)
		return false;
	else
		return true;
}
function num2round(num,dec)
{
	var n=num.toString();
	var pos=n.indexOf(".");
	if(pos==-1)
	{
		var decval="";
		for(var i=0;i<dec;i++)
			decval+="0";
		return num+"."+decval;
	}
	else
	{
		var decval=n.substring(pos+1);
		for(var i=decval.length;i<dec;i++)
			decval+="0";
		return n.substring(0,pos)+"."+decval.substring(0,dec);
	}
}
function checkAll(status,prechk,num)
{
	for(var i=0;i<num;i++)
		$I(prechk+i).checked=status;
}
function chkAllStat(allchk,prechk,num,atleast)
{
	if(num>atleast)
	{
		if(numselcheckbox(prechk,num)==num)
			$I(allchk).checked=true;
		else
			$I(allchk).checked=false;
	}
}