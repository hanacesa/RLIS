@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section id="portfolio" class="portfolio">
<div class="container-fluid">
    
    <h2> Volunteer Record </h2>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($volunteers as $volunteer)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $volunteer->name }}</td>
                <td>{{ $volunteer->email }}</td>
                <td>{{ $volunteer->dob }}</td>
                
                <td>

                <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <a  href="{{ route('volunteer.edit', $volunteer->id) }}" class="filter-web">Edit</a>
              <form method="post" action="{{ route('volunteer.destroy', $volunteer->id) }}" onsubmit="return confirm('Are you sure you want to delete this volunteer?')">
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
</div>
{!! $volunteers->links() !!}
</section>
@endsection
