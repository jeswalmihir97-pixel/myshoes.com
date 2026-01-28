@extends('layout.cmaster')
@section('content')

<div class="container">
    <h3>Profile</h3>
    
    <img src="{{ session('profile_image', asset('uploads/default-profile.png')) }}" 
     alt="Profile" 
     class="profile-img" 
     style="width: 100px; height: 100px; border-radius: 50%;">

    
    <p>Username: {{ auth()->user()->username }}</p>
    <p>Email: {{ auth()->user()->email }}</p>

    <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="profile_image">Change Profile Picture:</label>
        <input type="file" name="profile_image" accept="image/*">
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

@endsection
