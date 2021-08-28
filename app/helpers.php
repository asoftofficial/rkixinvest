<?php
//Send Email Verification code

use App\Models\Transaction;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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
function getdays($now=NULL,$enddate=NULL,$duration,$type){
    switch ($type) {
        case 'day':
            $enddate->addDays($duration);
            break;
        case 'week':
            $enddate->addWeeks($duration);
            break;
        case 'month':
            $enddate->addMonths($duration);
            break;
        case 'year':
            $enddate->addYears($duration);
            break;
        default:
            $enddate->addDays($duration);
            break;
    }
    return $enddate;
}
function get_percentage($total, $number)
{
  if ( $total > 0 ) {
   return round(($number * 100) / $total, 2);
  } else {
    return 0;
  }
}

function getImage($image,$size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image',$size);
    }
    return asset('assets/images/default.png');
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function getIpInfo()
{
    $ip = $_SERVER["REMOTE_ADDR"];

    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);


    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}

//moveable
function osBrowser(){
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $osPlatform = "Unknown OS Platform";
    $osArray = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $osPlatform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browserArray = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $osPlatform;
    $data['browser'] = $browser;

    return $data;
}

function imagePath()
{
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'assets/images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
        'size' => '36x36',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['profile'] = [
        'user'=> [
            'path'=>'assets/images/user/profile',
            'size'=>'350x300'
        ],
        'admin'=> [
            'path'=>'assets/admin/images/profile',
            'size'=>'400x400'
        ]
    ];
    return $data;
}

function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}
function sendEmail($user, $type = null, $shortCodes = [])
{
    $general = \App\Models\GeneralSettings::first();

    $emailTemplate = \App\Models\EmailTemplate::where('action', $type)->where('email_status', 1)->first();
    if (!$emailTemplate) {
        return;
    }


    $message = shortCodeReplacer("{{fullname}}", $user->fullname, $general->email_template);
    $message = shortCodeReplacer("{{username}}", $user->username, $message);
    $message = shortCodeReplacer("{{message}}", $emailTemplate->email_body, $message);

    if (empty($message)) {
        $message = $emailTemplate->email_body;
    }

    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{' . $code . '}}', $value, $message);
    }

    $config = $general->mail_config;

    $emailLog = new \App\Models\EmailLog();
    $emailLog->user_id = $user->id;
    $emailLog->mail_sender = $config->name;
    $emailLog->email_from = $general->sitename.' '.$general->email_from;
    $emailLog->email_to = $user->email;
    $emailLog->subject = $emailTemplate->subj;
    $emailLog->message = $message;
    $emailLog->save();


    if ($config->name == 'php') {
        sendPhpMail($user->email, $user->username,$emailTemplate->subj, $message, $general);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $user->email, $user->username, $emailTemplate->subj, $message,$general);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $user->email, $user->username, $emailTemplate->subj, $message,$general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $user->email, $user->username, $emailTemplate->subj, $message,$general);
    }
}

function sendPhpMail($email, $name, $subject, $message,$general,$contact = false)
{
    if ($contact) {
        $headers = "From: $name <$email> \r\n";
        $headers .= "Reply-To: $name <$email> \r\n";
        $email = $general->email_from;
    }else{
        $headers = "From: $general->sitename <$general->email_from> \r\n";
        $headers .= "Reply-To: $general->sitename <$general->email_from> \r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($email, $subject, $message, $headers);
}


function sendSmtpMail($config, $receiver_email, $receiver_name, $subject, $message,$general,$contact = false)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = $config->host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $config->username;
        $mail->Password   = $config->password;
        if ($config->enc == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        }else{
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port       = $config->port;
        $mail->CharSet = 'UTF-8';
        //Recipients
        if ($contact) {
            $mail->setFrom($receiver_email, $receiver_name);
            $mail->addAddress($general->email_from, $general->sitename);
            $mail->addReplyTo($receiver_email, $receiver_name);
        }else{
            $mail->setFrom($general->email_from, $general->sitename);
            $mail->addAddress($receiver_email, $receiver_name);
            $mail->addReplyTo($general->email_from, $general->sitename);
        }
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendSendGridMail($config, $receiver_email, $receiver_name, $subject, $message,$general,$contact = false)
{
    $sendgridMail = new \SendGrid\Mail\Mail();
    if ($contact) {
        $sendgridMail->setFrom($receiver_email, $receiver_name);
        $sendgridMail->setSubject($subject);
        $sendgridMail->addTo($general->email_from, $general->web_title);
    }else{
        $sendgridMail->setFrom($general->email_from, $general->web_title);
        $sendgridMail->setSubject($subject);
        $sendgridMail->addTo($receiver_email, $receiver_name);
    }

    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendMailjetMail($config, $receiver_email, $receiver_name, $subject, $message,$general,$contact = false)
{
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    if ($contact) {
        $fromMail = $receiver_email;
        $fromName = $receiver_name;
        $toMail = $general->email_from;
        $toName = $general->web_title;
    }else{
        $toMail = $receiver_email;
        $toName = $receiver_name;
        $fromMail = $general->email_from;
        $fromName = $general->web_title;
    }
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $fromMail,
                    'Name' => $fromName,
                ],
                'To' => [
                    [
                        'Email' => $toMail,
                        'Name' => $toName,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}

function sendGeneralEmail($email, $subject, $message, $receiver_name = '')
{

    $general = \App\Models\GeneralSettings::first();


    if (!$general->email_from) {
        return;
    }

    $message = shortCodeReplacer("{{message}}", $message, $general->email_template);
    $message = shortCodeReplacer("{{fullname}}", $receiver_name, $message);
    $message = shortCodeReplacer("{{username}}", $email, $message);

    $config = $general->email_config;

    if ($config->name == 'php') {
        sendPhpMail($email, $receiver_name, $subject, $message, $general);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $email, $receiver_name, $subject, $message, $general);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $email, $receiver_name,$subject, $message,$general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $email, $receiver_name,$subject, $message, $general);
    }
}

?>
