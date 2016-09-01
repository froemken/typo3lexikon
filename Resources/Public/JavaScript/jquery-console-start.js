$(function() {
	var container = $('<div class="console">');
	$("div.content").append(container);
	var controller = container.console({
		promptLabel: 'Chat with 404> ',
		welcomeMessage: 'Oups error 404 was thrown. Type "help" to get a list of commands which may help you',
		autofocus: true,
		animateScroll: true,
		promptHistory: true,
		commandValidate: function(line) {
			return line != "";
		},
		commandHandle: function(line, handle) {
			$.ajax({
				type: "POST",
				url: "http://www.typo3lexikon.de/?eID=typo3lexikon_console",
				dataType: "text",
				data: {
					line: line
				}
			}).done(function(answer) {
				if (answer.substring(0, 4) == "http") {
					window.location.href = answer;
				} else {
					handle([{
						msg: answer,
						className: "jquery-console-message-value"
					}]);
				}
			});
		}
	});
});