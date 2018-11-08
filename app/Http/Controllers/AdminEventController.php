<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Event;
use App\Media;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class AdminEventController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $user = Auth::user();
        if($user->is_admin==1) {
            $events = Event::orderBy("created_at","desc")->paginate(20);
        }
        else{
            $events = Event::where("user_created_id",$user->id)->orderBy("created_at","desc")->paginate(20);
        }
        return view('admin.eventlist', ["events"=>$events]);
    }

    public function create(Request $request)
    {
        $event = new Event;
        $event->id = 0;
        if(strtolower($request->getMethod())=="post") {
            return $this->_saveEvent($request, $event);
        }
        return $this->_createOrEditEvent($request, $event);
    }

    public function edit(Request $request, $id = 0)
    {
        $event = Event::findOrFail($id);
        if ( (!Auth::user()->is_admin==1) && Auth::user()->id != $event->user_created_id){
            abort(404, 'Access denied');
        }

        if(strtolower($request->getMethod())=="post") {
            return $this->_saveEvent($request, $event);
        }
        return $this->_createOrEditEvent($request, $event);
    }

    public function delete(Request $request, $id = 0)
    {
        $event = Event::findOrFail($id);
        if ( (!Auth::user()->is_admin==1) && Auth::user()->id != $event->user_created_id){
            abort(404, 'Access denied');
        }

        if($event->medias){
            foreach ($event->medias as $media){
                if (file_exists(public_path('upload')."/".$media->path)){
                    unlink(public_path('upload')."/".$media->path);
                }
                Media::destroy($media->id);
            }
        }
        Event::destroy($id);

        Session::flash('message', '削除しました');
        return Redirect::route("adminEventList");
    }

    public function medias($id){
        $event = Event::findOrFail($id);
        return response()->json($event->medias);
    }

    private function _createOrEditEvent(Request $request, Event $event){
        $categories = Category::all();
        $provinces = Province::all();
        return view('admin.event',
            [
                "categories" => $categories,
                "event" => $event,
                "provinces"=>$provinces
            ]
        );
    }

    private function _saveEvent(Request $request, Event $event){
        $isNewEvent = $event->id == 0;
        $event->shop_name = $request->input("shop_name", "");
        if($request->input("category", "")){
            $event->category_id = $request->input("category");
        }
        if($request->input("province_id", "")){
            $event->province_id = $request->input("province_id");
        }
        $event->position = $request->input("position", "");
        $event->position_detail = $request->input("position_detail", "");
        $event->position_master = $request->input("position_master", "");
        $event->zip01 = $request->input("zip01", "");
        $event->zip02 = $request->input("zip02", "");
        $event->google_map_link = $request->input("google_map_link", "");
        $event->comment = $request->input("comment", "");
        $event->phone = $request->input("phone", "");
        $event->phone2 = $request->input("phone2", "");
        $event->lat = $request->input("lat", "");
        $event->lat = floatval($event->lat);
        $event->long = $request->input("long", "");
        $event->long = floatval($event->long);
        if($request->input("open_date", "")){
            try{
                $event->open_date = $request->input("open_date");
            }catch (\Exception $exception){}
        } else{
            $event->open_date = null;
        }
        if($request->input("open_date2", "")){
            try{
                $event->open_date2 = $request->input("open_date2");
            }catch (\Exception $exception){}
        }else{
            $event->open_date2 = null;
        }
        if($request->input("open_date3", "")){
            try{
                $event->open_date3 = $request->input("open_date3");
            }catch (\Exception $exception){}
        }else{
            $event->open_date3 = null;
        }
        if($request->input("open_date4", "")){
            try{
                $event->open_date4 = $request->input("open_date4");
            }catch (\Exception $exception){}
        }else{
            $event->open_date4 = null;
        }
        if($request->input("open_date5", "")){
            try{
                $event->open_date5 = $request->input("open_date5");
            }catch (\Exception $exception){}
        }else{
            $event->open_date5 = null;
        }
        for($row=1; $row<=5; $row++){
            $colSuffix = "_".$row;
            $event[("comment_day_".$row)] = $request->input(("comment_day_".$row), "");
            for($col=1; $col<=5; $col++){
                $rowSuffix =  "_".$col;
                $event[("opentime_day_hour_start".$colSuffix.$rowSuffix)] = $request->input((("opentime_day_hour_start".$colSuffix.$rowSuffix)), "");
                $event[("opentime_day_minute_start".$colSuffix.$rowSuffix)] = $request->input((("opentime_day_minute_start".$colSuffix.$rowSuffix)), "");
                $event[("opentime_day_hour_end".$colSuffix.$rowSuffix)] = $request->input((("opentime_day_hour_end".$colSuffix.$rowSuffix)), "");
                $event[("opentime_day_minute_end".$colSuffix.$rowSuffix)] = $request->input((("opentime_day_minute_end".$colSuffix.$rowSuffix)), "");
            }
        }

        $user = Auth::user();
        if($isNewEvent){
            $event->user_created_id = $user->id;
        }

        $event->save();
        if($isNewEvent){
            $this->_uploadFiles($request, $event);
            Session::flash('message', 'イベントを作成しました');
            return Redirect::route("adminEventList");
        } else{
            //upload file
            $this->_uploadFiles($request, $event);
            Session::flash('message', 'イベントを編集しました');
            return Redirect::route("adminEventEdit",["id"=>$event->id]);
        }
    }

    private function _uploadFiles(Request $request, Event $event){
        $fileCount = $request->input("file_count", "0");
        $fileCount = intval($fileCount);
        if($fileCount > 0){
            for($i = 0; $i < $fileCount; $i++){
                if($request->file("upload_file_$i")){
                    $file = $request->file("upload_file_$i");
                    $mime = $file->getClientMimeType();
                    $name = $file->getClientOriginalName();
                    $path = $event->id."/".$name;
                    while (file_exists(public_path('upload')."/".$path)){
                        $name = "1-".$name;
                        $path = $event->id."/".$name;
                    }
                    Storage::disk("public")->put(
                        $path,
                        file_get_contents($file->getRealPath())
                    );
                    $media = new Media;
                    $media->type = strpos($mime, 'video') !== false ? "video" : "image";
                    $media->path = $path;
                    $media->event_id = $event->id;
                    $media->save();
                }
                if($request->input("delete_upload_file_$i", "")){
                    $deleteMedia = Media::find($request->input("delete_upload_file_$i"));
                    if($deleteMedia){
                        if (file_exists(public_path('upload')."/".$deleteMedia->path)){
                           unlink(public_path('upload')."/".$deleteMedia->path);
                        }
                        Media::destroy($deleteMedia->id);
                    }
                }
            }
        }
    }

}
