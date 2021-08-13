<?php
function sendEmailVerificationCode($data,$code){
    Mail::send('admin.users.emails.email_verification', compact('data','code'), function ($message) use ($data) {
        $message->to($data['email']);
    });
}
?>