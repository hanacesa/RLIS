@extends('layouts.app')

@section('content')
<section id="member" class="member">
<div class="container">

    <div class="card-header">
        <h2>Edit Supervisor</h2>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
    @endif
    <form method="post" action="{{ route('supervisor.update',$supervisor->id) }}">
        @csrf
        @method ('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $supervisor->name }}">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="email" 
            value="{{ $supervisor->email }}">
            <label for="email">Email</label>
        </div>
        

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="password">
            <label for="password">Password</label>
        </div>
        
        <div class="d-grid gap-2">
        <centre>
            <button class="add btn-custom-width" type="submit">Update</button>
</centre>
        </div>
    </form>
    @if(session('success'))
    <div class="alert alert-success mt-3">
    Supervisor record updated successfully.
    </div>
    @endif

</div>
</section>
@endsection
