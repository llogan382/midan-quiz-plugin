function nextquest() {
	var checkbox = document.querySelectorAll('input');
	var checkboxChecked = [];
	for (var i = 0; i < 4; i++) {
		if (checkbox[i].checked) {
			// console.log(checkbox[0]);
			checkboxChecked.push(checkbox[i].name);
		} else {
			// checkboxChecked.push(checkbox[i]."No response");

		}

	}
	console.log(checkboxChecked);

}