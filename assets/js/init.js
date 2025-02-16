function notify(type, text) {
	new Noty({
		theme: "metroui",
		type: type,
		layout: "bottomLeft",
		text: text,
		animation: {
			open: "animated bounceInRight", 
			close: "animated bounceOutDown"
		},
		timeout: 5000,
		progressBar: true
	}).show();
}
