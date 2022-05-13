<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class SearchController extends Controller
{
    //private $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    public $baseapilink = "https://api.openweathermap.org/data/2.5/";
    public $apikey = "aeecbfb52f5012b90f927b695d2bcb64";
    //weather?q=&appid=&units
    public $places = array();

    public function deny()
    {
        return redirect()->route('home')->withErrors(['message' => 'invalid link']);
    }
    private function setPlaces()
    {
        if(empty($this->places))
        {
            $file = Storage::disk('local')->get('countries.json');
            $this->places = (array) json_decode($file);
            
        }

    }
    public function query(Request $request)
    {
        $result = array();
        if(count($this->places)==0)
            $this->setPlaces();

        switch($request->searchOption)
        {
            case"City":
                $result = $this->checkCity(trim($request->search));
                break;
            case"Country":
                $result = $this->checkCountry(trim($request->search));
                break;
            case"Zip Code":
                break;

        }
        
        return view("main.search",["sr" =>$result]);
  
    }

    private function checkCountry($str)
    {

		//$requestheaders = ['accept: application/json'];
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $requestheaders);
        $result = array();     
        //dd(mb_strlen(serialize($this->places), '8bit'));
        foreach($this->places as $c => $subc)
        {//for each country, we check if the input matches
            
            if( strpos($c,$str) )
            {
                
                //dd($subc);
                //if so we get the information
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $this->baseapilink."weather?q=".$c."&appid=".$this->apikey."&units=metric");               
                $lol = curl_exec($ch);
                $loldecoded = (array) json_decode($lol,true);
                curl_close($ch);
                if($loldecoded["cod"]==200)
                {
                    
                    $result[] = $loldecoded;
                }

            }
        }    
        return $result;
    }
    private function checkCity($str)
    {
        $result = array();
        foreach($this->places as $c=>$subc) 
        {                
            foreach($subc as $i=>$city)
            {
                
                if(strpos($city,$str))
                {
                    //($city);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, $this->baseapilink."weather?q=".$city."&appid=".$this->apikey."&units=metric");               
                    $lol = curl_exec($ch);
                    $loldecoded = (array) json_decode($lol,true); 
                    $loldecoded["country"]=$c;     
                    curl_close($ch);
                    if( array_key_exists('cod', $loldecoded) && $loldecoded["cod"]==200)
                    {   
                        $result[] = $loldecoded;
                    } 
                }
            }
        }
        return $result;
    }
    
}