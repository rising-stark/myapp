$(document).ready(function() {

	var unsavedChanges = 0;

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#sortTable').DataTable({
		language: {
			searchPlaceholder: "Book title/Author name"
		},
		columnDefs: [{
				orderable: false,
				targets: 5
			},
			{
				searchable: false,
				targets: [0, 3, 4, 5]
			}
		]
	});

	$(".close").click(function() {
		$('.alert').hide(500);
	});

	$(document.body).on('click', '.btn-delete', function(e) {
		if (unsavedChanges > 0) {
			alert("Cannot Delete a record while there are unsaved changes");
			return;
		}
		var row = $(this).closest("tr");
		var book_title = row.find("td").eq(1).html();
		var author_name = row.find("td").eq(2).html();

		if (confirm("Are you sure you want to delete the book with Title = " + book_title + " and Author name = " + author_name)) {
			var _token = $("input[name='_token']").val();
			$.ajax({
				type: 'POST',
				url: "ajax-delete-book",
				data: {
					_token: _token,
					book_title: book_title,
					author_name: author_name
				},
				cache: false,
				success: function(result) {
					if (result == 1) {
						row.remove();
						var rowCount = $('#sortTable tr').length;
						if (rowCount == 1) {
							var searchTermLength = $('.dataTables_filter input').val().length;
							if (searchTermLength == 0) {
								$("#no-book").show();
								$("#book").hide();
							} else {
								//$("#no-book-search").show();								
							}
						}
					} else {
						alert("Some error occured while deleting this book.");
					}
				}
			});
		}
	});

	$(document.body).on('click', '.btn-update', function(e) {
		unsavedChanges++;
		$("#unsaved").show();
		var row = $(this).closest("tr");
		var author_name = row.find("td").eq(2).html();

		var input = $('<input type="text" placeholder="Enter Author&apos;s Name"/><input type="hidden" value="' + author_name + '"/>');
		input.val(author_name);
		$(this).closest("tr").find("td").eq(2).html(input);
		$(this).html("SAVE");
		$(this).removeClass("btn-warning");
		$(this).removeClass("btn-update");
		$(this).addClass("btn-success");
		$(this).addClass("btn-save");
	});

	$(document.body).on('click', '.btn-save', function(e) {
		var btn = $(this);
		var row = $(this).closest("tr");
		var book_title = row.find("td").eq(1).html();
		var old_author_name = row.find("td input").eq(1).val();
		var new_author_name = row.find("td input").eq(0).val();
		var _token = $("input[name='_token']").val();
		$.ajax({
			type: 'POST',
			url: 'ajax-update-author',
			data: {
				_token: _token,
				book_title: book_title,
				old_author_name: old_author_name,
				new_author_name: new_author_name
			},
			cache: false,
			success: function(result) {
				if (result == 1) {
					unsavedChanges--;
					btn.html("Update");
					btn.addClass("btn-warning");
					btn.addClass("btn-update");
					btn.removeClass("btn-success");
					btn.removeClass("btn-save");
					btn.closest("tr").find("td").eq(2).html(new_author_name);
					/*$(document).trigger("add-alerts", [{
						"message": "Author Name updated successfully.",
						"priority": 'success'
					}]);*/
					if (unsavedChanges == 0) {
						$("#unsaved").hide();
					}
				} else {
					alert("Some error occured while updating the author name.");
				}
			}
		});
	});

	$("#exportCurrentTable").click(function(e) {
		e.preventDefault();
		var colDict = {
			book_title: 1,
			author_name: 2
		}
		var data = "";
		var tableData = [];
		var rows = $("#sortTable tr");
		var selectedCols = $("#colSelect").val();
		var selectedColsArr = [];
		selectedCols.forEach(function(i){
			selectedColsArr.push(colDict[i]);
		})

		rows.each(function(index, row) {
			var rowData = [];
			$(row).find("th, td").each(function(index, column) {
				if(selectedColsArr.includes(index)){
					rowData.push(column.innerText);
				}
			});
			tableData.push(rowData.join(","));
		});
		data += tableData.join("\n");

		/*
		 * Make CSV downloadable
		 */
		var downloadLink = document.createElement("a");
		var blob = new Blob(["\ufeff", data]);
		var url = URL.createObjectURL(blob);
		downloadLink.href = url;
		downloadLink.download = "Books Info.csv";

		/*
		 * Actually download CSV
		 */
		document.body.appendChild(downloadLink);
		downloadLink.click();
		document.body.removeChild(downloadLink);
	});
});