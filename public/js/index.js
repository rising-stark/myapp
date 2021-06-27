$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#sortTable').DataTable({
		columnDefs: [{
			orderable: false,
			targets: 5
		},
		{
			searchable: false,
			targets: [0, 3, 4, 5]
		}]
	});

	$(".close").click(function(){
		$('.alert').hide(500);
	});

	$(".btn-delete").click(function(){
		var row = $(this).closest("tr");
		var book_title = row.find("td").eq(1).html();
		var author_name = row.find("td").eq(2).html();
		
		if(confirm("Are you sure you want to delete the book with Title = "+book_title+" and Author name = "+author_name)){
			var _token = $("input[name='_token']").val();
			$.ajax({
				type: 'POST',
				url: '/ajax-delete-book',
				data: {
					_token: _token,
					book_title: book_title,
					author_name: author_name
				},
				cache: false,
				success: function(result){
					if(result == 1){
						row.remove();
						var rowCount = $('#sortTable tr').length;
						if(rowCount == 1){
							$("#no-book").show();
							$("#book").hide();
						}
					}else{
						alert("Some error occured while deleting this book.");
					}
				}
			});
		}
	});
});