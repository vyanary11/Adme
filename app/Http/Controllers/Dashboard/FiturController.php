<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Feature;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception\InvalidOrderException;

class FiturController extends Controller
{
    public function dataTableServerSide()
    {
        $data = Feature::select('*');
        if(request()->order[0]['column']==1){
            $data->orderBy('id','desc');
        }
        return Datatables::eloquent($data)
            ->addColumn('id', function ($data){
                return '<div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" name="id" value="'.$data->id.'" class="custom-control-input" id="checkbox-'.$data->id.'">
                            <label for="checkbox-'.$data->id.'" class="custom-control-label">&nbsp;</label>
                        </div>';
            })
            ->addIndexColumn()
            ->editColumn('name', function($data){
                return '<i class="'.$data->icon.'"></i>'.'  '.$data->name;
            })
            ->addColumn('action', function ($data) {
                $funsi_delete="deleteData($data->id,'$data->name')";
                $button = [
                    '<button data-original-title="Edit" onclick="editFormModal('.$data->id.')"
                        class="btn btn-sm btn-warning m-1" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-edit"></i>
                    </button>',
                    '<button data-original-title="Hapus" onClick="'.$funsi_delete.'"
                        class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-trash"></i>
                    </button>',
                ];
                return implode("",$button);
            })
            ->rawColumns(['id','name','action'])
            ->toJson();
    }

    public function index()
    {
        return view('app.admin.fitur.index');
    }

    public function show($id)
    {
        return response()->json(Feature::findOrFail($id));
    }

    public function store(Request $request)
    {
        $fitur = Feature::create([
            'name'          => $request->name,
            'icon'          => $request->icon,
            'description'   => $request->description,
        ]);
        if($fitur){
            return response()->json([
                'message'   => "Fitur baru telah ditambahkan!!"
            ],200);
        }else{
            return response()->json([
                'message'   => "bad request"
            ],400);
        }
    }

    public function update(Request $request, $id)
    {
        $fitur              = Feature::findOrFail($id);
        $fitur->name        = $request->name;
        $fitur->icon        = $request->icon;
        $fitur->description = $request->description;

        if($fitur->save()){
            return response()->json([
                'message'   => "Fitur ".$fitur->name." telah diperbarui!!"
            ],200);
        }else{
            return response()->json([
                'message'   => "bad request"
            ],400);
        }
    }

    public function delete(Request $request){
        if(Feature::findOrFail($request->id)->delete()){
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
        if(Feature::whereIn('id', $data_id)->update(['status'=>$request->status])){
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
        if(Feature::whereIn('id', $data_id)->delete()){
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
