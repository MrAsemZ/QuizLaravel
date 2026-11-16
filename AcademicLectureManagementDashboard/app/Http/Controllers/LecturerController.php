<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
    // Display all active lecturers
    public function index()
    {
        $lecturers = Lecturer::with('user')
            ->withCount('courses')
            ->latest()
            ->get();

        return view('lecturers.index', compact('lecturers'));
    }

    // Display the create form
    public function create()
    {
        $users = User::whereDoesntHave('lecturer')->get();

        return view('lecturers.create', compact('users'));
    }

    // Save a new lecturer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:lecturers,user_id',
            'employee_number' => 'required|string|unique:lecturers,employee_number',
            'department' => 'required|string|max:255',
            'academic_rank' => 'required|string|max:255',
            'office_room' => 'nullable|string|max:255',
            'isActivated' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('lecturers', 'public');
        }

        Lecturer::create($validated);

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer created successfully.');
    }

    // Display one lecturer
    public function show(Lecturer $lecturer)
    {
        $lecturer->load('user', 'courses');

        return view('lecturers.show', compact('lecturer'));
    }

    // Display the edit form
    public function edit(Lecturer $lecturer)
    {
        $users = User::whereDoesntHave('lecturer')
            ->orWhere('id', $lecturer->user_id)
            ->get();

        return view('lecturers.edit', compact('lecturer', 'users'));
    }

    // Update an existing lecturer
    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('lecturers', 'user_id')->ignore($lecturer->id),
            ],
            'employee_number' => [
                'required',
                'string',
                Rule::unique('lecturers', 'employee_number')->ignore($lecturer->id),
            ],
            'department' => 'required|string|max:255',
            'academic_rank' => 'required|string|max:255',
            'office_room' => 'nullable|string|max:255',
            'isActivated' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            if ($lecturer->photo) {
                Storage::disk('public')->delete($lecturer->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('lecturers', 'public');
        }

        $lecturer->update($validated);

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer updated successfully.');
    }

    // Soft-delete a lecturer
    public function destroy(Lecturer $lecturer)
    {
        if ($lecturer->courses()->exists()) {
            return redirect()->route('lecturers.index')
                ->with('error', 'Cannot delete this lecturer because they have assigned courses.');
        }

        $lecturer->delete();

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer deleted successfully.');
    }
}
