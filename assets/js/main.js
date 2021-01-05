console.log('merge');

//$(document).ready(function(){});  this can be replace with 

document.addEventListener('DOMContentLoaded', function(){

	document.getElementById('click_change_login').addEventListener('click',function(){
		document.getElementById('register_part').style.display = 'none';
		document.getElementById('login_part').style.display = 'flex';

		document.getElementById('click_change_register').classList.add("show");
		document.getElementById('click_change_login').classList.remove("show");

		document.getElementById('click_change_login').classList.add("not_show");
		document.getElementById('click_change_register').classList.remove("not_show");
		
	});

	document.getElementById('click_change_register').addEventListener('click',function(){

		document.getElementById('register_part').style.display = 'flex';
		document.getElementById('login_part').style.display = 'none';
		
		document.getElementById('click_change_register').classList.add("not_show");
		document.getElementById('click_change_login').classList.remove("not_show");

		document.getElementById('click_change_login').classList.add("show");
		document.getElementById('click_change_register').classList.remove("show");

	});

});





