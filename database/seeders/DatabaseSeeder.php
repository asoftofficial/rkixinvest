<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\GeneralSettings;
use App\Models\Homepage;
use App\Models\Packages;
use App\Models\Reward;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\packagesFactory;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $countries =array(
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, the Democratic Republic of the",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'Ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, the Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "CS" => "Serbia and Montenegro",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.s.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        );
        foreach($countries as $code => $country){
            Country::create([
                'code' => $code,
                'name' => $country
            ]);
        }

        //seeding for general settings
        GeneralSettings::create([
            'description' => 'Rkixinvest is a laravel based Investment managament system with multi level referral system',
            'email_template' => '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style type="text/css">
.ReadMsgBody { width: 100%; background-color: #ffffff; }
.ExternalClass { width: 100%; background-color: #ffffff; }
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
html { width: 100%; }
body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
table { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }
table table table { table-layout: auto; }
.yshortcuts a { border-bottom: none !important; }
img:hover { opacity: 0.9 !important; }
a { color: #0087ff; text-decoration: none; }
.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}
.btn-link a { color:#FFFFFF !important;}

@media only screen and (max-width: 480px) {
body { width: auto !important; }
*[class="table-inner"] { width: 90% !important; text-align: center !important; }
*[class="table-full"] { width: 100% !important; text-align: center !important; }
/* image */
img[class="img1"] { width: 100% !important; height: auto !important; }
}
</style>



  <table bgcolor="#414a51" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody><tr>
      <td height="50"></td>
    </tr>
    <tr>
      <td align="center" style="text-align:center;vertical-align:top;font-size:0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td align="center" width="600">
              <!--header-->
              <table class="table-inner" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                  <td bgcolor="#0087ff" style="border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;" align="center">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tbody><tr>
                        <td height="20"></td>
                      </tr>
                      <tr>
                        <td align="center" style="font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;">This is a System Generated Email</td>
                      </tr>
                      <tr>
                        <td height="20"></td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              <!--end header-->
              <table class="table-inner" width="95%" border="0" cellspacing="0" cellpadding="0">
                <tbody><tr>
                  <td bgcolor="#FFFFFF" align="center" style="text-align:center;vertical-align:top;font-size:0;">
                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tbody><tr>
                        <td height="35"></td>
                      </tr>
                      <!--logo-->
                      <tr>
                        <td align="center" style="vertical-align:top;font-size:0;">
                          <a href="#">
                            <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="https://i.imgur.com/Z1qtvtV.png" alt="img">
                          </a>
                        </td>
                      </tr>
                      <!--end logo-->
                      <tr>
                        <td height="40"></td>
                      </tr>
                      <!--headline-->
                      <tr>
                        <td align="center" style="font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;">Hello {{fullname}} ({{username}})</td>
                      </tr>
                      <!--end headline-->
                      <tr>
                        <td align="center" style="text-align:center;vertical-align:top;font-size:0;">
                          <table width="40" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                              <td height="20" style=" border-bottom:3px solid #0087ff;"></td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td height="20"></td>
                      </tr>
                      <!--content-->
                      <tr>
                        <td align="left" style="font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;">{{message}}</td>
                      </tr>
                      <!--end content-->
                      <tr>
                        <td height="40"></td>
                      </tr>

                    </tbody></table>
                  </td>
                </tr>
                <tr>
                  <td height="45" align="center" bgcolor="#f4f4f4" style="border-bottom-left-radius:6px;border-bottom-right-radius:6px;">
                    <table align="center" width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tbody><tr>
                        <td height="10"></td>
                      </tr>
                      <!--preference-->
                      <tr>
                        <td class="preference-link" align="center" style="font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;">
                          © 2021 <a href="#">Website Name</a> . All Rights Reserved.
                        </td>
                      </tr>
                      <!--end preference-->
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
    <tr>
      <td height="60"></td>
    </tr>
  </tbody></table>'
        ]);

        //seeding for about us page and how-to page
        Homepage::create([
             'section_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fringilla, ipsum quis pellentesque molestie, ligula neque pretium ipsum, sit amet facilisis odio enim eu mauris.',
              'step_content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi illo, perspiciatis fugit blanditiis fuga quas quo laboriosam alias sequi rem, id tempora, error rerum. Fugiat beatae sint repudiandae ab blanditiis?',
        ]);

        //seeding for sociallinks page
        SocialLink::create([
             'facebook' => 'https://www.facebook.com/Rkixtech',
        ]);

        //seeding for Testimonial model
        Testimonial::create([
             'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,',
        ]);

        //seeding for reward
        Reward::create([
            'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.',
        ]);

        //Slider seeding
        Slider::create([
            'slider_content' => 'Recording Your Business Finances Effortlessly.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
        ]);
        // seeding for user model
        User::create([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "username" => "admin",
            "email" => "admin@autocar.com",
            "password" => Hash::make('password'),
            "type" => 3,
        ]);


    }
}
