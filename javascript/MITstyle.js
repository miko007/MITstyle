jQuery(document).ready(function($){
	var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;

	$('#MITuploadButton').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$("#MITlogoField").val(attachment.url);
				$("#MITlogo").html("<img src='" + attachment.url + "'>");
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}

		wp.media.editor.open(button);
		return false;
	});

	$('.add_media').on('click', function(){
		_custom_media = false;
	});
});