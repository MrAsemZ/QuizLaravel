
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecturers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lecturers</h2>
        <a href="{{ route('lecturers.create') }}" class="btn btn-primary">
            Add Lecturer
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Employee Number</th>
                        <th>Department</th>
                        <th>Academic Rank</th>
                        <th>Office</th>
                        <th>Courses</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($lecturers as $lecturer)
                        <tr>
                            <td>
                                @if($lecturer->photo)
                                    <img src="{{ asset('storage/' . $lecturer->photo) }}"
                                         width="45" height="45"
                                         class="rounded-circle"
                                         style="object-fit: cover;">
                                @else
                                    No photo
                                @endif
                            </td>
                            <td>{{ $lecturer->user->name }}</td>
                            <td>{{ $lecturer->user->email }}</td>
                            <td>{{ $lecturer->employee_number }}</td>
                            <td>{{ $lecturer->department }}</td>
                            <td>{{ $lecturer->academic_rank }}</td>
                            <td>{{ $lecturer->office_room }}</td>
                            <td>{{ $lecturer->courses_count }}</td>
                            <td>
                                <a href="{{ route('lecturers.show', $lecturer) }}"
                                   class="btn btn-info btn-sm">View</a>

                                <a href="{{ route('lecturers.edit', $lecturer) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('lecturers.destroy', $lecturer) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this lecturer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                No lecturers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
