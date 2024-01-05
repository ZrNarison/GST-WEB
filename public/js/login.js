$("#login").ready(function (){
    let input = document.querySelector("#passwordlogin");
	let btn = document.querySelector("#logineye");
	btn.onclick = function (){
		if(input.type === "password"){
			input.type ="text";
			btn.classList.add("active")
		}else{
			input.type ="password";
			btn.classList.remove("active")
		}
	}
})
$(document).ready(function(){
	$("#formlogin").validate({
		rules:{
		_username:{
			required:true,
			minlength:4,
			maxlength:255
		},
		_password:{
			required:true,
			minlength:5,
			maxlength:20
		}
		},
		messages:{
		_username:{
			required:"Votre pseudo !",
			minlength:"Utilisateur n'existe pas, nom trop court",
			maxlength:"C'est inacceptable,Utilisateur trop"
		},
		_password:{
			required:"Votre mot de pass SVP !",
			minlength:"Mot de pass trop court ",
			maxlength:"Mot de pass trop long "
		}
		}
	})
});