<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller{

    function sendMessage() {
        $content = array(
            "en" => 'Spanish Message',
            "en" => 'Cuerpo de la notificacion ira aqui',  
        );
      
        $fields = array(
            'app_id' => "021dd639-ca13-4d16-8724-bc2208df1507",
            'included_segments' => array(
                'All'
            ),
            'headings' => array("en" => "Este es el titulo de la notificacion"),
            'url' => 'https://www.google.com.sv/',
            'big_picture' => 'https://imagenes247.com/wp-content/uploads/2018/11/tarjetas-de-amor-gratis.jpg',
            'large_icon' => 'https://imagenes247.com/wp-content/uploads/2018/11/tarjetas-de-amor-gratis.jpg',
            'contents' => $content,
            
        );
        
        $fields = json_encode($fields);
    
        print("\nJSON sent:\n");
        echo($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NjYxMDgxYWMtMjJjZC00Njg5LTk5ZWEtMjExNzk1YTEzN2Jl'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    function testSendNotification(){
        $response = sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode($return);
        
        $data = json_decode($response, true);
        print_r($data);
        $id = $data['id'];
        print_r($id);
        
        print("\n\nJSON received:\n");
        print($return);
        print("\n");

    }
   

}
