@extends('layouts.app')

@section('content')
<section id="member-history" class="member-history">
    <div class="container">
        <div class="card-header">
            <h2>{{ $member->name }}'s Borrowed History</h2>
        </div>
        @if($borrowedBooks->isEmpty())
            <div class="alert alert-info">
                No borrowed history found for this member.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $index => $borrow)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $borrow->book->id }}</td>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->book->author }}</td>
                            <td>{{ $borrow->borrowdate }}</td>
                            <td>{{ $borrow->returndate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
@endsection
