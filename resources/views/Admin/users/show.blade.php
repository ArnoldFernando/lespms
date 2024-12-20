<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/dist/css/lightgallery.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/dist/js/lightgallery.min.js"></script>

    <script>
        // Initialize lightGallery for image zoom
        document.addEventListener("DOMContentLoaded", function() {
            lightGallery(document.getElementById('image-gallery'));
        });
    </script>
    <div class="container">
        <h1>User Profile</h1>
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $user->name }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>User Type:</strong> {{ $user->usertype }}</p>
                <p><strong>Blocked:</strong> {{ $user->is_blocked ? 'Yes' : 'No' }}</p>

                <h5>Profile Image</h5>
                @if ($user->image)
                    <a href="{{ asset('storage/' . str_replace('public/', '', $user->image)) }}"
                        data-lightbox="image-gallery">
                        <img src="{{ asset('storage/' . str_replace('public/', '', $user->image)) }}" alt="Profile Image"
                            class="img-thumbnail" style="max-width: 200px;">
                    </a>
                @else
                    <p>No profile image available.</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Uploaded Images</h5>
            </div>
            <div class="card-body">
                @php
                    // Decode the files column (assuming it's stored as a JSON string in the database)
                    $files = json_decode($user->files, true);
                @endphp

                @if (is_array($files) && count($files) > 0)
                    <div id="image-gallery" class="row">
                        @foreach ($files as $file)
                            @php
                                // Remove the "public/" part of the path for proper asset resolution
                                $cleanedFilePath = str_replace('public/', '', $file);
                            @endphp
                            <div class="col-md-4 mb-3">
                                <a href="{{ asset('storage/' . $cleanedFilePath) }}" data-lightbox="image-gallery">
                                    <img src="{{ asset('storage/' . $cleanedFilePath) }}" alt="Uploaded Image"
                                        class="img-fluid img-thumbnail">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No images uploaded.</p>
                @endif
            </div>
        </div>

        @if ($user->usertype == 'service_provider')
            @if ($user->verified)
                <div class="alert alert-success mt-3" role="alert">
                    This Event Provider is verified.
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h5>Verify Service Provider</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.verify', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="admin_password">Enter Admin Password</label>
                                <input type="password" id="admin_password" name="admin_password" class="form-control"
                                    required>
                            </div>

                            @if ($errors->has('admin_password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('admin_password') }}
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Verify</button>
                        </form>
                    </div>

            @endif
        @endif
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>



    </div>


</x-app-layout>
