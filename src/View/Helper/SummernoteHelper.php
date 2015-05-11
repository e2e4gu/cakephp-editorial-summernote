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

	public function initialize() {
		//$this->Html->script('jquery.js', ['block' => true]);
		$this->css('Editorial/Summernote.summernote.css', ['block' => true]);
		if(Plugin::loaded('Garderobe')){
			$this->css('Editorial/Summernote.summernote-bs3.css', ['block' => true]);
		}
		$this->script('Editorial/Summernote.summernote.js', ['block' => true]);
		// Setup lang here
		if($lang = $this->config('options.lang')){
			$this->script('Editorial/Summernote.lang/summernote-'.$lang.'.js', ['block' => true]);
		}
		// TODO: code mirror support in summernote little buggy
		if(Plugin::loaded('Editorial/Codemirror')){
			$this->setCodemirrorAddon();
		}
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
