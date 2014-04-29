/*****************************************
 *                                       *
 *  Validations                          *
 *                                       *
 *****************************************/

function isInteger(n) {
  return !isNaN(parseInt(n)) && isFinite(n);
}

function isText(inputContents){
	for(var i=0; i<inputContents.length; i++) {
		var char1 = inputContents.charAt(i);
		var cc = char1.charCodeAt(0);

		if((cc>64 && cc<91) || (cc>96 && cc<123)) {

		} else {
			return false;
		}
	}
	return true;
}

/******************************
 *                            *
 *  Cookie functions          *
 *                            *
 ******************************/

function setCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {

    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start !== -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end === -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
function yrasyta()
{
    alert('Jus sekmingai uzsiregistravote');
}