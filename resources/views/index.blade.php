<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
	<title>Library Management</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
	@if(Session::has('book-added'))
		<div class="alert alert-success" role="alert">
			{{Session::get('book-added')}}
		</div>
	@endif
	@if(Session::has('book-exists'))
		<div class="alert alert-danger" role="alert">
			{{Session::get('book-exists')}}
		</div>
	@endif
	<section style="padding-top:30px">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-8 offset-md-2 offset-xs-2">
					<div class="card">
						<div class="card-header">
							<h4>Add A Book</h4>
						</div>
						<div class="card-body">
							<form method="POST" action="{{route('post.create')}}" autocomplete="on">
								@csrf
								<div class="form-group">
									<label for="book_title">Book Title</label>
									<input type="text" name="book_title" class="form-control" id="book_title" placeholder="Enter Book Title" required autocomplete="on">
								</div>
								<div class="form-group">
									<label for="author_name">Author's Name</label>
									<input type="text" name="author_name" class="form-control" id="author_name" placeholder="Enter Author's First Name" required autocomplete="on">
								</div>
								<div class="form-group">
									<label for="book_pages">No. of pages</label>
									<input type="number" name="book_pages" class="form-control" id="book_pages" placeholder="Enter no. of pages"  min="1" max="9999" required autocomplete="on">
								</div>
								<div class="form-group">
									<label for="book_year_published">Year Published</label>
									<input type="number" name="book_year_published" class="form-control" id="book_year_published" placeholder="Enter year published" min="1000" max="2022" required autocomplete="on">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Add Book</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>