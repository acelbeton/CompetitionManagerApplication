<select name="user_id" class="form-control" required>
    <option value="">Select User</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }} [{{$user->email}}]</option>
    @endforeach
</select>
