<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title><?php echo wp_get_document_title(); ?></title>
	<?php endif; ?>
	<?php
		$user = wp_get_current_user();
		$selector = '';
		switch ($user->roles[0]) {
			case 'editor1':
				$selector = '.dfree-change-admin';
				break;
			case 'editor2':
				$selector = '.manm-editor';
				break;
			case 'administrator':
				$selector = '.dfree-change-admin';
				break;
			default:
				print_r($user->roles);
				wp_redirect(home_url());
				exit;
				break;
		}
		?>
			<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
			<script src="https://cdn.tiny.cloud/1/w6p0n3pzj99uswp6x8i1ltjc3mthhshtctizxm95i1fd6um3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>	<?php wp_head(); ?>
			<script>

				var dfreeHeaderConfig = {
					selector: '.dfree-header',
					menubar: false,
					inline: true,
					plugins: [
					'lists',
					'powerpaste',
					'autolink'
					],
					toolbar: 'undo redo | bold italic underline',
					valid_styles: {
					'*': 'font-size,font-family,color,text-decoration,text-align'
					},
					powerpaste_word_import: 'clean',
					powerpaste_html_import: 'clean',
				};

				var dfreeBodyConfig = {
					selector: '<?php echo $selector; ?>',
					menubar: false,
					inline: true,
					plugins: [
						'autolink',
						'codesample',
						'link',
						'lists',
						'media',
						'powerpaste',
						'table',
						'image',
						'imagetools',
						'quickbars',
						'codesample',
						'help'
					],
					image_title: true,
					automatic_uploads: true,
					file_picker_types: 'image',
					file_picker_callback: function (cb, value, meta) {
						var input = document.createElement('input');
						input.setAttribute('type', 'file');
						input.setAttribute('accept', 'image/*');

						input.onchange = function () {
							var file = this.files[0];

							var reader = new FileReader();
							reader.onload = function () {
								var id = 'blobid' + (new Date()).getTime();
								var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
								var base64 = reader.result.split(',')[1];
								var blobInfo = blobCache.create(id, file, base64);
								blobCache.add(blobInfo);
								/* call the callback and populate the Title field with the file name */
								cb(blobInfo.blobUri(), { title: id});
								handleImage(reader.result,file);
								handleImageData(id,file.name,base64);
							};
							
							reader.readAsDataURL(file);
						};

						input.click();
					},
					toolbar: false,
					quickbars_image_toolbar: 'alignleft aligncenter alignright | rotateleft rotateright | imageoptions',
					quickbars_insert_toolbar: 'quicktable image codesample',
					quickbars_selection_toolbar: 'bold italic underline | formatselect | blockquote quicklink | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent',
					contextmenu: 'undo redo | fontsizeselect | forecolor backcolor | image inserttable | cell row column deletetable | help',
					powerpaste_word_import: 'clean',
					powerpaste_html_import: 'clean',
				};
				
				tinymce.init(dfreeHeaderConfig);
				tinymce.init(dfreeBodyConfig);
			</script>
	<?php wp_head(); ?>
</head>
<body>

	<?php
		wp_body_open();
	?>

	<header class="mdc-top-app-bar app-bar" id="app-bar">
		
	</header>
	<div>
		<main class="main-content" id="main-content">
			<?php
				the_content();
			?>
		</main>
	</div>
    <?php
		wp_footer();
	?>
	</body>
</html>
