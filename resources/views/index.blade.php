<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
	<meta name="_base_url" content="{{ url('/') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Library Management</title>

	<link href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css rel=stylesheet>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
							<form method="POST" action="{{route('book.create')}}" autocomplete="on">
								@csrf
								<div class="form-group">
									<label class="control-label" for="book_title">Book Title</label>
									<input type="text" name="book_title" class="form-control" id="book_title" placeholder="Enter Book Title" required autocomplete="on">
								</div>
								<div class="form-group">
									<label class="control-label" for="author_name">Author's Name</label>
									<input type="text" name="author_name" class="form-control" id="author_name" placeholder="Enter Author's Name" required autocomplete="on">
								</div>
								<div class="form-group">
									<label class="control-label" for="book_pages">No. of pages</label>
									<input type="number" name="book_pages" class="form-control" id="book_pages" placeholder="Enter no. of pages"  min="1" max="9999" required autocomplete="on">
								</div>
								<div class="form-group">
									<label class="control-label" for="book_year_published">Year Published</label>
									<input type="number" name="book_year_published" class="form-control" id="book_year_published" placeholder="Enter year of book published" min="1000" max="2022" required autocomplete="on">
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
				<div class="row" id="nobook">
					<div class="col-xs-10 col-md-10 offset-md-1 offset-xs-1">
						<div class="card">
							<div class="card-header">
								<h6>All Books</h6>
							</div>
							<div class="card-body" id="no-book">
								<h4 class="text-danger text-center"><u>NO BOOKS FOUND!!</u></h4>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="row" id="showbook">
					<div class="col-xs-10 col-md-12 col-lg-12 offset-xs-1">
						<div class="card">
							<div class="card-header">
								<div class="card-header-div">
									<h5>
										All Books
										<span id="unsaved">
											<strong class="btn-warning">UNSAVED CHANGES</strong>
										</span>
									</h5>
								</div>
								<div id="select-div" class="card-header-div">
									<form method='POST'>
										@csrf
										<label for="columns">Choose columns:</label>
										<select class="form-select" name="cols[]" multiple="multiple" size=2>
											<option selected value="book_title">Book Title</option>
											<option value="author_name">Author Name</option>
										</select>

										<div class="dropright">
											<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    	Choose Export Type
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
												<button formaction="{{route('ajax.table.export.csv')}}" type="submit" class="dropdown-item btn btn-primary">Export CSV&nbsp;&nbsp;&nbsp;<i class="fas fa-file-export"></i></button>
												<button formaction="{{route('ajax.table.export.xml')}}" type="submit" class="dropdown-item btn btn-primary">Export XML&nbsp;&nbsp;&nbsp;<i class="fas fa-file-export"></i></button>
												<button id="exportCurrentTable" class="dropdown-item btn btn-primary">Export Current table data&nbsp;&nbsp;&nbsp;<i class="fas fa-file-export"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="card-body" id="no-book">
								<h4 class="text-danger text-center"><u>NO BOOKS FOUND!!</u></h4>
							</div>
							<div class="card-body table-responsive" id="book">
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
												<td><button type="button" class="btn btn-warning btn-update">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-delete">Delete</button></td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<div class="card-body" id="no-book-search">
									<h4 class="text-danger text-center"><u>NO BOOKS FOUND FOR THIS SEARC TERM!!</u></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</section>
</body>
</html>