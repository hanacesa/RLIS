<!-- resources/views/book/index.blade.php -->
@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section id="portfolio" class="portfolio">
<div class="container-fluid">
    <h2> Book Record </h2>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher Name</th>
                <th>Published Year</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($books as $book)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publishername }}</td>
                <td>{{ $book->publishedyear }}</td>
                <td>{{ $book->category }}</td>
                <td>

                <div class="btn-group" role="group">
                            <ul id="portfolio-flters">
                            @if($member_id)
                                <a href="{{ route('borrow.create', ['member_id' => $member_id, 'book_id' => $book->id]) }}" class="filter-web">Borrow</a>
                                @else
                                <button onclick="alert('Select a member to borrow a book')" class="filter-web">Borrow</button>
                                @endif
                                <a href="{{ route('book.edit', $book->id) }}" class="filter-web">Edit</a>
                                
                                    <form method="post" action="{{ route('book.destroy', $book->id) }}" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="filter-web">Delete</button>
                                    </form>
                                
                            </ul>
                        </div>


                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</section>
@endsection
