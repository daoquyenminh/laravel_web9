<?php

namespace App\Http\Controllers;


use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\DestroyCourseRequest;


use Illuminate\Http\Request;
use     Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class CourseController extends Controller
{
    private string $title = 'Course';
    public function __construct()
    {
     View::share('title',$this->title);
    }


    public function index()
    {
        return  view('course.index');
    }
    public function api()
    {
        return DataTables::of(Course::query())
            ->editColumn('created_at',function ($object){
                return $object->year_created_at;
            })
            ->addColumn('edit',function ($object){

                return route('courses.edit',$object);
            })
            ->addColumn('destroy',function ($object){

                return route('courses.destroy',$object);
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(StoreRequest $request)
    {
//        $object = new Course();
//        $object->fill($request->validated());
//        $object->save();

        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        return view('course.edit',[
            'each'=>$course,
        ]);
    }


    public function update(UpdateRequest $request, Course $course)
    {
        $course->update(
            $request->except([
                '_token',
                '_method',
            ])
        );


        return redirect()->route('courses.index');
    }


    public function destroy(DestroyRequest $request, $course)
    {

        Course::destroy($course);

//        $arr['status'] = true;
//        $arr['message'] = '';

//        return response($arr, status: 200);
        return redirect()->route('course.index');

    }
}
