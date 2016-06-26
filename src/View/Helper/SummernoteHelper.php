<?php
namespace Editorial\Summernote\View\Helper;

use Editorial\Core\View\Helper\EditorialHelper;
use Cake\Core\Configure;
use Cake\Core\Plugin;


class SummernoteHelper extends EditorialHelper {

/**
 * Default config for the helper.
 *
 * @var array
 */
	protected $_defaultConfig = [
		'options' => [
			'height' => null,
			'width' => null,
			'tabsize' => 4,
			'codemirror' => [
				'mode' => 'xml',
				'theme' => 'eclipse',
				'lineNumbers' => true
			],
			'lang' => 'en-US',
		]
	];

	public function initialize(array $config = array()) {
		//$this->Html->script('jquery.js', ['block' => true]);
		$this->css('Editorial/Summernote.summernote.css', ['block' => true]);
		$this->script('Editorial/Summernote.summernote.js', ['block' => true]);
		// Setup lang here
		if($lang = $this->config('options.lang')){
			$this->script('Editorial/Summernote.lang/summernote-'.$lang.'.js', ['block' => true]);
		}
		// TODO: code mirror support in summernote little buggy
		if(Plugin::loaded('Editorial/Codemirror')){
			$this->setCodemirrorAddon();
		}

		//Elfinder implementation
		$this->css([
				'Editorial/Summernote.jquery-ui/jquery-ui.min.css',
				'Editorial/Summernote.jquery-ui/jquery-ui.structure.min.css',
				'Editorial/Summernote.jquery-ui/jquery-ui.theme.min.css'
			],
			['block' => true]
		);
		$this->script('jquery-ui.min.js', ['block' => true, 'plugin' => false]);
		$this->css(['Editorial/Summernote.elfinder.min.css', 'Editorial/Summernote.theme.css'], ['block' => true]);
		$this->script([
				'Editorial/Summernote.elfinder.min.js',
				'Editorial/Summernote.plugin/elfinder/summernote-ext-elfinder.js',
				'Editorial/Summernote.plugin/elfinder/elfinder-callback.js',
			],
			['block' => true]
		);
		$this->config('options.toolbar', '');
		$this->config('options.toolbar', [
			['style', ['style']],
			['font', ['bold', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link', 'elfinder', 'video']],
			['view', ['fullscreen', 'codeview', 'help']]
		]);
	}


	public function connect($content = null, $block = true){
		if(empty($content)) {
			return;
		}
		$searchRegex = '/(<textarea.*class\=\".*'
			.Configure::read('Editorial.class').'.*\"[^>]*>.*<\/textarea>)/isU';
		$js = '';
		if(preg_match_all($searchRegex, $content, $matches)){
			$js .= "$(document).ready(function() {\n";
			$editorOptions = json_encode($this->config('options'));
			foreach ($matches[0] as $input){
				if(preg_match('/<textarea.*id\=\"(.*)\"[^>]*>.*<\/textarea>/isU', $input, $idMatches)) {
					$js .= "\tjQuery('#".$idMatches[1]."').summernote(".$editorOptions.");\n";
				}
			}
			$js .= "});\n";
		}
		if(!empty($js)){
			$this->Html->scriptBlock($js, ['block' => true]);
		}
	}

	protected function setCodemirrorAddon(){
		$this->Html->css('Editorial/Codemirror.codemirror.css', ['block' => true]);
		$codemirrorTheme = $this->config('options.codemirror.theme');
		if(!empty($codemirrorTheme)) {
			$this->Html->css('Editorial/Codemirror.theme/'.$codemirrorTheme.'.css', ['block' => true]);
		}
		$this->Html->script('Editorial/Codemirror.codemirror.js', ['block' => true]);
		$codemirrorMode = $this->config('options.codemirror.mode');
		if(!empty($codemirrorMode)) {
			$this->Html->script('Editorial/Codemirror.mode/'.$codemirrorMode.'/'.$codemirrorMode.'.js', ['block' => true]);
		}
		$this->Html->script('Editorial/Codemirror.formatting.min.js', ['block' => true]);
	}

}
