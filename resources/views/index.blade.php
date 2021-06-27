<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
	<title>Library Management</title>

	<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<link href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css rel=stylesheet>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

	<link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
</head>
<body>
	@if(Session::has('book-added'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{Session::get('book-added')}}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	@if(Session::has('book-exists'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{Session::get('book-exists')}}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<section style="padding-top:20px">
		<div class="container">
			<div class="row" id="addbook">
				<div class="col-xs-6 col-md-8 offset-md-2 offset-xs-2">
					<div class="card">
						<div class="card-header">
							<h5>Add A Book</h5>
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
			@if(count($books) == 0)
				<div class="row" id="showbook">
					<div class="col-xs-10 col-md-10 offset-md-1 offset-xs-1">
						<div class="card">
							<div class="card-header">
								<h6>All Books</h6>
							</div>
							<div class="card-body">
								<h4 class="text-danger text-center"><u>NO BOOKS FOUND!!</u></h4>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="row" id="showbook">
					<div class="col-xs-10 col-md-10 offset-md-1 offset-xs-1">
						<div class="card">
							<div class="card-header">
								<h5>All Books</h5>
							</div>
							<div class="card-body table-responsive">
								<table class="table table-hover table-bordered" id="sortTable">
									<thead class="thead-dark">
										<tr>
											<th>Sl. No.</th>
											<th>Book Title</th>
											<th>Author Name</th>
											<th>No. of Pages</th>
											<th>Year Published</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
										<?php $serial = 0; ?>
										@foreach($books as $book)
											<tr>
												<td>{{++$serial}}.</td>
												<td>{{$book->book_title}}</td>
												<td>{{$book->author_name}}</td>
												<td>{{$book->book_pages}}</td>
												<td>{{$book->book_year_published}}</td>
												<td>{{$book->book_title}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</section>
</body>
</html>