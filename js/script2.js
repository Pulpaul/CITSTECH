$(document).ready(function() {

	// count noti chat user
	setInterval(function(){
            $('#countNotiChatUser').load('php/countNotiChatUser.php')
          }, 2000 );

	// fetch message user
            setInterval(function(){
                $('#messageUser').load('php/messageUser.php')
              }, 2000 ); 
            
	// remove outbox user
    $(document).on( "click", "#deleteOutbox", function(){
      var id = $(this).attr("data-id"); 

      swal({
          title: "Delete this item?",
	      text: "Note: This message will be deleted permanently.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Delete",
          cancelButtonText: "No, Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted", "", "success");
                $.ajax({
            	url: "php/deleteOutbox.php",
                type: "POST",
                data: { id:id },
                dataType: "json",
                success: function(data)
                {
                  window.location = "trashUser.php"; 
                }
          });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    }); 

  	// restore outbox user
    $(document).on( "click", "#restoreOutbox", function(){
      var id = $(this).attr("data-id"); 

      swal({
          title: "Restore this item?",
          text: "Note: This message will be moved back to outbox.",
          type: "info",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Restore",
          cancelButtonText: "No, Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Removed", "", "success");
                $.ajax({
            	url: "php/restoreOutbox.php",
                type: "POST",
                data: { id:id },
                dataType: "json",
                success: function(data)
                {
                  window.location = "trashUser.php"; 
                }
          });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    }); 

  	// remove outbox user
    $(document).on( "click", "#removeOutboxUser", function(){
      var id = $(this).attr("data-id"); 

      swal({
          title: "Remove this item?",
          text: "Note: This item will be moved to trash.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Remove",
          cancelButtonText: "No, Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Removed", "", "success");
                $.ajax({
            	url: "php/removeOutboxUser.php",
                type: "POST",
                data: { id:id },
                dataType: "json",
                success: function(data)
                {
                  window.location = "outbox.php"; 
                }
          });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    }); 

    // select type
	$("#type").select2({
	  placeholder: "Select a State"
	});

	// show concern
  	$("#btnShowConcern").click(function(){
        $("#showConcern").slideToggle("slow");
   	});

});