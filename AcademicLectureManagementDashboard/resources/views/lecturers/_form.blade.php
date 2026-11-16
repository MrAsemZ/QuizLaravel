
<div class="mb-3">
    <label class="form-label">User Account</label>

    <select name="user_id" class="form-select" required>
        <option value="">Select a user</option>

        @foreach($users as $user)
            <option value="{{ $user->id }}"
                {{ old('user_id', $lecturer->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>

    @error('user_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Employee Number</label>
    <input type="text" name="employee_number" class="form-control"
           value="{{ old('employee_number', $lecturer->employee_number ?? '') }}"
           required>
    @error('employee_number')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Department</label>
    <input type="text" name="department" class="form-control"
           value="{{ old('department', $lecturer->department ?? '') }}"
           required>
    @error('department')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Academic Rank</label>
    <input type="text" name="academic_rank" class="form-control"
           value="{{ old('academic_rank', $lecturer->academic_rank ?? '') }}"
           required>
    @error('academic_rank')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Office Room</label>
    <input type="text" name="office_room" class="form-control"
           value="{{ old('office_room', $lecturer->office_room ?? '') }}">
    @error('office_room')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Profile Photo</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
    @error('photo')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    @if(isset($lecturer) && $lecturer->photo)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $lecturer->photo) }}"
                 width="100" alt="Current lecturer photo">
        </div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="isActivated" class="form-select" required>
        <option value="1"
            {{ old('isActivated', $lecturer->isActivated ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('isActivated', $lecturer->isActivated ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    @error('isActivated')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
