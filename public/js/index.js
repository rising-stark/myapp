$(document).ready(function() {
	$('#sortTable').DataTable({
		"aaSorting": [],
		columnDefs: [{
			orderable: false,
			targets: 5
		}]
	});

	$(".close").click(function(){
		$('.alert').hide(500);
	});
});