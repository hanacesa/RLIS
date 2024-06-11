@extends('layouts.app')

@section('content')
<section id="member" class="member">
<div class="container">
    <div class="card-header">
        <h2>Update Member</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" action="{{ route('member.update', $member->id) }}">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $member->name }}">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="ic" name="ic" placeholder="IC" value="{{ $member->ic }}">
            <label for="ic">IC</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $member->address }}">
            <label for="address">Address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $member->email }}">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile Number" value="{{ $member->mobileno }}">
            <label for="mobileno">Mobile Number</label>
        </div>
        
            
        <div class="d-grid gap-2d-md-flex justify-content-md-center">
            <button class="add btn-custom-width" type="submit">Update</button>
        </div>
    </form>
    <form method="post" action="{{ route('member.destroy', $member->id) }}" onsubmit="return confirm('Are you sure you want to delete this Member?')">
        @csrf
        @method('DELETE')
        <div class="d-grid gap-2d-md-flex justify-content-md-center">
            <button type="submit" class="add btn-custom-width">Delete</button>
        </div>
    </form>

</div>
</section>
@endsection
