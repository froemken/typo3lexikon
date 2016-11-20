tinymce.init({
	selector: '.tinymce4_rte',
	browser_spellcheck: true,
	paste_as_text: true,
	remove_script_host: false,
	relative_urls: false,
	language: 'de',
	entity_encoding: "raw",
	content_css : '/typo3conf/ext/typo3lexikon/Resources/Public/TinyMCE/skin.css',
	plugins: 'code',
	block_formats: 'Absatz=p;Überschrift 2=h2;Überschrift 3=h3;',
	valid_classes: {
		'p': 'bg-primary bg-success bg-info bg-warning bg-danger',
		'span': 'text-muted text-primary text-success text-info text-warning text-danger'
	},
	menu: {
		edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext'},
		insert: {title: 'Insert', items: 'link'},
		format: {title: 'Format', items: 'bold italic underline | removeformat'}
	},
	menubar: 'edit insert format',
	toolbar1: 'bold italic underline removeformat | formatselect styleselect | typo3link unlink | bullist code',
	external_plugins: {
		typo3filemanager: 'EXT:tinymce4_rte/Resources/Public/Plugins/Typo3FileManager/typo3filemanager.min.js',
		shy: 'EXT:tinymce/Resources/Public/JavaScript/TinymcePlugins/shy/plugin.min.js'
	},
	// Currently not in use typo3image
	contextmenu: 'typo3link unlink',
	style_formats: [
		{title: 'Inline', items: [
			{title: 'Muted', inline: 'span', classes: 'text-muted'},
			{title: 'Primary', inline: 'span', classes: 'text-primary'},
			{title: 'Success', inline: 'span', classes: 'text-success'},
			{title: 'Info', inline: 'span', classes: 'text-info'},
			{title: 'Warning', inline: 'span', classes: 'text-warning'},
			{title: 'Danger', inline: 'span', classes: 'text-danger'}
		]},
		{title: 'Block Background', items: [
			{title: 'Primary', block: 'p', classes: 'bg-primary'},
			{title: 'Success', block: 'p', classes: 'bg-success'},
			{title: 'Info', block: 'p', classes: 'bg-info'},
			{title: 'Warning', block: 'p', classes: 'bg-warning'},
			{title: 'Danger', block: 'p', classes: 'bg-danger'}
		]}
	],
	formats: {
		p: {block : 'p'},
		h2: {block: 'h2'},
		h3: {block: 'h3'},
		bold: {inline: 'strong'},
		italic: {inline: 'em'},
		underline: {inline: 'span', styles: {'text-decoration': 'underline'}}
	}
});
