<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationDetail;
use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{
    function InsertNotification(Request $req)
    {
        $author_id   = $req->author_id;
        $author_role   = $req->author_role;
        $author_name = $req->author_name;
        $msg_title   = $req->msg_title;
        $msg_body    = $req->msg_body;
        date_default_timezone_set('Asia/Dhaka');
        $create_date = date('Y-m-d');
        $create_time = date('h:i:sa');

        if($author_role === 'admin')
        {
            $lastID = Notification::insertGetId([
                    'author_id'   => $author_id,
                    'author_name' => $author_name,
                    'msg_title'   => $msg_title,
                    'msg_body'    => $msg_body,
                    'create_date' => $create_date,
                    'create_time' => $create_time,
            ]);

            if($lastID)
            {
                $users = User::where('role', 'user')->get();
                foreach($users as $user)
                {
                        $insertedAll = NotificationDetail::insert([
                        'notification_id' => $lastID,
                        'user_id' => $user->id,
                        'status' => 'Latest',
                        'create_date' => $create_date,
                        'create_time' => $create_time,

                    ]);
                }
                if($insertedAll)
                {
                    return 1;
                }
                else{
                    return 0;
                }
            }
        }
        else{
            $lastID = Notification::insertGetId([
                    'author_id'   => $author_id,
                    'author_name' => $author_name,
                    'msg_title'   => $msg_title,
                    'msg_body'    => $msg_body,
                    'create_date' => $create_date,
                    'create_time' => $create_time,
            ]);

            if($lastID)
            {
                        $admin = User::where('role', 'admin')->first();
                        $inserted = NotificationDetail::insert([
                        'notification_id' => $lastID,
                        'user_id' => $admin->id,
                        'status' => 'Latest',
                        'create_date' => $create_date,
                        'create_time' => $create_time,

                    ]);
                }
                if($inserted)
                {
                    return 1;
                }
                else{
                    return 0;
                }
            
        }

    }

    function GetSelfCreatedNotification(Request $req)
    {
        $user_id = $req->user_id;
        $data = DB::table('notifications')
                ->join('notification_details', 'notifications.id', 'notification_details.notification_id')
                ->where('notifications.author_id', $user_id)
                ->select('notifications.*', 'notification_details.status')
                ->orderBy('notifications.id', 'desc')
                ->get();
        return $data;
        
    }

    function GetAdminNotificationByUser(Request $req)
    {
        $user_id = $req->user_id;
        $data = DB::table('notification_details')
                ->join('notifications', 'notification_details.notification_id', 'notifications.id')
                ->where('notification_details.user_id', $user_id)
                ->select('notification_details.*', 'notifications.author_name', 'notifications.msg_title', 'notifications.msg_body')
                ->orderBy('notification_details.id', 'desc')
                ->get();
        return $data;
    }
    
    function CountLastestNotification(Request $req)
    {
        $user_id = $req->user_id;
        $count_latest_row = NotificationDetail::where(['user_id'=>$user_id, 'status'=>'Latest'])->count();
        return $count_latest_row;

    }

    function SetUnreadStatus(Request $req)
    {
        $user_id = $req->user_id;
        $unreadStatus =  NotificationDetail::where(['user_id'=>$user_id, 'status'=>'Latest'])->update(['status' => 'Unread']);
        return $unreadStatus;
    }
    function SetReadStatus(Request $req)
    {
        $user_id = $req->user_id;
        $notification_id = $req->notification_id;
        $unreadStatus =  NotificationDetail::where(['user_id'=>$user_id, 'notification_id'=>$notification_id])->update(['status' => 'Read']);
        return $unreadStatus;
    }
}
