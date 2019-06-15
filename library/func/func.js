function SignUp_check() {
	var form = document.forms["SignUpForm"];
	var warning = "!!!===注意===!!!";
	var pass = true;
	if(form["account"].value.length < 6 || form["account"].value.length > 20){
		pass = false;
		warning += "\n帳號必須由6~20個字元組成。";
	}
	else if(form["account"].value.indexOf(" ") >= 0){
		pass = false;
		warning += "\n帳號不能包含空白字元。";
	}
	if(form["password"].value.length < 6 || form["password"].value.length > 20){
		pass = false;
		warning += "\n密碼必須由6~20個字元組成。";
	}
	else if(form["password"].value.indexOf(" ") >= 0){
		pass = false;
		warning += "\n密碼不能包含空白字元。";
	}
	else if(form["password"].value != form["repassword"].value){
		pass = false;
		warning += "\n兩次密碼輸入不同";
	}
	if(form["name"].value.length == 0){
		pass = false;
		warning += "\n請輸入暱稱";
	}
	else if(form["name"].value.length > 20){
		pass = false;
		warning += "\n暱稱太長(1~20字元)";
	}
	if(pass){
		form.submit();
	}
	else{
		alert(warning);
	}
}

function Login_check() {
	var form = document.forms["LoginForm"];
	var warning = "!!!===注意===!!!";
	var pass = true;
	if(form["account"].value.length < 6 || form["account"].value.length > 20){
		pass = false;
		warning += "\n帳號由6~20個字元組成。";
	}
	if(form["account"].value.indexOf(" ") >= 0){
		pass = false;
		warning += "\n帳號不包含空白字元。";
	}
	if(form["password"].value.length < 6 || form["password"].value.length > 20){
		pass = false;
		warning += "\n密碼由6~20個字元組成。";
	}
	if(form["password"].value.indexOf(" ") >= 0){
		pass = false;
		warning += "\n密碼不包含空白字元。";
	}
	if(pass){
		form.submit();
	}
	else{
		alert(warning);
	}
}

function unfade(element) {
	var op = 0.001;  // initial opacity
	var timer = setInterval(function () {
		if (op >= 1){
			clearInterval(timer);
		}
		element.style.opacity = op;
		element.style.filter = 'alpha(opacity=' + op * 100 + ")";
		op += op * 0.1;
	}, 10);
}

function textbox_check(formname,inputname) {
	var form = document.forms[formname];
	var warning = "!!!===注意===!!!";
	var pass = true;
	try{
		if(form[inputname].value.length < 6 || form[inputname].value.length > 20) {
		pass = false;
		warning += "\n帳號由6~20個字元組成。";
	}
	else if(form[inputname].value.indexOf(" ") >= 0){
		pass = false;
		warning += "\n帳號不包含空白字元。";
	}
	} catch {
		pass = false;
		warning += "\n請輸入帳號";
	}
	
	if(pass){
		form.submit();
	}
	else{
		alert(warning);
	}
}

function pay_check() {
	var money = parseInt(document.getElementById('money').innerHTML,10);
	var tb = parseFloat(document.forms["PayForm"]["pay_dollar"].value);
	if(!Number.isInteger(tb) || tb<1){
		alert("請輸入正整數。");
	}
	else if (money<tb){
		alert("您的帳戶餘額不夠支付該次匯款，若您的帳戶餘額已經有所變動，請重新整理網頁。");
	}
	else{
		var pass = confirm("確認此次交易內容了嗎？")
		if(pass){
			document.forms["PayForm"].submit();
		}
	}
}

function changeMark(id,text) {
	var el = document.getElementById(id);
	el.innerHTML = text;
}