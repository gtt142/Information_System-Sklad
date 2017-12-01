function deleteNotif() {
	var but = document.getElementsByClassName('delete');
	for( var i = 0; i < but.length; i++){
		but[i].onclick = function(event){
			if(!confirm("Удалить?")) {
				event.preventDefault();
			}
		}
	}
}

document.addEventListener('DOMContentLoaded', deleteNotif);