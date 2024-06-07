@extends('layouts.app')

@section('content')
<section id="member" class="member">
<div class="container">
  
    <div class="card-header">
    <h2>Add New Member</h2>
    </div>

    <form method="POST" action="{{ route('member.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="ic" name="ic" placeholder="ic">
            <label for="ic">IC</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="address" name="address" placeholder="address">
            <label for="address">Address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="mobileno">
            <label for="mobileno">Mobile Number</label>
        </div>
        
        <div class="d-grid gap-2">
            <centre>
            <button class="add btn-custom-width" type="submit">Add</button>
</centre>
        </div>
    </form>
</div>  

</div>
</section>
@endsection