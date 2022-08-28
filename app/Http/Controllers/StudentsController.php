<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudenRequest;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Students;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', [
            'students' => Student::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudenRequest $request)
    {
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->city = $request->city;
        $student->state = $request->state;
        $student->country = $request->country;
        $student->address = $request->address;
        $student->status = $request->status ?? 0;

        $student->save();

        $subject = Subject::all();

        $marks = [];
        if ($request->english) {
            $marks[] = [
                'subject_id' => $subject->where('code', 'english')->value('id'),
                'marks' => $request->english ?? 0,
                'student_id' => $student->id
            ];
        }

        if ($request->maths) {

            $marks[] = [
                'subject_id' => $subject->where('code', 'maths')->value('id'),
                'marks' => $request->maths ?? 0,
                'student_id' => $student->id
            ];
        }

        if ($request->history) {

            $marks[] = [
                'subject_id' => $subject->where('code', 'history')->value('id'),
                'marks' => $request->history ?? 0,
                'student_id' => $student->id
            ];
        }

        $this->updateMarks($marks);

        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('view', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $mappeddata = [];

        foreach ($student->marks as $mark) {
            $mappeddata[$mark->subject->code] = $mark->marks;
        }

        return view('edit', [
            'student' => $student,
            'marks' => $mappeddata
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(StudenRequest $request, Student $student)
    {
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->city = $request->city;
        $student->state = $request->state;
        $student->country = $request->country;
        $student->address = $request->address;
        $student->status = $request->status ?? 0;

        $student->save();

        $subject = Subject::all();
        $marks = [];
        if ($request->english) {
            $subjectId = $subject->where('code', 'english')->value('id');
            $marks[] = [
                'id' => $student->marks()->where('subject_id', $subjectId)->where('student_id', $student->id)->value('id'),
                'subject_id' => $subjectId,
                'marks' => $request->english ?? 0,
                'student_id' => $student->id
            ];
        }

        if ($request->maths) {

            $subjectId = $subject->where('code', 'maths')->value('id');
            $marks[] = [
                'id' => $student->marks()->where('subject_id', $subjectId)->where('student_id', $student->id)->value('id'),
                'subject_id' => $subject->where('code', 'maths')->value('id'),
                'marks' => $request->maths ?? 0,
                'student_id' => $student->id
            ];
        }

        if ($request->history) {

            $subjectId = $subject->where('code', 'history')->value('id');
            $marks[] = [
                'id' => $student->marks()->where('subject_id', $subjectId)->where('student_id', $student->id)->value('id'),
                'subject_id' => $subject->where('code', 'history')->value('id'),
                'marks' => $request->history ?? 0,
                'student_id' => $student->id
            ];
        }

        $this->updateMarks($marks);

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect(route('students.index'));
    }

    public function changeStatus(Request $request)
    {
        $student = Student::find($request->id);
        $student->toggleStatus()->save();

        return $student;
    }

    private function updateMarks($studentMarks)
    {
        $marks = Mark::upsert(
            $studentMarks,
            ['id', 'student_id', 'subject_id'],
            ['marks']
        );

        return $marks;
    }
}
