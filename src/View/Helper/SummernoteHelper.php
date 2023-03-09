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
        'style' => '', //possible values 'bs4', 'lite'
		'options' => [
			'height' => null,
			'width' => null,
            'tabsize' => 4,
            'dialogsInBody' => true,
			'codemirror' => [
				'mode' => 'xml',
				'theme' => 'eclipse',
				'lineNumbers' => true
			],
			'lang' => 'en-US',
			'toolbar' => [
				['style', ['undo', 'redo', 'style', 'clear']],
				['font', ['fontname', 'fontsize', 'bold', 'italic', 'underline', 'color']],
				['fontname', []],
                ['color', []],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			]
		]
	];

	public function initialize(array $config = array()): void
	{

        $style = '';
        if($style = $this->getConfig('style')){
            $style = '-'.$style;
        }
        $this->css('Editorial/Summernote.summernote'.$style.'.css', ['block' => true]);
        $this->script('Editorial/Summernote.summernote'.$style.'.js', ['block' => true]);

		// Setup lang here
		if($lang = $this->getConfig('options.lang')){
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
		$this->script('Editorial/Summernote.jquery-ui.min.js', ['block' => true]);
		$this->css(['Editorial/Summernote.elfinder.min.css', 'Editorial/Summernote.theme-bootstrap-libreicons-svg.css'], ['block' => true]);
        $this->script([
				'Editorial/Summernote.elfinder.min.js',
				'Editorial/Summernote.plugin/elfinder/summernote-ext-elfinder.js',
				'Editorial/Summernote.plugin/elfinder/elfinder-callback.js',
			],
			['block' => true]
		);
		$this->replaceButton('elfinder', 'picture');
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
			$editorOptions = json_encode($this->getConfig('options'));
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
		$codemirrorTheme = $this->getConfig('options.codemirror.theme');
		if(!empty($codemirrorTheme)) {
			$this->Html->css('Editorial/Codemirror.theme/'.$codemirrorTheme.'.css', ['block' => true]);
		}
		$this->Html->script('Editorial/Codemirror.codemirror.js', ['block' => true]);
		$codemirrorMode = $this->getConfig('options.codemirror.mode');
		if(!empty($codemirrorMode)) {
			$this->Html->script('Editorial/Codemirror.mode/'.$codemirrorMode.'/'.$codemirrorMode.'.js', ['block' => true]);
		}
		$this->Html->script('Editorial/Codemirror.formatting.min.js', ['block' => true]);
	}

	protected function replaceButton($target, $source){
		$toolbar = $this->getConfig('options.toolbar');
		foreach($toolbar as $i=>$bar){
			foreach($bar[1] as $j=>$button){
				if($button == $source){
					$toolbar[$i][1][$j] = $target;
				}
			}
		}
		$this->setConfig('options.toolbar', '');
		$this->setConfig('options.toolbar', $toolbar);
	}

}
