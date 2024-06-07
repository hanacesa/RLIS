@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<section id="confirmborrow">
    
        

        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
                <div class="col-md-6 text-center">
                    <h2>Confirm Borrow</h2>
                    <p>Member: {{ $member->name }}</p>
                    <p>Book: {{ $book->title }}</p>
                    <form action="{{ route('borrow.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                            <button type="submit" class="btn btn-primary">Confirm Borrow</button>
                        
                    </form>
                    <div class="text-center mt-4">
                        <a href="{{ route('member.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    
</section>
@endsection
