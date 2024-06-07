@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Search Form -->
<section id="portfolio" class="portfolio">

    <form method="GET" action="{{ route('borrow.index') }}" class="my-3">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Search by Book ID or IC" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="search">Search</button>
            </div>
        </div>
    </form>


    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Book ID</th>
                <th>Book Borrowed</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($borrows as $borrow)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ optional($borrow->member)->name ?? 'The member has been deleted' }}</td>
                <td>{{ $borrow->book_id }}</td>
                <td>{{ optional($borrow->book)->title ?? 'The book has been deleted' }}</td>
                <td>{{ $borrow->borrowdate }}</td>
                <td>{{ $borrow->returndate }}</td>
                <td>

                <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <a  href="{{ route('borrow.edit', $borrow->id) }}" class="filter-web">Edit</a>
              <form method="post" action="{{ route('borrow.destroy', $borrow->id) }}" onsubmit="return confirm('Are you sure you want to delete this record??')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="filter-web">Delete</button>
                        </form>
            </ul>
          </div>
        </div>

                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
