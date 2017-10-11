<?php 
/**
* International Data
*/

namespace Jabali\Lib;

class Uniform {

    //  function timezone_list() {
    // static $timezones = null;

    // if ($timezones === null) {
    //     $timezones = [];
    //     $offsets = [];
    //     $now = new DateTime('now', new DateTimeZone('UTC'));

    //     foreach (DateTimeZone::listIdentifiers() as $timezone) {
    //         $now->setTimezone(new DateTimeZone($timezone));
    //         $offsets[] = $offset = $now->getOffset();
    //         $timezones[$timezone] = '(' . format_GMT_offset($offset) . ') ' . format_timezone_name($timezone);
    //     }

    //     array_multisort($offsets, $timezones);
    //  }

    //      return $timezones;
    //  }

    //  function format_GMT_offset($offset) {
    //      $hours = intval($offset / 3600);
    //      $minutes = abs(intval($offset % 3600 / 60));
    //      return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    //  }

    //  function format_timezone_name($name) {
    //      $name = str_replace('/', ', ', $name);
    //      $name = str_replace('_', ' ', $name);
    //      $name = str_replace('St ', 'St. ', $name);
    //      return $name;
    //  }

  function timeZone() { ?>
    <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
      <i class="material-icons prefix">schedule</i>
      <input class="mdl-textfield__input" type="text" id="timezones" name="timezone" readonly tabIndex="-1" value="<?php showOption( 'timezone' )?>">
       <ul for="timezones" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php foreach (timeZones() as $t ) { ?>
          
        <li class="mdl-menu__item" data-val="<?php _show_( $t['zone'] ); ?>"><?php print /* $t['diff_from_GMT'] . ' - ' . */ $t['zone'] ?></li>
      <?php } ?>
      </ul>
      <label for="timezones">Timezone</label>
    </div><?php
      }

  function continents() {
    return array(
      'AF' => array(
        'name'      => __( 'Africa' ),
        'countries' => array(
          'AO',
          'BF',
          'BI',
          'BJ',
          'BW',
          'CD',
          'CF',
          'CG',
          'CI',
          'CM',
          'CV',
          'DJ',
          'DZ',
          'EG',
          'EH',
          'ER',
          'ET',
          'GA',
          'GH',
          'GM',
          'GN',
          'GQ',
          'GW',
          'KE',
          'KM',
          'LR',
          'LS',
          'LY',
          'MA',
          'MG',
          'ML',
          'MR',
          'MU',
          'MW',
          'MZ',
          'NA',
          'NE',
          'NG',
          'RE',
          'RW',
          'SC',
          'SD',
          'SH',
          'SL',
          'SN',
          'SO',
          'SS',
          'ST',
          'SZ',
          'TD',
          'TG',
          'TN',
          'TZ',
          'UG',
          'YT',
          'ZA',
          'ZM',
          'ZW',
        ),
      ),
      'AN' => array(
        'name'      => __( 'Antarctica' ),
        'countries' => array(
          'AQ',
          'BV',
          'GS',
          'HM',
          'TF',
        ),
      ),
      'AS' => array(
        'name'      => __( 'Asia' ),
        'countries' => array(
          'AE',
          'AF',
          'AM',
          'AZ',
          'BD',
          'BH',
          'BN',
          'BT',
          'CC',
          'CN',
          'CX',
          'CY',
          'GE',
          'HK',
          'ID',
          'IL',
          'IN',
          'IO',
          'IQ',
          'IR',
          'JO',
          'JP',
          'KG',
          'KH',
          'KP',
          'KR',
          'KW',
          'KZ',
          'LA',
          'LB',
          'LK',
          'MM',
          'MN',
          'MO',
          'MV',
          'MY',
          'NP',
          'OM',
          'PH',
          'PK',
          'PS',
          'QA',
          'SA',
          'SG',
          'SY',
          'TH',
          'TJ',
          'TL',
          'TM',
          'TW',
          'UZ',
          'VN',
          'YE',
        ),
      ),
      'EU' => array(
        'name'      => __( 'Europe' ),
        'countries' => array(
          'AD',
          'AL',
          'AT',
          'AX',
          'BA',
          'BE',
          'BG',
          'BY',
          'CH',
          'CY',
          'CZ',
          'DE',
          'DK',
          'EE',
          'ES',
          'FI',
          'FO',
          'FR',
          'GB',
          'GG',
          'GI',
          'GR',
          'HR',
          'HU',
          'IE',
          'IM',
          'IS',
          'IT',
          'JE',
          'LI',
          'LT',
          'LU',
          'LV',
          'MC',
          'MD',
          'ME',
          'MK',
          'MT',
          'NL',
          'NO',
          'PL',
          'PT',
          'RO',
          'RS',
          'RU',
          'SE',
          'SI',
          'SJ',
          'SK',
          'SM',
          'TR',
          'UA',
          'VA',
        ),
      ),
      'NA' => array(
        'name'      => __( 'North America' ),
        'countries' => array(
          'AG',
          'AI',
          'AN',
          'AW',
          'BB',
          'BL',
          'BM',
          'BQ',
          'BS',
          'BZ',
          'CA',
          'CR',
          'CU',
          'CW',
          'DM',
          'DO',
          'GD',
          'GL',
          'GP',
          'GT',
          'HN',
          'HT',
          'JM',
          'KN',
          'KY',
          'LC',
          'MF',
          'MQ',
          'MS',
          'MX',
          'NI',
          'PA',
          'PM',
          'PR',
          'SV',
          'SX',
          'TC',
          'TT',
          'US',
          'VC',
          'VG',
          'VI',
        ),
      ),
      'OC' => array(
        'name'      => __( 'Oceania' ),
        'countries' => array(
          'AS',
          'AU',
          'CK',
          'FJ',
          'FM',
          'GU',
          'KI',
          'MH',
          'MP',
          'NC',
          'NF',
          'NR',
          'NU',
          'NZ',
          'PF',
          'PG',
          'PN',
          'PW',
          'SB',
          'TK',
          'TO',
          'TV',
          'UM',
          'VU',
          'WF',
          'WS',
        ),
      ),
      'SA' => array(
        'name'      => __( 'South America' ),
        'countries' => array(
          'AR',
          'BO',
          'BR',
          'CL',
          'CO',
          'EC',
          'FK',
          'GF',
          'GY',
          'PE',
          'PY',
          'SR',
          'UY',
          'VE',
        ),
      ),
    );
  }

  function countries() { 
    $countries = array(
      'AF' => 'Afghanistan',
     'AX' => '&#197;land Islands',
     'AL' => 'Albania',
     'DZ' => 'Algeria',
     'AS' => 'American Samoa',
     'AD' => 'Andorra',
     'AO' => 'Angola',
     'AI' => 'Anguilla',
     'AQ' => 'Antarctica',
     'AG' => 'Antigua and Barbuda',
     'AR' => 'Argentina',
     'AM' => 'Armenia',
     'AW' => 'Aruba',
     'AU' => 'Australia',
     'AT' => 'Austria',
     'AZ' => 'Azerbaijan',
     'BS' => 'Bahamas',
     'BH' => 'Bahrain',
     'BD' => 'Bangladesh',
     'BB' => 'Barbados',
     'BY' => 'Belarus',
     'BE' => 'Belgium',
     'PW' => 'Belau',
     'BZ' => 'Belize',
     'BJ' => 'Benin',
     'BM' => 'Bermuda',
     'BT' => 'Bhutan',
     'BO' => 'Bolivia',
     'BQ' => 'Bonaire, Saint Eustatius and Saba',
     'BA' => 'Bosnia and Herzegovina',
     'BW' => 'Botswana',
     'BV' => 'Bouvet Island',
     'BR' => 'Brazil',
     'IO' => 'British Indian Ocean Territory',
     'VG' => 'British Virgin Islands',
     'BN' => 'Brunei',
     'BG' => 'Bulgaria',
     'BF' => 'Burkina Faso',
     'BI' => 'Burundi',
     'KH' => 'Cambodia',
     'CM' => 'Cameroon',
     'CA' => 'Canada',
     'CV' => 'Cape Verde',
     'KY' => 'Cayman Islands',
     'CF' => 'Central African Republic',
     'TD' => 'Chad',
     'CL' => 'Chile',
     'CN' => 'China',
     'CX' => 'Christmas Island',
     'CC' => 'Cocos (Keeling) Islands',
     'CO' => 'Colombia',
     'KM' => 'Comoros',
     'CG' => 'Congo (Brazzaville)',
     'CD' => 'Congo (Kinshasa)',
     'CK' => 'Cook Islands',
     'CR' => 'Costa Rica',
     'HR' => 'Croatia',
     'CU' => 'Cuba',
     'CW' => 'Cura&ccedil;ao',
     'CY' => 'Cyprus',
     'CZ' => 'Czech Republic',
     'DK' => 'Denmark',
     'DJ' => 'Djibouti',
     'DM' => 'Dominica',
     'DO' => 'Dominican Republic',
     'EC' => 'Ecuador',
     'EG' => 'Egypt',
     'SV' => 'El Salvador',
     'GQ' => 'Equatorial Guinea',
     'ER' => 'Eritrea',
     'EE' => 'Estonia',
     'ET' => 'Ethiopia',
     'FK' => 'Falkland Islands',
     'FO' => 'Faroe Islands',
     'FJ' => 'Fiji',
     'FI' => 'Finland',
     'FR' => 'France',
     'GF' => 'French Guiana',
     'PF' => 'French Polynesia',
     'TF' => 'French Southern Territories',
     'GA' => 'Gabon',
     'GM' => 'Gambia',
     'GE' => 'Georgia',
     'DE' => 'Germany',
     'GH' => 'Ghana',
     'GI' => 'Gibraltar',
     'GR' => 'Greece',
     'GL' => 'Greenland',
     'GD' => 'Grenada',
     'GP' => 'Guadeloupe',
     'GU' => 'Guam',
     'GT' => 'Guatemala',
     'GG' => 'Guernsey',
     'GN' => 'Guinea',
     'GW' => 'Guinea-Bissau',
     'GY' => 'Guyana',
     'HT' => 'Haiti',
     'HM' => 'Heard Island and McDonald Islands',
     'HN' => 'Honduras',
     'HK' => 'Hong Kong',
     'HU' => 'Hungary',
     'IS' => 'Iceland',
     'IN' => 'India',
     'ID' => 'Indonesia',
     'IR' => 'Iran',
     'IQ' => 'Iraq',
     'IE' => 'Ireland',
     'IM' => 'Isle of Man',
     'IL' => 'Israel',
     'IT' => 'Italy',
     'CI' => 'Ivory Coast',
     'JM' => 'Jamaica',
     'JP' => 'Japan',
     'JE' => 'Jersey',
     'JO' => 'Jordan',
     'KZ' => 'Kazakhstan',
     'KE' => 'Kenya',
     'KI' => 'Kiribati',
     'KW' => 'Kuwait',
     'KG' => 'Kyrgyzstan',
     'LA' => 'Laos',
     'LV' => 'Latvia',
     'LB' => 'Lebanon',
     'LS' => 'Lesotho',
     'LR' => 'Liberia',
     'LY' => 'Libya',
     'LI' => 'Liechtenstein',
     'LT' => 'Lithuania',
     'LU' => 'Luxembourg',
     'MO' => 'Macao S.A.R., China',
     'MK' => 'Macedonia',
     'MG' => 'Madagascar',
     'MW' => 'Malawi',
     'MY' => 'Malaysia',
     'MV' => 'Maldives',
     'ML' => 'Mali',
     'MT' => 'Malta',
     'MH' => 'Marshall Islands',
     'MQ' => 'Martinique',
     'MR' => 'Mauritania',
     'MU' => 'Mauritius',
     'YT' => 'Mayotte',
     'MX' => 'Mexico',
     'FM' => 'Micronesia',
     'MD' => 'Moldova',
     'MC' => 'Monaco',
     'MN' => 'Mongolia',
     'ME' => 'Montenegro',
     'MS' => 'Montserrat',
     'MA' => 'Morocco',
     'MZ' => 'Mozambique',
     'MM' => 'Myanmar',
     'NA' => 'Namibia',
     'NR' => 'Nauru',
     'NP' => 'Nepal',
     'NL' => 'Netherlands',
     'NC' => 'New Caledonia',
     'NZ' => 'New Zealand',
     'NI' => 'Nicaragua',
     'NE' => 'Niger',
     'NG' => 'Nigeria',
     'NU' => 'Niue',
     'NF' => 'Norfolk Island',
     'MP' => 'Northern Mariana Islands',
     'KP' => 'North Korea',
     'NO' => 'Norway',
     'OM' => 'Oman',
     'PK' => 'Pakistan',
     'PS' => 'Palestinian Territory',
     'PA' => 'Panama',
     'PG' => 'Papua New Guinea',
     'PY' => 'Paraguay',
     'PE' => 'Peru',
     'PH' => 'Philippines',
     'PN' => 'Pitcairn',
     'PL' => 'Poland',
     'PT' => 'Portugal',
     'PR' => 'Puerto Rico',
     'QA' => 'Qatar',
     'RE' => 'Reunion',
     'RO' => 'Romania',
     'RU' => 'Russia',
     'RW' => 'Rwanda',
     'BL' => 'Saint Barth&eacute;lemy',
     'SH' => 'Saint Helena',
     'KN' => 'Saint Kitts and Nevis',
     'LC' => 'Saint Lucia',
     'MF' => 'Saint Martin (French part)',
     'SX' => 'Saint Martin (Dutch part)',
     'PM' => 'Saint Pierre and Miquelon',
     'VC' => 'Saint Vincent and the Grenadines',
     'SM' => 'San Marino',
     'ST' => 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe',
     'SA' => 'Saudi Arabia',
     'SN' => 'Senegal',
     'RS' => 'Serbia',
     'SC' => 'Seychelles',
     'SL' => 'Sierra Leone',
     'SG' => 'Singapore',
     'SK' => 'Slovakia',
     'SI' => 'Slovenia',
     'SB' => 'Solomon Islands',
     'SO' => 'Somalia',
     'ZA' => 'South Africa',
     'GS' => 'South Georgia/Sandwich Islands',
     'KR' => 'South Korea',
     'SS' => 'South Sudan',
     'ES' => 'Spain',
     'LK' => 'Sri Lanka',
     'SD' => 'Sudan',
     'SR' => 'Suriname',
     'SJ' => 'Svalbard and Jan Mayen',
     'SZ' => 'Swaziland',
     'SE' => 'Sweden',
     'CH' => 'Switzerland',
     'SY' => 'Syria',
     'TW' => 'Taiwan',
     'TJ' => 'Tajikistan',
     'TZ' => 'Tanzania',
     'TH' => 'Thailand',
     'TL' => 'Timor-Leste',
     'TG' => 'Togo',
     'TK' => 'Tokelau',
     'TO' => 'Tonga',
     'TT' => 'Trinidad and Tobago',
     'TN' => 'Tunisia',
     'TR' => 'Turkey',
     'TM' => 'Turkmenistan',
     'TC' => 'Turks and Caicos Islands',
     'TV' => 'Tuvalu',
     'UG' => 'Uganda',
     'UA' => 'Ukraine',
     'AE' => 'United Arab Emirates',
     'GB' => 'United Kingdom (UK)',
     'US' => 'United States (US)',
     'UM' => 'United States (US) Minor Outlying Islands',
     'VI' => 'United States (US) Virgin Islands',
     'UY' => 'Uruguay',
     'UZ' => 'Uzbekistan',
     'VU' => 'Vanuatu',
     'VA' => 'Vatican',
     'VE' => 'Venezuela',
     'VN' => 'Vietnam',
     'WF' => 'Wallis and Futuna',
     'EH' => 'Western Sahara',
     'WS' => 'Samoa',
     'YE' => 'Yemen',
     'ZM' => 'Zambia',
     'ZW' => 'Zimbabwe' ); ?>
    <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
      <i class="material-icons prefix">room</i>
      <input class="mdl-textfield__input" type="text" id="countries" name="country" readonly tabIndex="-1" placeholder="Select Country" value="<?php showOption( 'country' ); ?>">
      <ul for="countries" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?> option-drop" style="max-height: 300px !important; overflow-y: auto;"><?php foreach ($countries as $key => $value) { ?>
        <li class="mdl-menu__item" data-val="<?php _show_( $key ); ?>"><?php _show_( $value ); ?></li>
      <?php } ?>
      </ul>
      <label for="countries" class="center-align">Country</label>
    </div><?php
  }

  function currencyCode() { 
      $currency = array (
      "AED" => "United Arab Emirates dirham",
      "AFN" => "Afghan afghani",
      "ALL" => "Albanian lek",
      "AMD" => "Armenian dram",
      "ANG" => "Netherlands Antillean guilder",
      "AOA" => "Angolan kwanza",
      "ARS" => "Argentine peso",
      "AUD" => "Australian dollar",
      "AWG" => "Aruban florin",
      "AZN" => "Azerbaijani manat",
      "BAM" => "Bosnia and Herzegovina convertible mark",
      "BBD" => "Barbados dollar",
      "BDT" => "Bangladeshi taka",
      "BGN" => "Bulgarian lev",
      "BHD" => "Bahraini dinar",
      "BIF" => "Burundian franc",
      "BMD" => "Bermudian dollar",
      "BND" => "Brunei dollar",
      "BOB" => "Boliviano",
      "BRL" => "Brazilian real",
      "BSD" => "Bahamian dollar",
      "BTN" => "Bhutanese ngultrum",
      "BWP" => "Botswana pula",
      "BYN" => "New Belarusian ruble",
      "BYR" => "Belarusian ruble",
      "BZD" => "Belize dollar",
      "CAD" => "Canadian dollar",
      "CDF" => "Congolese franc",
      "CHF" => "Swiss franc",
      "CLF" => "Unidad de Fomento",
      "CLP" => "Chilean peso",
      "CNY" => "Renminbi|Chinese yuan",
      "COP" => "Colombian peso",
      "CRC" => "Costa Rican colon",
      "CUC" => "Cuban convertible peso",
      "CUP" => "Cuban peso",
      "CVE" => "Cape Verde escudo",
      "CZK" => "Czech koruna",
      "DJF" => "Djiboutian franc",
      "DKK" => "Danish krone",
      "DOP" => "Dominican peso",
      "DZD" => "Algerian dinar",
      "EGP" => "Egyptian pound",
      "ERN" => "Eritrean nakfa",
      "ETB" => "Ethiopian birr",
      "EUR" => "Euro",
      "FJD" => "Fiji dollar",
      "FKP" => "Falkland Islands pound",
      "GBP" => "Pound sterling",
      "GEL" => "Georgian lari",
      "GHS" => "Ghanaian cedi",
      "GIP" => "Gibraltar pound",
      "GMD" => "Gambian dalasi",
      "GNF" => "Guinean franc",
      "GTQ" => "Guatemalan quetzal",
      "GYD" => "Guyanese dollar",
      "HKD" => "Hong Kong dollar",
      "HNL" => "Honduran lempira",
      "HRK" => "Croatian kuna",
      "HTG" => "Haitian gourde",
      "HUF" => "Hungarian forint",
      "IDR" => "Indonesian rupiah",
      "ILS" => "Israeli new shekel",
      "INR" => "Indian rupee",
      "IQD" => "Iraqi dinar",
      "IRR" => "Iranian rial",
      "ISK" => "Icelandic króna",
      "JMD" => "Jamaican dollar",
      "JOD" => "Jordanian dinar",
      "JPY" => "Japanese yen",
      "KES" => "Kenyan shilling",
      "KGS" => "Kyrgyzstani som",
      "KHR" => "Cambodian riel",
      "KMF" => "Comoro franc",
      "KPW" => "North Korean won",
      "KRW" => "South Korean won",
      "KWD" => "Kuwaiti dinar",
      "KYD" => "Cayman Islands dollar",
      "KZT" => "Kazakhstani tenge",
      "LAK" => "Lao kip",
      "LBP" => "Lebanese pound",
      "LKR" => "Sri Lankan rupee",
      "LRD" => "Liberian dollar",
      "LSL" => "Lesotho loti",
      "LYD" => "Libyan dinar",
      "MAD" => "Moroccan dirham",
      "MDL" => "Moldovan leu",
      "MGA" => "Malagasy ariary",
      "MKD" => "Macedonian denar",
      "MMK" => "Myanmar kyat",
      "MNT" => "Mongolian tögrög",
      "MOP" => "Macanese pataca",
      "MRO" => "Mauritanian ouguiya",
      "MUR" => "Mauritian rupee",
      "MVR" => "Maldivian rufiyaa",
      "MWK" => "Malawian kwacha",
      "MXN" => "Mexican peso",
      "MXV" => "Mexican Unidad de Inversion",
      "MYR" => "Malaysian ringgit",
      "MZN" => "Mozambican metical",
      "NAD" => "Namibian dollar",
      "NGN" => "Nigerian naira",
      "NIO" => "Nicaraguan córdoba",
      "NOK" => "Norwegian krone",
      "NPR" => "Nepalese rupee",
      "NZD" => "New Zealand dollar",
      "OMR" => "Omani rial",
      "PAB" => "Panamanian balboa",
      "PEN" => "Peruvian Sol",
      "PGK" => "Papua New Guinean kina",
      "PHP" => "Philippine peso",
      "PKR" => "Pakistani rupee",
      "PLN" => "Polish złoty",
      "PYG" => "Paraguayan guaraní",
      "QAR" => "Qatari riyal",
      "RON" => "Romanian leu",
      "RSD" => "Serbian dinar",
      "RUB" => "Russian ruble",
      "RWF" => "Rwandan franc",
      "SAR" => "Saudi riyal",
      "SBD" => "Solomon Islands dollar",
      "SCR" => "Seychelles rupee",
      "SDG" => "Sudanese pound",
      "SEK" => "Swedish krona",
      "SGD" => "Singapore dollar",
      "SHP" => "Saint Helena pound",
      "SLL" => "Sierra Leonean leone",
      "SOS" => "Somali shilling",
      "SRD" => "Surinamese dollar",
      "SSP" => "South Sudanese pound",
      "STD" => "São Tomé and Príncipe dobra",
      "SVC" => "Salvadoran colón",
      "SYP" => "Syrian pound",
      "SZL" => "Swazi lilangeni",
      "THB" => "Thai baht",
      "TJS" => "Tajikistani somoni",
      "TMT" => "Turkmenistani manat",
      "TND" => "Tunisian dinar",
      "TOP" => "Tongan paʻanga",
      "TRY" => "Turkish lira",
      "TTD" => "Trinidad and Tobago dollar",
      "TWD" => "New Taiwan dollar",
      "TZS" => "Tanzanian shilling",
      "UAH" => "Ukrainian hryvnia",
      "UGX" => "Ugandan shilling",
      "USD" => "United States dollar",
      "UYI" => "Uruguay Peso en Unidades Indexadas",
      "UYU" => "Uruguayan peso",
      "UZS" => "Uzbekistan som",
      "VEF" => "Venezuelan bolívar",
      "VND" => "Vietnamese đồng",
      "VUV" => "Vanuatu vatu",
      "WST" => "Samoan tala",
      "XAF" => "Central African CFA franc",
      "XCD" => "East Caribbean dollar",
      "XOF" => "West African CFA franc",
      "XPF" => "CFP franc",
      "YER" => "Yemeni rial",
      "ZAR" => "South African rand",
      "ZMW" => "Zambian kwacha",
      "ZWL" => "Zimbabwean dollar" ); ?>
    <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
      <i class="fa fa-money prefix"></i>
      <input class="mdl-textfield__input" type="text" id="currencies" name="currency" readonly tabIndex="-1" placeholder="Select Currency (Code)">
       <ul for="currencies" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php foreach ($currency as $key => $value) { ?>
        <li class="mdl-menu__item" data-val="<?php _show_( $key ); ?>"><?php _show_( $value ); ?></li>
      <?php } ?>
      </ul>
    </div><?php
  }

  function currencySym() {
        $currency = array(
        'AED' => '&#1583;.&#1573;', // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;', // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#1084;&#1072;&#1085;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;', // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;', // ?
        'BIF' => '&#70;&#66;&#117;', // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTN' => '&#78;&#117;&#46;', // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '', // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;', // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;', // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;', // ?
        'EGP' => '&#163;',
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;', // ?
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;', // ?
        'GNF' => '&#70;&#71;', // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;', // ?
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;', // ?
        'IRR' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;', // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;', // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;', // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;', // ?
        'KYD' => '&#36;',
        'KZT' => '&#1083;&#1074;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;', // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;', // ?
        'MAD' => '&#1583;.&#1605;.', //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;', // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;', // ?
        'MRO' => '&#85;&#77;', // ?
        'MUR' => '&#8360;', // ?
        'MVR' => '.&#1923;', // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;', // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#1088;&#1091;&#1073;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;', // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;', // ?
        'SOS' => '&#83;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;', // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;', // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '',
        'XOF' => '',
        'XPF' => '&#70;',
        'YER' => '&#65020;',
        'ZAR' => '&#82;',
        'ZMK' => '&#90;&#75;', // ?
        'ZWL' => '&#90;&#36;', ); ?>
        <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
        <i class="fa fa-money prefix"></i>
        <input class="mdl-textfield__input" type="text" id="scurrencies" name="currency" readonly tabIndex="-1" placeholder="Select Currency (Symbol)">
        <ul for="scurrencies" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php foreach ($currency as $key => $value) { ?>
          <li class="mdl-menu__item" data-val="<?php _show_( $key ); ?>"><?php _show_( $value ); ?></li>
        <?php } ?>
        </ul>
        </div><?php
  }

  /*
  * get currency symboles 
  */
  function get_currency_symbol($cc = 'USD'){
      $cc = strtoupper($cc);
      $currency = array(
        'AED' => '&#1583;.&#1573;', // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;', // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#1084;&#1072;&#1085;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;', // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;', // ?
        'BIF' => '&#70;&#66;&#117;', // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTN' => '&#78;&#117;&#46;', // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '', // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;', // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;', // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;', // ?
        'EGP' => '&#163;',
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;', // ?
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;', // ?
        'GNF' => '&#70;&#71;', // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;', // ?
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;', // ?
        'IRR' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;', // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;', // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;', // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;', // ?
        'KYD' => '&#36;',
        'KZT' => '&#1083;&#1074;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;', // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;', // ?
        'MAD' => '&#1583;.&#1605;.', //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;', // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;', // ?
        'MRO' => '&#85;&#77;', // ?
        'MUR' => '&#8360;', // ?
        'MVR' => '.&#1923;', // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;', // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#1088;&#1091;&#1073;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;', // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;', // ?
        'SOS' => '&#83;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;', // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;', // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '',
        'XOF' => '',
        'XPF' => '&#70;',
        'YER' => '&#65020;',
        'ZAR' => '&#82;',
        'ZMK' => '&#90;&#75;', // ?
        'ZWL' => '&#90;&#36;',
        );
      
      if(array_key_exists($cc, $currency)){
          return $currency[$cc];
      }
  }

  function regions( $country ) {
    switch ( $country ) {
      case 'kenya':
        return $this -> keCounties();
        break;

      case 'us':
        return $this -> usStates();
        break;

      case 'kenyn':
        return $this -> keCounties();
        break;
      
      default:
        # code...
        break;
    }
  }

  function keCounties() {?>
        <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
            <i class="material-icons prefix">room</i>
          <input class="mdl-textfield__input" type="text" id="counties" name="region" readonly tabIndex="-1" placeholder="Location (Optional )" value="<?php showOption( 'region' ); ?>">
          <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php 
              $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
              $counties = explode( ", ", $county_list );
              for ( $c=0; $c < count( $counties ); $c++ ) {
                  $label = ucwords( $counties[$c] );
                  echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
              }
               ?>
          </ul>
          <label for="counties">Counties</label>
        </div><?php 
  }

  function usStates() {
        $states = array(
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Delaware',
        'DC' => 'District Of Columbia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming',
        'AA' => 'Armed Forces (AA)',
        'AE' => 'Armed Forces (AE)',
        'AP' => 'Armed Forces (AP)' ); ?>

        <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
        <i class="material-icons prefix">room</i>
        <input class="mdl-textfield__input" type="text" id="states" name="region" readonly tabIndex="-1" placeholder="Country (Optional )" value="<?php showOption( 'region' ); ?>">
        <ul for="states" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php foreach ($states as $key => $value) { ?>
          <li class="mdl-menu__item" data-val="<?php _show_( $key ); ?>"><?php _show_( $value ); ?></li>
        <?php } ?>
        </ul>
        <label for="states">States</label>
        </div><?php
  }

} 
