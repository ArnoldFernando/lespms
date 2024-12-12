<x-app-layout>
    <div class="container">
        <h1>Edit User Type</h1>
        <form action="{{ route('users.updateUsertype', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Usertype -->
            <div class="mb-3">
                <label for="usertype" class="form-label">User Type</label>
                <select class="form-select" id="usertype" name="usertype" required>
                    <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</x-app-layout>
