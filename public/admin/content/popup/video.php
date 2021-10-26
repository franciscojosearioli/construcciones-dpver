<style>
.cookieConsentContainer {
	z-index: 999;
	width: 350px;
	min-height: 20px;
	box-sizing: border-box;
	padding: 30px 20px 30px 30px;
	/*background: #232323;*/
	overflow: hidden;
	position: fixed;
    top: 10%;
	right: 0px;
	display: none;
}
.cookieConsentContainer .cookieTitle a {
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	background:#28292d;
	margin-bottom: -10px;
	font-size: 16px;
	border-radius: 6px 6px 0px 0px;
	padding:10px;
	display: block;
}
.cookieConsentContainer .cookieTitle a:hover {
color:#fff;
}
.cookieConsentContainer .cookieDesc p {
	margin: 0;
	padding: 0;
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	font-size: 13px;
	line-height: 20px;
	display: block;
	margin-top: 10px;
} .cookieConsentContainer .cookieDesc a {
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	text-decoration: underline;
	display:none;
}
.cookieConsentContainer .cookieButton a {
	display: inline-block;
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
	margin-top: 14px;
	background: #28292d;
	box-sizing: border-box; 
	padding: 15px 24px;
	text-align: center;
	transition: background 0.3s;
}
.cookieConsentContainer .cookieButton a:hover { 
	cursor: pointer;
	color:#fff;
	background: #1e88e5;
}

@media (max-width: 980px) {
	.cookieConsentContainer {
		bottom: 0px !important;
		left: 0px !important;
		width: 100%  !important;
	}
}
</style>
<script>
// --- Config --- //
var purecookieTitle = "Protocolo COVID-19"; // Title
var purecookieDesc = "<video style='border:6px solid #28292d;border-radius: 0px 0px 6px 6px;' src='../covid19/protocolo.mp4' width='100%' controls=''></video>"; // Description
var purecookieLink = '<a href="cookie-policy.html" target="_blank">What for?</a>'; // Cookiepolicy link
var purecookieButton = "Estoy informado"; // Button text
// ---        --- //


function pureFadeIn(elem, display){
  var el = document.getElementById(elem);
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .02) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
};
function pureFadeOut(elem){
  var el = document.getElementById(elem);
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .02) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
};

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

function cookieConsent() {
  if (!getCookie('purecookieDismiss')) {
    document.body.innerHTML += '<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="text-center cookieTitle"><a>' + purecookieTitle + '</a></div><div class="cookieDesc"><p>' + purecookieDesc + ' ' + purecookieLink + '</p></div><div class="pull-right cookieButton"><a onClick="purecookieDismiss();">' + purecookieButton + '</a></div></div>';
	pureFadeIn("cookieConsentContainer");
  }
}

function purecookieDismiss() {
  setCookie('purecookieDismiss','1',7);
  pureFadeOut("cookieConsentContainer");
}

window.onload = function() { cookieConsent(); };
</script>
