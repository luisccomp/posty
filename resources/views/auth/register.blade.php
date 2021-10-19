@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" name="name" id="name" 
                     placeholder="Your name" value="{{ old('name') }}">

                    @error('name')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" name="username" id="username" 
                     placeholder="Your username" value="{{ old('username') }}">
                    
                    @error('username')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" name="email" id="email" 
                     placeholder="Your email" value="{{ old('email') }}">
                    
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" name="password" 
                     id="password" placeholder="Your Password" value="{{ old('password') }}">
                    
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password Again</label>
                    <input type="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg" name="password_confirmation" 
                     id="password_confirmation" placeholder="Repeat your password" value="">
                </div>
                <div class="mb-4">
                    <button class="bg-blue-500 text-white px-4 py-3 rounded fond-medium w-full">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection