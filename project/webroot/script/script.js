const body = document.querySelector("body");

// вызов контекстного меню
const tableRows = document.querySelectorAll(".table-row");
const contextMenus = document.querySelectorAll(".context-menu");
for (let i=0; i<tableRows.length; i++) {
	let row = tableRows[i];
	let menu = contextMenus[i];
	row.addEventListener('contextmenu', function(e) {
		menu.style.top = e.pageY + "px";
		menu.style.left = e.pageX + "px";
		menu.classList.remove("d-none");
		for	(let j=0; j<contextMenus.length; j++) {
			if (j != i) {
				contextMenus[j].classList.add("d-none");
			}
		}
	});
};

body.addEventListener("click", function() {
	for	(let i=0; i<contextMenus.length; i++) {
		contextMenus[i].classList.add("d-none");
	}
});



// функция вызова всплывающего окна
function callPopup() {
	const popups = document.querySelectorAll('[popup]');
	const popupCallers = document.querySelectorAll('[popupCaller]');
	const popupClosers = document.querySelectorAll('[popupCloser]');

	popups.forEach( popup => {
		popupCallers.forEach( caller => {
			if (caller.getAttribute('popupCaller') == popup.getAttribute('popup')) {
				caller.addEventListener("click", function() {
					popup.classList.remove('d-none');
				});
			}
		});
		popupClosers.forEach( closer => {
			if (closer.getAttribute('popupCloser') == popup.getAttribute('popup')) {
				closer.addEventListener("click", function() {
					popup.classList.add('d-none');
				});
			}
		});
	});
}
callPopup();