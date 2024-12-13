<x-client-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @endif
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold">Your Profile</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mt-4">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            @if ($user->image)
                <img src="{{ Storage::url($user->image) }}" alt="Profile Image" class="w-32 h-32 rounded-full">
            @else
                <p>No profile image</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('user.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

</x-client-layout>
