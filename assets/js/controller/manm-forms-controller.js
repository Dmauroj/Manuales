/*
*
*
*/

function manm_delete(forceDelete, post_id) {
        var data = {
            'action': 'manm_delete_module',
            'post_id': post_id,
            'force_delete': forceDelete
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
                }, 3000);
			},
			error: function(err){
                jQuery('#manm-delete').html("Eliminar manual");
                jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                jQuery("#manm-alert").html("Error 501: Ha ocurrido un error en el servidor, intente mas tarde");
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                }, 3000);

                console.log(err);
			}
        });
}

jQuery(document).ready(function(){

    jQuery('#manm-update').submit(function(event){
        event.preventDefault();
        var role = jQuery("#manm-id-role").val();

        jQuery("[contenteditable=true]").prop("contenteditable","false");
        jQuery(".manm-btn-more").parent().remove();
        
        if (role === "editor2") {
            jQuery("[contenteditable=true]").prop("contenteditable","false");
            jQuery(".custom-control.custom-switch").remove();
            jQuery(".manm-switch").css('padding','0');
            jQuery(".manm-switch").css('margin-bottom','0');
            jQuery(".manm-switch").css('background-color','transparent');
            jQuery(".manm-switch").css('border','none');
            jQuery(".manm-d-none").html("");
            jQuery(".manm-d-none").removeClass("manm-d-none");
        }
        
        var data = {
            'action': 'manm_save_manual',
            'manual': jQuery("#manm-init").html(),
            'id_post': jQuery("#manm-id-post").val(),
            'title': jQuery("#manm-title").text(),
            'id_user': jQuery('#manm-id-autor').val()
        }

        if(jQuery('#manm-duplicate-post').val() === '1') {
            data.duplicate = true;
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
        location.href = "/manm-admin?post-id="+post_id+"&duplicate=1";
    });

    jQuery("#manm-view").click(_ => {
        var post_id = jQuery("#manm-post-id").val();
        location.href = "/manm-print?post-id="+post_id;
    });

    jQuery(document).on( 'click',"button#manm-delete-trash", _ => {
        var id = jQuery("#manm-post-id").val();
        manm_delete(0,id);
    });

    jQuery(".manm-delete").click(e => {
        var id = e.target.id.slice(4);
        manm_delete(1,id);
    });

    jQuery(".manm-restore").click(e => {
        var id = e.target.id.slice(4);
        var data = {
            'action': 'manm_untrash_module',
            'post_id': id
        }

        jQuery.ajax({
			type: 'POST',
			url: manm_ajax.ajaxurl,
            data,
			success: function(data){
                console.log(data);
                if (data == 200) {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-success");
                    jQuery("#manm-alert").html("El manual ha sido restaurado exitosamente");
                } else {
                    jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                    jQuery("#manm-alert").html("Error"+ data +": Ha ocurrido un error, intente mas tarde");
                }
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                    location.href = "/";
                }, 3000);
			},
			error: function(err){
                jQuery("#manm-alert").removeClass().addClass("alert alert-danger");
                jQuery("#manm-alert").html("Error 501: Ha ocurrido un error en el servidor, intente mas tarde");
                setTimeout(() => {
                    jQuery("#manm-alert").removeClass().addClass("d-none");
                    jQuery("#manm-alert").html("");
                }, 3000);

                console.log(err);
			}
        });
    });
});



jQuery("#manm-id-role").ready(function () {
    var UUID = 0;
    var role = jQuery("#manm-id-role").val();

    jQuery(".manm-switch").each(function( index ) {
        if (role === "editor2") {
            var idUnic = 'switch-' + ( ( ++UUID ).toString( ) );
            var switchHtml = '<div id="manm-'+idUnic+'" class="custom-control custom-switch">';
            switchHtml += '<input type="checkbox" class="custom-control-input" id="'+idUnic+'" value="true" checked>';
            switchHtml += '<label class="custom-control-label" for="'+idUnic+'">Habilitar/Deshabilitar</label>';
            switchHtml += '</div>';
            jQuery(this).css('border','solid 1px blue');
            jQuery(this).css('padding','0.5rem');
            jQuery(this).css('margin-bottom','0.5rem');
            jQuery(this).prepend(switchHtml);
        }
    });
});

jQuery(document).on( 'click', '.custom-control-input', function(){
    var switchVal = jQuery(this).val();

    if(switchVal === "true") {
        jQuery(this).parent().parent().css('background-color','gray');
        jQuery(this).parent().parent().addClass("manm-d-none");
        jQuery(this).val(",id");
    } else {
        jQuery(this).parent().parent().css('background-color','transparent');
        jQuery(this).parent().parent().removeClass("manm-d-none");
        jQuery(this).val("true");
    }
    
});

jQuery(document).on( 'click', '#manm-btn-exit', function(){
    location.href = "/";
});

jQuery(document).on( 'click', '#manm-btn-print', function(){
    jQuery("#header-print").css('display','none');
    setTimeout(() => {
        window.print();
    },1000);
    setTimeout(() => {
        jQuery("#header-print").css('display','flex');
    },5000);
});


jQuery(document).ready(function () {
    jQuery("form#manm-update .manm-dublicate-section").each(function () {
        var more = '<div class="row p-1"><a class="btn btn-primary manm-btn-more text-white ml-1" style="text-decoration:none;">+<a><a class="btn btn-danger manm-btn-menos text-white ml-1" style="text-decoration:none;">-<a></div>';
        jQuery(this).parent().prepend(more);
    })
});

jQuery(document).on( 'click', '.manm-btn-more', function(){
    var copy = jQuery(this).parent().parent().html();

    if (jQuery(this).parent().parent().hasClass("manm-green")) {
        jQuery(this).parent().parent().parent().append('<div class="container-fluid manm-green" style="background-color:#4a975d;">'+ copy +'</div>');
    } else {
        jQuery(this).parent().parent().parent().append('<div class="container-fluid">'+ copy +'</div>');
    }
});
   
jQuery(document).on( 'click', '.manm-btn-menos', function(){
    jQuery(this).parent().parent().remove();
});