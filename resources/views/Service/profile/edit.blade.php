<x-serv-provider-layout>


    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold">Edit Profile</h1>

        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', Auth::user()->name) }}">
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', Auth::user()->email) }}" disabled>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Old Password Field -->
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" id="old_password" name="old_password" class="form-control">
                @error('old_password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password Field -->
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control">
                @error('new_password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm New Password Field -->
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="form-control">
                @error('new_password_confirmation')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Profile Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" id="image" name="image" class="form-control">
                @error('image')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

    </div>
</x-serv-provider-layout>
