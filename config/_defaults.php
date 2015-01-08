<?php
$config = [
	// set editor width
	'width' => null,
	// set editor height, ex) 300
	'height' => null,

	// set minimum height of editor
	'minHeight' => null,
	// set maximum height of editor
	'maxHeight' => null,

	// set focus to editable area after initializing summernote
	'focus' => false,

	// size of tab ex) 2 or 4
	'tabsize' => 4,
	// style with span (Chrome and FF only)
	'styleWithSpan' => true,

	// hide link Target Checkbox
	'disableLinkTarget' => false,
	// disable drag and drop event
	'disableDragAndDrop' => false,
	// disable resizing editor
	'disableResizeEditor' => false,

	// enable keyboard shortcuts
	'shortcuts' => true,

	// enable placeholder text
	'placeholder' => false,

	// codemirror options
	'codemirror' => [
		'mode' => 'text/html',
		'htmlMode' => true,
		'lineNumbers' => true
	],

	// language
	'lang' => 'en-US', // language 'en-US', 'ko-KR', ...
	// text direction, ex) 'rtl'
	'direction' => null,

	// toolbar
	'toolbar' => [
		['style', ['style']],
		['font', ['bold', 'italic', 'underline', 'clear']],
		['fontname', ['fontname']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],
		['insert', ['link', 'picture', 'hr']],
		['view', ['fullscreen', 'codeview']],
		['help', ['help']]
	],

	// air mode => inline editor
	'airMode' => false,
	'airPopover' => [
		['color', ['color']],
		['font', ['bold', 'underline', 'clear']],
		['para', ['ul', 'paragraph']],
		['table', ['table']],
		['insert', ['link', 'picture']]
	],

	// style tag
	'styleTags' => ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],

	// default fontName
	'defaultFontName' => 'Helvetica Neue',

	// fontName
	'fontNames' => [
	'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
	'Helvetica Neue', 'Impact', 'Lucida Grande',
	'Tahoma', 'Times New Roman', 'Verdana'
	],

	// pallete colors(n x n)
	'colors' => [
		['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
		['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
		['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE'],
		['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD'],
		['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5'],
		['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B'],
		['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842'],
		['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
	],

	// lineHeight
	'lineHeights' => ['1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '3.0'],

	// insertTable max size
	'insertTableMaxSize' => [
		'col' => 10,
		'row' => 10
	],

	// image
	'maximumImageFileSize' => null, // size in bytes, null = no limit
];
