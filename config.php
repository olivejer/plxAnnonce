<?php if(!defined('PLX_ROOT')) exit; ?>
<script type="text/javascript" src="<? echo PLX_PLUGINS; ?>/plxAnnonce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector : 'textarea#edit',
	height:'350px',
    width:'600px',
	theme: "modern",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "../../css/plxAnnonce.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]

});
</script>
<?php




# Control du token du formulaire
plxToken::validateFormToken($_POST);

if(!empty($_POST)) {

	if(isset($_POST['edit']))
		$plxPlugin->setParam('edit', $_POST['edit'], 'cdata');
		
	if(isset($_POST['debug']))
		$plxPlugin->setParam('debug', '1', 'numeric');
	else
		$plxPlugin->setParam('debug', '0', 'numeric');
		
	$plxPlugin->saveParams();
	header('Location: parametres_plugin.php?p=plxAnnonce');
	exit;
}
?>

<h2><?php echo $plxPlugin->lang('L_TITLE_CONFIG') ?></h2>
<h3><?php $plxPlugin->lang('L_DESCRIPTION'); ?></h3>
</br>

<form action="parametres_plugin.php?p=plxAnnonce" method="post">
	<fieldset>
		<p class="field"><label for="edit"><?php $plxPlugin->lang('L_CONTENT'); ?> : </label></p>
		<textarea id="edit" name="edit"><? echo $plxPlugin->getParam('edit'); ?></textarea>
		<p class="field"><label for="debug"><?php $plxPlugin->lang('L_DEBUG'); ?> : </label></p>
		<input type="checkbox" <? if ($plxPlugin->getParam('debug') == 1) echo "checked=\"checked\""; ?> id="debug" name="debug" value="debug">
		<p><?php echo plxToken::getTokenPostMethod() ?>
			<input type="submit" name="submit" value="<?php $plxPlugin->lang('L_SAVE'); ?>" />
		</p>
	</fieldset>
</form>
