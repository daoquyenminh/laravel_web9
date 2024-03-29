<?php

namespace App\Http\Controllers;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new  Student())->query();
        $routerName = Route::currentRouteName();
        $arr = explode('.', $routerName);
        $arr = array_map('ucfirst',$arr);

        $title = implode(' - ',$arr);
        $arrStudentStatus = StudentStatusEnum:: getArrayView();

        View::share('title',$title);
        View::share('arrStudentStatus',$arrStudentStatus);
    }



    public function index()
    {
        return view('student.index');
    }

    public function api()
    {

        return DataTables::of($this->model->with('course'))
            ->editColumn('gender',function ($object){
                return $object->gender_name;
            })
            ->editColumn('status',function ($object){
                return StudentStatusEnum::getKeyByValue($object->status) ;
            })
            ->addColumn('age',function ($object){
                return $object->age;
            })->addColumn('course_name',function ($object){
                return $object->course->name;
            })
            ->addColumn('edit',function ($object){

                return route('students.edit',$object);
            })
            ->addColumn('destroy',function ($object){

                return route('students.destroy',$object);
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    public function create()
    {

        $courses = Course::query()->get();

        return view('student.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('students.index')->with('success','Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
