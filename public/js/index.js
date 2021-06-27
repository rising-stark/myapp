$(document).ready(function() {
	$('#sortTable').DataTable({
		columnDefs: [{
			orderable: false,
			targets: 5
		}],
		columnDefs: [{
			searchable: false,
			targets: [0, 3, 4, 5]
		}]
	});

	$(".close").click(function(){
		$('.alert').hide(500);
	});
});