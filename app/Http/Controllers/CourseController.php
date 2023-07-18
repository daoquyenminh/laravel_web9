<?php

namespace App\Http\Controllers;


use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\DestroyCourseRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class CourseController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new  Course())->query();
        $routerName = Route::currentRouteName();
        $arr = explode('.', $routerName);
        $arr = array_map('ucfirst',$arr);
        $title = implode(' - ',$arr);
        View::share('title',$title);
    }


    public function index()
    {
        return  view('course.index');
    }
    public function api()
    {

        return DataTables::of($this->model)
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
    public function apiName(Request $request)
    {
        return $this->model
            ->where('name', 'like','%'.$request->get('q').'%' )
            ->get([
            'id',
            'name',
        ]);
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

        $this->model->create($request->validated());

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


    public function update(UpdateRequest $request, $courseId)
    {
//        $course->update(
//            $request->except([
//                '_token',
//                '_method',
//            ])
//        );
        $object = $this->model->find($courseId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('courses.index');
    }


    public function destroy(Request $request,  $courseId)
    {
        $this->model->find($courseId)->delete();
        $this->model->where('id',$courseId)->delete();

        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, status: 200);

        return redirect()->route('courses.index');

    }
}
