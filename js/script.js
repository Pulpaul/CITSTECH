$(document).ready(function(){  

	//seen thread each 
		$(document).on( "click", "#seenThreadEach", function(){
			var id_con = $(this).attr("data-id");

			$.ajax({
				url: "php/seenThreadEach.php",
				type: "POST",
				data: { id_con: id_con },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

		// disable rep image
		  $("#disableRepImage").click(function(){
			     $("#rep_image").removeAttr("required");
			     $("#formRepImg").slideToggle("slow");
		  	});

		// online or not
		setInterval(function(){
	      $('#userStatus').load('php/userStatus.php')
	    }, 2000 ); 

		$("#btnShowConcern").click(function(){
        	$("#showConcern").slideToggle("slow");
   		});

		$("#viewConcernOwn").click(function(){
        	$("#yourConcern").slideToggle("slow");
   		});

	    $("#disableImg").click(function(){
	        $("#image").removeAttr("required");
	        $("#hideImg").slideToggle("slow");
  		 });

		setInterval(function(){
	            $('#fetchConcernLatest').load('php/fetchConcernLatest.php')
	          }, 2000 ); 

	    setInterval(function(){ 
	            $('#fetchSupport').load('php/fetchSupport.php')
	          }, 2000 ); 

	    setInterval(function(){ 
	            $('#countConcernManager').load('php/countConcernManager.php')
	          }, 2000 ); 

	    setInterval(function(){ 
	            $('#countSupport').load('php/countSupport.php')
	          }, 2000 ); 

	    setInterval(function(){ 
	            $('#countConcern1').load('php/countConcern2.php')
	          }, 2000 );

	    setInterval(function(){ 
	            $('#fetchConcern').load('php/fetchConcern.php')
	          }, 2000 );

	    $(document).on( "click", "#viewConcernManager", function(){
			var id = $(this).attr("data-id");

		$.ajax({
			url: "php/concernDetails.php",
	        type: "POST",
	        data: { id:id },
	        dataType: "json",
	        success: function(data)
	        {	 
	        	$("#usn").html(data[0]['user_name']);
	        	$("#em").html(data[0]['user_email']); 
	        	$("#ty").html(data[0]['type']);
	        	$("#con").html(data[0]['concern']);
	        	$("#ds").html(data[0]['date_sent']);
	        	$("#ts").html(data[0]['time_sent']);
	        	$("#img").html(data[0]['image']); 
	        	$("#eml").html(data[0]['email']);
	        	$("#cid").html(data[0]['id']);
	        	$("#uid").html(data[0]['user_id']);
	        }
		});
	});

	    $("#btnReply").click(function(){
	        $("#replyConcern").slideToggle("slow");
	    });

	    $.ajax({
	          url: "php/fetchConcernManager.php",
	              type: "POST",
	              data: { },
	              dataType: "json",
	              success: function(data)
	              {
	                for (var i = 0; i < data.length; i++) {
	                  $("#fetchConcernManager").append("<tr id='row"+data[i]['id']+"'> <td>"+data[i]["id"]+"</td> <td>"+data[i]["user_email"]+"</td> <td>"+data[i]["type"]+"</td> <td>"+data[i]["date_sent"]+"</td> <td><button id='viewConcernManager' data-id='"+data[i]['id']+"' class='btn btn-info btn-fab btn-round btn-sm' data-toggle='modal' title='View' data-target='#viewConcern'><i class='fa fa-info-circle'></i></button>  <button id='removeConcernManager' data-id='"+data[i]['id']+"' class='btn btn-danger btn-fab btn-round btn-sm' data-toggle='tooltip' title='Remove'><i class='fa fa-trash'></i></button> </td> </tr>");
	                }
	              }
	        });

	    $.ajax({
	          url: "php/fetchSupportManager.php",
	              type: "POST",
	              data: { },
	              dataType: "json",
	              success: function(data)
	              {
	                for (var i = 0; i < data.length; i++) {
	                  $("#fetchSupportManager").append("<tr id='row"+data[i]['id']+"'> <td>"+data[i]["register_user_id"]+"</td> <td>"+data[i]["f_name"]+"</td> <td>"+data[i]["m_name"]+"</td> <td>"+data[i]["l_name"]+"</td> <td>"+data[i]["user_name"]+"</td> <td>"+data[i]["user_email"]+"</td> <td>"+data[i]["contact_number"]+"</td><td><button id='disableSupportAccount' data-id='"+data[i]['id']+"' class='btn btn-danger btn-fab btn-round btn-sm' rel='tooltip' title='Disable Account' data-target='#'><i class='fa fa-user-times'></i></button> </td> </tr>");
	                }
	              }
	        }); 

	    setInterval(function(){ 
	            $('#countConcernSupport').load('php/countConcern.php')
	          }, 2000 );

	    setInterval(function(){
            $('#countReply2').load('php/countReply2.php')
          }, 2000); 

	    setInterval(function(){
            $('#countReply').load('php/countReply.php')
          }, 2000 );

	    setInterval(function(){
            $('#countNotiConcern').load('php/countNotiConcern.php')
          }, 2000 );

	    setInterval(function(){
            $('#fetchReply').load('php/fetchReply.php')
          }, 2000 );

		$(document).on( "click", "#removeReply", function(){
			var rep_id = $(this).attr("data-id"); 

			swal({
	        title: "Remove this message?",
	        text: "Note: This message will be moved to trash.",
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
						url: "php/removeReply.php",
				        type: "POST",
				        data: { rep_id:rep_id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "inbox.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		setInterval(function(){
	        $('#countOutbox').load('php/countOutbox.php')
	      }, 2000 );

		$(document).on( "click", "#restoreReply", function(){
			var rep_id = $(this).attr("data-id"); 

			swal({
	        title: "Restore this message?",
	        text: "Note: This message will be moved back to Inbox.",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Restore",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Restored", "", "success");
		            $.ajax({
						url: "php/restoreReply.php",
				        type: "POST",
				        data: { rep_id:rep_id },
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

		$(document).on( "click", "#deleteReply", function(){
			var rep_id = $(this).attr("data-id"); 

			swal({
	        title: "Delete this message?",
	        text: "Note: This message will be deleted permanently",
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
						url: "php/deleteReply.php",
				        type: "POST",
				        data: { rep_id:rep_id },
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

		$(document).on( "click", "#removeConcern", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Remove this concern?",
	        text: "Note: This message will be moved to trash.",
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
						url: "php/removeConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "support.php";
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// restore concern support
		$(document).on( "click", "#restoreConcern", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Restore this concern?",
	        text: "Note: This message will be moved back to Inbox.",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Restore",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Restored", "", "success");
		            $.ajax({
						url: "php/restoreConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashSupport.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});
 		
 		// delete concern support
		$(document).on( "click", "#deleteConcern", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Delete this concern?",
	        text: "Note: This concern will be deleted permanently",
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
						url: "php/deleteConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashSupport.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// forward concern message
		$(document).on( "click", "#forwardConcern", function(){
			var id = $(this).attr("data-id"); 

				swal({
		        title: "Forward Concern?",
		        text: "Note: Enter valid reason to escalate this concern.",
		        type: "input",
		        showCancelButton: true,
		        closeOnConfirm: false,
		        showLoaderOnConfirm: true,
		        inputPlaceholder: "Enter Reason"
		    }, function (inputValue) {
		        if (inputValue === false) return false;
		        if (inputValue === "") {
		            swal.showInputError("Reason is required."); return false
		        }
		        setTimeout(function () {
		            swal("Forwarding Concern Successful","Wait for the manager to accept this concern","success");
		            window.location = "support.php"; 
		            $.ajax({
						url: "php/forwardConcern.php",
				        type: "POST",
				        data: { 
				        id:id,
				        inputValue: inputValue },
				        dataType: "json",
				        success: function(data)
				        {
				        	 
				        }
					});
		        }, 2000);  
		    });
		});

		//seen all concern message
		$(document).on( "click", "#seenConcern", function(){

			$.ajax({
				url: "php/seenConcern.php",
				type: "POST",
				data: { },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

		//seen each concern message
		$(document).on( "click", "#seenConcernEach", function(){
			var id = $(this).attr("data-id");

			$.ajax({
				url: "php/seenConcernEach.php",
				type: "POST",
				data: { id: id },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

		//fetch noti concern message
		setInterval(function(){
	            $('#fetchNotiConcern').load('php/fetchNotiConcern.php')
	          }, 2000 );

		//count noti reply message
		setInterval(function(){
	            $('#countNotiReply').load('php/countNotiReply.php')
	          }, 2000 );

		// fetch noti reply message
		setInterval(function(){
	            $('#fetchNotiReply').load('php/fetchNotiReply.php')
	          }, 2000 );

		//seen all reply message
		$(document).on( "click", "#seenReply", function(){

			$.ajax({
				url: "php/seenReply.php",
				type: "POST",
				data: { },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

		//seen each reply message
		$(document).on( "click", "#seenReplyEach", function(){
			var rep_id = $(this).attr("data-id");

			$.ajax({
				url: "php/seenReplyEach.php",
				type: "POST",
				data: { rep_id: rep_id },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

		//manager chart
		md.initDashboardPageCharts(); 

		//count forwarded concern
		setInterval(function(){
		        $('#countNotiForwardedConcern').load('php/countNotiForwardedConcern.php')
		    }, 2000 );

	    //seen forwarded concern
	    $(document).on( "click", "#seenForwardedConcern", function(){

			$.ajax({
				url: "php/seenForwardedConcern.php",
				type: "POST",
				data: { },
				dataType: "json",
				success:function(data)
				{

				}
			});
		});

	    //fetch noti forwarded concern
	    setInterval(function(){
	            $('#fetchNotiForwardedConcern').load('php/fetchNotiForwardedConcern.php')
	          }, 2000 );

	    // remove forwarded concern
	    $(document).on( "click", "#removeConcernManager", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Remove this concern?",
	        text: "Note: This message will be moved to trash.",
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
						url: "php/removeConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "concernManager.php";
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    // disable support account
	    $(document).on( "click", "#disableSupportAccount", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Disable this account?",
	        text: "Note: You can't undo this process.",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Disable",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Disabled", "", "success");
		            $.ajax({
						url: " ",
				        type: " ",
				        data: { },
				        dataType: " ",
				        success: function(data)
				        {
				        	window.location = " ";
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    //view ticket manager/support
	    $(document).on( "click", "#viewTicket", function(){
				var ticket_id = $(this).attr("data-id");

			$.ajax({
				url: "php/ticketDetails.php",
		        type: "POST",
		        data: { ticket_id:ticket_id },
		        dataType: "json",
		        success: function(data)
		        {	 
		        	$("#tid").html(data[0]['ticket_id']);
		        	$("#uid").html(data[0]['u_id']); 
		        	$("#cid").html(data[0]['con_id']);
		        	$("#ts").html(data[0]['time_sent']); 
		        	$("#ds").html(data[0]['date_sent']);
		        	$("#sid").html(data[0]['s_id']);  
		        	$("#rid").html(data[0]['rep_id']);
		        	$("#tr").html(data[0]['time_replied']);
		        	$("#dr").html(data[0]['date_replied']); 
		        }
			});
		});

	    //remove ticket manager
	    $(document).on( "click", "#removeTicketManager", function(){
			var ticket_id = $(this).attr("data-id"); 

			swal({
	        title: "Remove this ticket?",
	        text: "Note: This ticket will be moved to trash.",
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
						url: "php/removeTicket.php",
				        type: "POST",
				        data: { ticket_id:ticket_id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "ticketing.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    // count noti ticket support
		setInterval(function(){
            $('#countNotiTicket').load('php/countNotiTicket.php')
          }, 2000 );

		//add item manager
	    $("#addItemManager").click(function(){ 
			var department = $("#department").val();
			var pc_name = $("#pc_name").val();
			var printer_name = $("#printer_name").val();
			var system_unit = $("#system_unit").val();
			var mouse = $("#mouse").val();
			var monitor = $("#monitor").val();
			var keyboard = $("#keyboard").val();


			if (department == "" || pc_name == "" || printer_name == "" || system_unit == "" || mouse == "" || monitor == "" || keyboard == "") {
				swal("All fields are required!", "", "error");
			} 
			else { 
				swal({
			        title: "Add this item?", 
			        type: "info", 
			        showCancelButton: true,
			        closeOnConfirm: false,
			        showLoaderOnConfirm: true,
			    }, function () { 
			        setTimeout(function () {
			            swal("Item Added!","","success");  
			            window.location = "inventory.php";
			        }, 2000);

			    $.ajax({
					url: "php/addItemManager.php",
			        type: "POST",
			        data: { 
			        department: department,
			        pc_name: pc_name,
			        printer_name: printer_name,
			        system_unit: system_unit,
			        mouse: mouse,
			        monitor: monitor,
			        keyboard: keyboard
			         },
			        dataType: "json",
			        success: function(data)
			        {
						if (data == "Success") {   
							
						} else {
							alert("Error 101");
						}
			        }
				});
			    }); 
			}
		});

	    // count user manager
		setInterval(function(){
            $('#countPending').load('php/countPending.php')
          }, 2000 );

		// count ticket manager
		setInterval(function(){
            $('#countTicket').load('php/countTicket.php')
          }, 2000 );

		//remove ticket manager
	    $(document).on( "click", "#removeItemInventory", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Remove this item?",
	        text: "Note: This ticket will be moved to trash.",
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
						url: "php/removeItemInventory.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "inventory.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    //restore item
	    $(document).on( "click", "#restoreTicket", function(){
			var ticket_id = $(this).attr("data-id"); 

			swal({
	        title: "Restore this ticket?",
	        text: "Note: This will be moved back to tickets.",
	        type: "info",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Restore",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Restored", "", "success");
		            $.ajax({
						url: "php/restoreTicket.php",
				        type: "POST",
				        data: { ticket_id:ticket_id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashManager.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// delete ticket permanent
	    $(document).on( "click", "#deleteTicket", function(){
			var ticket_id = $(this).attr("data-id"); 

			swal({
	        title: "Delete this ticket?",
	        text: "Note: This will be deleted permanently.",
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
						url: "php/deleteTicket.php",
				        type: "POST",
				        data: { ticket_id:ticket_id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "inventory.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    //restore ticket
	    $(document).on( "click", "#restoreItem", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Restore this item?",
	        text: "Note: This will be moved back to Inventory.",
	        type: "info",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Restore",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Restored", "", "success");
		            $.ajax({
						url: "php/restoreItem.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashManager.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// delete ticket permanent
	    $(document).on( "click", "#deleteItem", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Delete this item?",
	        text: "Note: This will be deleted permanently.",
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
						url: "php/deleteItem.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashManager.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

	    // restore concern manager
		$(document).on( "click", "#restoreConcernManager", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Restore this concern?",
	        text: "Note: This message will be moved back to Inbox.",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Restore",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Restored", "", "success");
		            $.ajax({
						url: "php/restoreConcernManager.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashManager.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});
 		
 		// delete concern manager
		$(document).on( "click", "#deleteConcernManager", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Delete this concern?",
	        text: "Note: This concern will be deleted permanently",
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
						url: "php/deleteConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "trashManager.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// accept pending concern
		$(document).on( "click", "#acceptPendingConcern", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Accept this concern?",
	        text: "Note: This will be moved to concern",
	        type: "info",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Accept",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Accepted", "You can now reply to this concern", "success");
		            $.ajax({
						url: "php/acceptPendingConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "pendingConcern.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// cancel pending concern
		$(document).on( "click", "#declinePendingConcern", function(){
			var id = $(this).attr("data-id"); 

			swal({
	        title: "Decline this concern?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Decline",
	        cancelButtonText: "No, Cancel",
	        closeOnConfirm: false,
	        closeOnCancel: false
		    }, function (isConfirm) {
		        if (isConfirm) {
		            swal("Declined", "", "success");
		            $.ajax({
						url: "php/declinePendingConcern.php",
				        type: "POST",
				        data: { id:id },
				        dataType: "json",
				        success: function(data)
				        {
				        	window.location = "pendingConcern.php"; 
				        }
					});
		        } else {
		            swal("Cancelled", "", "error");
		        }
		    });
		});

		// fetch message user
		setInterval(function(){
	      $('#messageUser').load('php/messageUser.php')
	    }, 2000 ); 
});