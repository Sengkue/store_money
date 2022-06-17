<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spend;
use Intervention\Image\Facades\Image;
use App\Models\User;

class SpendController extends Controller
{
    //
    // public function index(){

    //    $spend = Spend::orderBy('created_at','asc')->get();
    //     return $spend;
        
    // }
    public function index(){

        $Search = \Request::get('search'); // ຄົ້ນຫາ
       // $page = \Request::get('page'); // ເກັບຂໍ້ມູນໜ້າ ທີ່ຖຶກສົ່ງມາ

        $spend = Spend::where("describe","LIKE","%{$Search}%")
        ->orWhere("whose","LIKE","%{$Search}%")
        ->orderBy('created_at','desc')
        ->paginate(15)
        ->toArray();
        //->get();

         return array_reverse($spend);

        // $spend = Spend::orderBy('created_at','asc')->get();
        // return $spend;
        
        
    }


     
    public function add(Request $request){

        try {
            if($request->file('file')){
                $upload_path = "assets/img";
                $generate_new_img = 'spend-'.time().'.'.$request->file->getClientOriginalExtension();
                $image = $request->file('file');
                $img = Image::make($image->getRealpath());
                $img->resize(
                    800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
                $img->save($upload_path.'/'.$generate_new_img);  // ບັນທຶກຂື້ນ Server

            } else {
                $generate_new_img = '';
            }

                $spend = new Spend();
                $spend->describe = $request->describe;
                $spend->money = $request->money;
                $spend->whose = $request->whose;
               // $spend->date = $request->date;
                $spend->image = $generate_new_img;
                $spend->save();
               

                $success = true;
                $message = "ບັນທຶກຂໍ້ມູນສຳເລັດ!";

        
        } catch (\Illuminate\Database\QueryException $ex) {
            //throw $th;
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);

    }

    // public function edit($id){
    //     $spend = Spend::find($id);
    //     return response()->json($response);
    // }
    public function edit($id){

        $spend = Spend::find($id);
        return response()->json($spend);
    }

    // update <========================
    public function update($id, Request $request){
        $spend = Spend::find($id);
        // check image
        if($request->file('file')){ // ມີການອັບໂຫລດຮູບພາບ

            $upload_path = 'assets/img';
            
            /// ກວດຊອບ ລຶບໄຟລ໌ຮູບເກົ່າ
                if($spend->image!='' && $spend->image!=null){
                    if(file_exists('assets/img/'.$spend->image)){ // ກວດຊອບວ່າໄຟລ໌ມີຈິງໃນ Server ຫຼືບໍ່
                        unlink('assets/img/'.$spend->image); // ທຳການລຶບ
                    }
                }

                $generate_new_img = 'spend-'.time().'.'.$request->file->getClientOriginalExtension();
                $image = $request->file('file');
                $img = Image::make($image->getRealpath());
                $img->resize(
                    800, null, function($constraint){
                        $constraint->aspectRatio();
                    });
                $img->save($upload_path.'/'.$generate_new_img); 
                

                $spend->update([                    
                    'describe'=> $request->describe,
                     'money'=> $request->money,
                    'whose'=> $request->whose,
                    'image' => $generate_new_img,
                ]);


        } else { // ເງື່ອນໄຂ ບໍ່ໄດ້ອັບໂຫລກຮູບພາບ

            $spend-> update([
                'describe'=> $request->describe,
                'money'=> $request->money,
                'whose'=> $request->whose,
    
            ]);

        }



        
    }

    public function delete($id){
        $spend = Spend::find($id);
        $spend->delete();
    }
}
