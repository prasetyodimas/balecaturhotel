<?php date_default_timezone_set('Asia/jakarta');
//C.L.A.Y
// this function to create a random code shufle
function acakangkahuruf($panjang){
    $karakter ='12345678910ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string ='';

    for ($i=0; $i<$panjang; $i++) { 
        $pos = rand(0,strlen($karakter)- 1);
        $string .= $karakter{$pos};
    }
    return $string;
}
//fungsi date tanggal sekarang format (Y-m-d)
function datenow($tanggal_now){
   $tanggal_now   = date('Y-m-d');
   $konvert_date  = substr($tanggal_now, 8, 2);
   $konvert_month = getbulan(substr($tanggal_now, 5, 2));
   $konvert_year  = substr($tanggal_now, 0, 4);
   $fix_date = $konvert_date.' '.$konvert_month.' '.$konvert_year;
   return $fix_date;
}
//fungsi get tanggal indo (day - month - year)
function tgl_indo($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan   = getBulan(substr($tgl,5,2));
    $tahun   = substr($tgl,0,4);
    return $tanggal.' '.$bulan.' '.$tahun;
}
//function get time
function gettimer($potong_char){
    $remove_date = substr($potong_char, 10);
    return $remove_date;
}
//this function get year in now
function GetYear($vardate){
    $vardate = date("Y");
    return $vardate;
}
//this function remove time

//fungsi get bulan
function getBulan($bln){
    switch ($bln){
        case 1:
            return "Jan";
        break;
        case 2:
            return "Feb";
        break;
        case 3:
            return "Mar";
        break;
        case 4:
            return "April";
        break;
        case 5:
            return "Mei";
        break;
        case 6:
            return "Juni";
        break;
        case 7:
            return "Juli";
        break;
        case 8:
            return "August";
        break;
        case 9:
            return "Sept";
        break;
        case 10:
            return "Okto";
        break;
        case 11:
            return "Nov";
        break;
        case 12:
            return "Des";
    break;
    }

}
/* this function format uang Rp */
function formatuang($nilai_matauang){
    $var = number_format($nilai_matauang,0,",",".").',-';
    return $var;
}
/*this function remove tags */
function removetags($val){
    $remove = strip_tags($val);
    return $remove;
}
function removetimerset($potong_chartimer){
    $result = substr($potong_chartimer, 2,0);
    return  $result;
}
/* this function remove / slases */
function removeStripslases($var){
    $act = stripslashes($var);
    return $act;
}
//this function replacement character set
function preg_trim( $string, $pattern ) {
    $pattern = array( "/^" . $pattern . "*/", "/" . $pattern . "*$/" );
    return preg_replace( $pattern, "", $string );
    //output place echo preg_trim(variable, "[^a-zA-Z]");
}
//function check status user booking 
function statuspemesanan($args){
    if ($args=='BK') {
        $stat_reservation ='Waiting payment !';
        $color ='#000';
    }elseif($args=='KF'){
        $stat_reservation ='Waiting confrimation !';
        $color ='#f7c304';
    }elseif($args=='LS'){
        $stat_reservation ='Confrimation succes !';
        $color ='#01bf62';
    }elseif ($args=='CI') {
        $stat_reservation ='Checkin';
    }elseif ($args=='CO') {
        $stat_reservation ='Checkout';
    }elseif($args=='PP'){
        $stat_reservation ='Perpanjangan';
    }elseif($args=='RF'){
        $stat_reservation ='Refund';
        $color ='#ff8040';
    }
    return $stat_reservation;
}
//function color transaksi user booking
function colored_status($argue){
    if ($argue=='BK') {
        $color ='background:#ff0000';
    }elseif ($argue=='KF') {
        $color ='background:#f7c304';
    }elseif ($argue=='LS') {
        $color ='background:#00ff00';
    }elseif ($argue=='CI') {
        $color ='background:#0000ff';
    }elseif ($argue=='CO') {
        $color ='background:#ff00ff';
    }elseif ($argue=='PP') {
        $color ='background:#696969';
    }elseif ($argue=='RF') {
        $color ='background:#ff8040';
    }
    return $color;
}
// check jenis reservasinya
function StatusReservation($var){
    if ($var=='person') {
        $stat_reservation ='Reservasi Personal';
    }elseif ($var=='atasnama') {
        $stat_reservation ='Reservation Atasnama PT / CV (Instansi)';
    }
    return $stat_reservation;
}
//check status kamar
 function checkStatuskamar($argument){
    if ($argument==0){
        $status_kamar = 'kamar sedang dicheck';
    }elseif ($argument==1){
        $status_kamar = 'kamar sedang dibersikan';
    }elseif ($argument==2){
        $status_kamar = 'kamar siap digunakan';
    }elseif($argument==3){
        $status_kamar = 'kamar sedang terisi';
    }elseif($argument==4){
        $status_kamar = 'kamar dipesan oleh tamu';
    }
    return $status_kamar;
}
//check hak akses user
function HakaksesUser($args){
    if ($args==1) {
        $status_user = 'Admin Sistem';
    }elseif ($args==2) {
        $status_user = 'Receptionist';
    }elseif ($args==3) {
        $status_user = 'Pimpinan';
    }elseif ($args==4) {
        $status_user = 'Room Boy';
    }
    return $status_user;
}
//this function return from value percent
function percent($argue){
    
}
//function all countrys
$countries = array("AF" => "Afghanistan",
        "AX" => "Åland Islands",
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
        "CD" => "Congo, The Democratic Republic of The",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote D'ivoire",
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
        "GG" => "Guernsey",
        "GN" => "Guinea",
        "GW" => "Guinea-bissau",
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
        "IM" => "Isle of Man",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JE" => "Jersey",
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
        "MK" => "Macedonia, The Former Yugoslav Republic of",
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
        "ME" => "Montenegro",
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
        "VC" => "Saint Vincent and The Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "RS" => "Serbia",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and The South Sandwich Islands",
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
        "TL" => "Timor-leste",
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
        "VI" => "Virgin Islands, U.S.",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe");
/*
function validasipemesanan(){
	$in  = mktime(0,0,0),$inbulan,$intanggal,$intahun;
	$out = mktime(0,0,0),$outbulan,$outtanggal,$outtahun;
	$min = mktime(0,0,0,date("m"),date("d")+3,date("Y"));
	$interval = mktime(0,0,0,$inbulan,$intanggal+2,$intahun);
	$nowshow  = date("j F Y");
	$minshow  = date("j F Y",$min);

	// hari ini adalah tanggal dan waktu checkin minimun adlaah tanggal minshow silahkan kembali. 
	if ($in < $nowshow) {
		echo "Maaf sekarang tanggal $nowshow";
	//waktu checkin tidak boleh sama dengan atau lebih dari tgl checkout, silahkan kembali
	}elseif($in>=$out){
		echo "waktu checkin tidak boleh sama dengan atau lebih dari tgl checkout, silahkan kembali";
	}
	elseif ($interval > $out) {
		echo "jarak antara checkin dan checkout minimum 2 hari, silahkan kembali";
	}else{
		echo "terimakasih, kami akan memprosesnya!";


	}

}*/
?>

<!-- this function currency onkeyup in input text Rp... -->
<script type="text/javascript">
    function formatCurrency(num) {
        num = num.toString().replace(/\$|\,/g,'');
        if(isNaN(num))
            num = "0";
            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num*100+0.50000000001);
            cents = num%100;
            num = Math.floor(num/100).toString();
            
            if(cents<10)
                cents = "0" + cents;
                for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
                num = num.substring(0,num.length-(4*i+3))+'.'+
                num.substring(num.length-(4*i+3));

            return (((sign)?'':'-') + 'Rp' + num + ',' + '-'); //removes ,00 at behind currency
           /* return (((sign)?'':'-') + 'Rp' + num + ',' + cents);*/ // add ,00 at behind currency    
    }
</script>