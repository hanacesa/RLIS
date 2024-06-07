@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section id="portfolio" class="portfolio">
<div class="container-fluid">
    
    <h2> Supervisor Record </h2>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($supervisors as $supervisor)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $supervisor->name }}</td>
                <td>{{ $supervisor->email }}</td>
                
                
                <td>

                <div class="btn-group" role="group">
                            <ul id="portfolio-flters">
                                <li><a href="{{ route('supervisor.edit', $supervisor->id) }}" class="filter-web">Edit</a></li>
                                <li>
                                    <form method="post" action="{{ route('supervisor.destroy', $supervisor->id) }}" onsubmit="return confirm('Are you sure you want to delete this supervisor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="filter-web">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $supervisors->links() !!}
</section>
@endsection
