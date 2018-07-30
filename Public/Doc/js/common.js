window.onload = function() {
	var cooki = document.cookie;

	function removeCookie(key) {
	    setCookie(key, '', -1);
	}

	function getCookie(key) {
	    var cookieArr = document.cookie.split('; ');
	    for(var i = 0; i < cookieArr.length; i++) {
	        var arr = cookieArr[i].split('=');
	        if(arr[0] === key) {
	            return arr[1];
	        }
	    }
	    return false;
	}


	/*if(!getCookie('isLogin')) {
		window.location.href = "http://localhost/ProjectDelivery/index.php";
	}*/
}