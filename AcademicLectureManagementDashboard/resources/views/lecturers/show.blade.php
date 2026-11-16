
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecturer Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lecturer Details</h2>
        <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            @if($lecturer->photo)
                <img src="{{ asset('storage/' . $lecturer->photo) }}"
                     width="120" height="120"
                     class="rounded-circle mb-3"
                     style="object-fit: cover;">
            @endif

            <h4>{{ $lecturer->user->name }}</h4>
            <p>{{ $lecturer->user->email }}</p>

            <hr>

            <p><strong>Employee Number:</strong> {{ $lecturer->employee_number }}</p>
            <p><strong>Department:</strong> {{ $lecturer->department }}</p>
            <p><strong>Academic Rank:</strong> {{ $lecturer->academic_rank }}</p>
            <p><strong>Office Room:</strong> {{ $lecturer->office_room }}</p>
            <p><strong>Status:</strong> {{ $lecturer->isActivated ? 'Active' : 'Inactive' }}</p>

            <hr>

            <h5>Assigned Courses</h5>

            @forelse($lecturer->courses as $course)
                <p>{{ $course->course_code }} - {{ $course->title }}</p>
            @empty
                <p>No courses assigned to this lecturer.</p>
            @endforelse

            <a href="{{ route('lecturers.edit', $lecturer) }}"
               class="btn btn-warning mt-3">
                Edit Lecturer
            </a>

        </div>
    </div>

</div>

</body>
</html>
