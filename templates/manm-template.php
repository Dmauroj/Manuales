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

				function example_image_upload_handler (blobInfo, success, failure, progress) {
					var xhr, formData;
					formData = new FormData();
					formData.append('file', blobInfo.blob(), blobInfo.filename());
					console.log(JSON.stringify(formData));

					var data = {
						'action': 'manm_upload_image',
						'file': blobInfo
					}

					jQuery.ajax({
						type: 'POST',
						url: manm_ajax.ajaxurl,
						data,
						success: function(data){
							console.log(data);
							if (data == 402) {
								failure('HTTP Error: ' + data);
								return;
							} else {
								success(data);
							}
						},
						error: function(err){
							failure('HTTP Error: ' + err.status);
							return;
						}
					});
				};

				var dfreeBodyConfig = {
					selector: '<?php echo $selector; ?>',
					images_upload_handler: example_image_upload_handler,
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
					toolbar: false,
					quickbars_image_toolbar: 'alignleft aligncenter alignright',
					quickbars_insert_toolbar: 'quicktable image codesample',
					quickbars_selection_toolbar: 'bold italic underline | formatselect | blockquote quicklink | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent',
					contextmenu: 'undo redo | fontsizeselect | forecolor backcolor | image inserttable | cell row column deletetable | help',
					fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 32pt 34pt 36pt 48pt',
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
