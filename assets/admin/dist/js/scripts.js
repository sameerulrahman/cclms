 	// To make Pace works on Ajax calls
	$(document).ajaxStart(function () {
		Pace.restart()
	})
  
	
 
	//Confirm modal on delete
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	
	$(document).ready(function() {
		$('.select2').select2();
	});
 
	$(function () {
		//Add text editor
		$("#compose-textarea").wysihtml5();
	});
 
	$(function () {
	
		$('#tableImages').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
		})
		
		$('#tableGroups').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
		})
		
		$('#tableUsers').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
		})
	})

	