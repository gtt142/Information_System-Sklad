function start() {
	var items = document.getElementsByClassName('item-no-active');
	for (var i = 0; i < items.length; i++) {
		items[i].onmouseover = function(){
			this.classList.remove('item-no-active');
			this.classList.add('item-active');
		}
		items[i].onmouseleave = function(){
			this.classList.remove('item-active');
			this.classList.add('item-no-active');				
		}
	}
}

document.addEventListener('DOMContentLoaded', start);
