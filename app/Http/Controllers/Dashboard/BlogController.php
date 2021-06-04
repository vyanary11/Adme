<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function dataTableServerSide()
    {
        $data = Blog::with('admin')->select('blogs.*');
        if(request()->status!=null){
            $data->where('status', request()->status);
        }
        return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('id', function ($data){
                return '<div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" name="id" value="'.$data->id.'" class="custom-control-input" id="checkbox-'.$data->id.'">
                            <label style="cursor: pointer" for="checkbox-'.$data->id.'" class="custom-control-label">&nbsp;</label>
                        </div>';
            })
            ->addColumn('author', function ($data){
                return $data->admin()->first()->first_name." ".$data->admin()->first()->last_name;
            })
            ->editColumn('status', function ($data){
                if($data->status=="published"){
                    $status = '<div class="badge badge-primary">Published</div>';
                }else if($data->status=="draft"){
                    $status = '<div class="badge badge-warning">Draft</div>';
                }else{
                    $status = '<div class="badge badge-secondary">Archived</div>';
                }
                return $status;
            })
            ->editColumn('created_at', function ($data){
                return date("d F Y H:i:s", strtotime($data->created_at));
            })
            ->editColumn('updated_at', function ($data){
                return date("d F Y H:i:s", strtotime($data->updated_at));
            })
            ->addColumn('action', function ($data) {
                $funsi_delete="deleteData($data->id,'$data->name')";
                $button = [
                    '<a data-original-title="Edit" href="'.route("admin.blog.update-show", ['id'=>$data->id]).'"
                        class="btn btn-sm btn-warning m-1" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-edit"></i>
                    </a>',
                    '<div class="dropdown d-inline">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item has-icon" onclick="deleteOrUpdateSelected('.$data->id.',`draft`)" href="#"><i class="far fa-clock"></i> Draft</a>
                            <a class="dropdown-item has-icon" onclick="deleteOrUpdateSelected('.$data->id.',`published`)" href="#"><i class="far fa-file"></i> Publish</a>
                            <a class="dropdown-item has-icon" onclick="deleteOrUpdateSelected('.$data->id.',`archived`)" href="#"><i class="fas fa-archive"></i> Archive</a>
                            <a class="dropdown-item has-icon" onClick="'.$funsi_delete.'" href="#"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                    </div>',
                ];
                return implode("",$button);
            })
            ->rawColumns(['id','action','author','status','created_at','updated_at'])
            ->toJson();
    }

    public function countData()
    {
        return response()->json([
            'all' => Blog::count(),
            'draft' => Blog::where('status','draft')->count(),
            'published' => Blog::where('status','published')->count(),
            'archived' => Blog::where('status','archived')->count(),
        ], 200);
    }

    public function index()
    {
        return view('app.admin.blog.index');
    }

    public function create()
    {
        $data = [
            'edit'  => false
        ];
        return view('app.admin.blog.form', $data);
    }

    public function show($id)
    {
        $data = [
            'edit'  => true,
            'blog'  => Blog::findOrFail($id)
        ];
        return view('app.admin.blog.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'mimes:jpeg,png,jpg,gif|max:5052',
        ]);
        $extension = $request->thumbnail->extension();
        $filename = Str::random(10).".".$extension;
        $request->thumbnail->storeAs('/public/upload/blog', $filename);
        $admin = Admin::find(Auth::user()->id);
        $blog = Blog::create([
            'admin_id'  => $admin->id,
            'title'     => $request->title,
            'tags'      => $request->tags,
            'slug'      => Str::slug($request->title),
            'content'   => $request->content,
            'thumbnail' => $filename,
            'status'    => $request->status
        ]);
        if($blog){
            return redirect(route('admin.blog'))->with('message', [
                'status'    => 'success',
                'message'   => 'New Blog telah ditambahkan!'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $blog                = Blog::findOrFail($id);
        if($request->thumbnail!=null){
            $request->validate([
                'thumbnail' => 'mimes:jpeg,png,jpg,gif|max:5052',
            ]);
            $extension = $request->thumbnail->extension();
            $filename = Str::random(10).".".$extension;
            $request->thumbnail->storeAs('/public/upload/blog', $filename);
            $blog->thumbnail = $filename;
        }
        $blog->title         = $request->title;
        $blog->tags          = $request->tags;
        $blog->slug          = Str::slug($request->title);
        $blog->content       = $request->content;
        $blog->status        = $request->status;

        if($blog->save()){
            return redirect(route('admin.blog'))->with('message', [
                'status'    => 'success',
                'message'   => 'Blog '.$request->title.' telah diperbarui!!'
            ]);
        }
    }

    public function delete(Request $request){
        if(Blog::findOrFail($request->id)->delete()){
            return response()->json([
                'message'   => "success"
            ],200);
        }else{
            return response()->json([
                'message'   => "something error"
            ],400);
        }
    }

    public function updateSelected(Request $request)
    {
        $data_id = explode(",", $request->id);
        if(Blog::whereIn('id', $data_id)->update(['status'=>$request->status])){
            return response()->json([
                'message'   => "success"
            ],200);
        }else{
            return response()->json([
                'message'   => "something error"
            ],400);
        }
    }

    public function deleteSelected(Request $request)
    {
        $data_id = explode(",", $request->id);
        if(Blog::whereIn('id', $data_id)->delete()){
            return response()->json([
                'message'   => "success"
            ],200);
        }else{
            return response()->json([
                'message'   => "something error"
            ],400);
        }
    }
}
