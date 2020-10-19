/*
*
*
*/

jQuery(document).ready(function(){
    

    jQuery('#manm-update').submit(function(event){
        event.preventDefault();

        var data = {
            'action': 'manm_save_manual',
            'manual': jQuery("#manm-init").html(),
            'id_post': jQuery("#manm-id-post").val(),
            'title': jQuery("#manm-title").text(),
            'id_user': jQuery('#manm-id-autor').val()
        }

        //console.log(data)

		jQuery.ajax({
			type: 'POST',
			url: manm_ajax.ajaxurl,
            data,
            beforeSend : function () {
                jQuery('#manm-btn-submit').val('<div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div>');
            },
			success: function(data){
                jQuery('#manm-btn-submit').html("Guardar");
                if (data == 200) {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-success");
                    jQuery("#manm-alert").html("El manual ha sido guardado exitosamente");
                } else {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                    jQuery("#manm-alert").html("Error"+ data +": Ha ocurrido un error, intente mas tarde");
                }
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                    location.href = "/";
                }, 5000);

				console.log(data);
			},
			error: function(err){
                jQuery('#manm-btn-submit').html("Guardar");
                jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                jQuery("#manm-alert").html("Error 501: Ha ocurrido un error en el servidor, intente mas tarde");
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                }, 5000);
                console.log(err);
			}
        });
    });
});


jQuery(document).ready(function () {
    jQuery("#manm-edit").click(_ => {
        var post_id = jQuery("#manm-post-id").val();
        location.href = "/manm-admin?post-id="+post_id;
    });

    jQuery("#manm-duplicate").click(_ => {
        var post_id = jQuery("#manm-post-id").val();
        location.href = "/manm-admin?post-id="+post_id;
    });

    jQuery("#manm-delete").click(_ => {
        var post_id = jQuery("#manm-post-id").val();

        var data = {
            'action': 'manm_delete_module',
            'post_id': post_id,
        }

        jQuery.ajax({
			type: 'POST',
			url: manm_ajax.ajaxurl,
            data,
            beforeSend : function () {
                jQuery('#manm-delete').val('<div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div>');
            },
			success: function(data){
                console.log(data);
                jQuery('#manm-delete').html("Eliminar manual");
                if (data == 200) {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-success");
                    jQuery("#manm-alert").html("El manual ha sido eliminado exitosamente");
                } else {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                    jQuery("#manm-alert").html("Error"+ data +": Ha ocurrido un error, intente mas tarde");
                }
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                    location.href = "/";
                }, 5000);
			},
			error: function(err){
                jQuery('#manm-delete').html("Eliminar manual");
                jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                jQuery("#manm-alert").html("Error 501: Ha ocurrido un error en el servidor, intente mas tarde");
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                }, 5000);

                console.log(err);
			}
        });
    });
});