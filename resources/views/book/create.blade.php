@extends('layouts.app')

@section('styles')
<!-- Add any additional CSS here if needed -->

@endsection

@section('content')
<section id="member" class="member">
<div class="container">
    
        <div class="card-header">
            <h2>Add New Book</h2>
        </div>

        <form method="POST" action="{{ route('book.store') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" placeholder="title" required>
                <label for="title">Title</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="author" name="author" placeholder="author">
                <label for="author">Author</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="publishername" name="publishername" placeholder="publishername">
                <label for="publishername">Publisher Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="publishedyear" name="publishedyear" placeholder="publishedyear">
                <label for="publishedyear">Published Year</label>
            </div>
            <div class="form-floating mb-3">
                
                <select name="category" id="category" class="form-select">
                    <option value="" selected hidden>Category:</option>
                    <option value="novel">Novel</option>
                    <option value="religion">Religion</option>
                    <option value="academic">Academic</option>
                    <option value="children">Children</option>
                    <option value="generalreadings">General Readings</option>
                </select>
            </div>
            <div class="d-grid gap-2">
            <centre>
            <button class="add btn-custom-width" type="submit">Add</button>
</centre>
            </div>
        </form>
    
</div>
</section>
@endsection

@section('scripts')
<!-- Add any additional scripts here if needed -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categorySelect = document.getElementById('category');
        var novelOption = categorySelect.querySelector('option[value="novel"]');
        novelOption.classList.add('hide-option');
    });
</script>
@endsection
