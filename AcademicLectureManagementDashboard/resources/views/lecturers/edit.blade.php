
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Lecturer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">

    <h2 class="mb-4">Edit Lecturer</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            Please correct the errors below.
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('lecturers.update', $lecturer) }}"
                  method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('lecturers._form')

                <button type="submit" class="btn btn-primary">
                    Update Lecturer
                </button>

                <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
