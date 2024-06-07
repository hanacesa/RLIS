@extends('layouts.app')

@section('content')
<section id="member" class="member">
<div class="container">

    <div class="card-header">
    <h2>Add New Volunteer</h2>
    </div>

    <form method="POST" action="{{ route('volunteer.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="email">
            <label for="email">Email</label>
        </div>

        <div class="form-floating mb-3">
        <input type="date" class="form-control" id="dob" name="dob" placeholder="dob">
        <label for="dob">Date of Birth</label>
        </div>

       
    

        <div class="form-floating mb-3">
            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
            <label for="password_confirmation">Confirm Password</label>
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