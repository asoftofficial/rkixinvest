<?php
//Send Email Verification code

use App\Models\Transaction;

function sendEmailVerificationCode($data,$code){
    Mail::send('admin.users.emails.email_verification', compact('data','code'), function ($message) use ($data) {
        $message->to($data['email']);
    });
}
//Get Parent
function getparent($id)
{
    $user = App\Models\User::find($id);
    if(!empty($user)){
        $parent = App\Models\Referral::where(['ref_id'=>$user->id,'level'=>1])->first();
        if(!empty($parent)){
            return $parent->user_id;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function trx($id,$amount,$type,$desc)
{
    $trx = Transaction::create([
            'user_id' => $id,
            'amount' => $amount,
            'type' => $type,
            'description' => $desc
        ]);
        return $trx;
}
?>
