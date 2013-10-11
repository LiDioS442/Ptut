$(document).ready(function(){ 		/*Permet de définir les instructions javascript à exécuter dès que le html et le script qui contient l’appel à $(document).ready() 
								est chargé. Cette fonction n’attend pas la fin du chargement de tous les éléments de la page.*/
		$('#login').keyup(function(){ //Création évènement sur login (formulaire) si l'utilisateur appuie sur une touche
		var login = $('#login').val(); //Récupération de la valeur du champs du formulaire
		if(login != "")				   //Si le champs n'est pas vide alors
		{
			$('#loader').show();							 //Affiche un petit loader
			$.post('post.php',{login:login},function(data){  //Création function(data) qui va renvoyer les datas que Post.php aura traité
				$('.feedback').text(data);					 //Notre classe feedback avec les datas à l'intérieur
				$('#loader').hide();						 //Une fois les données récupérées on cache le loader
			});
		}else{
			$('.feedback').text('Veuillez saisir un pseudo');
		}
	});
});
