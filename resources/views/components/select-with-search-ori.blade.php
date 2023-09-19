@props(['dataLists', 'name', 'id'])

<div class="relative text-black" x-data="selectmenu({ @foreach($dataLists) satu: 'one', })" @click.away="close()">
    <input type="text" x-model="selectedkey" name="selectfield" id="selectfield" class="hidden">
    <span class="inline-block w-full rounded-md shadow-sm" @click="toggle(); $nextTick(() => $refs.filterinput.focus());">
        <button type="button"
            class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
            <span class="block truncate" x-text="selectedlabel ?? 'Please Select'"></span>

            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    </span>

    <div x-show="state" class="absolute z-10 w-full p-2 mt-1 bg-white rounded-md shadow-lg">
        <input type="text" class="w-full px-2 py-1 mb-1 border border-gray-400 rounded-md" x-model="filter"
            x-ref="filterinput">
        <ul
            class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">

            <template x-for="(value, key) in getlist()" :key="key">

                <li @click="select(value, key)" :class="{ 'bg-gray-100': isselected(key) }"
                    class="relative py-1 pl-3 mb-1 text-gray-900 rounded-md cursor-pointer select-none pr-9 hover:bg-gray-100">
                    <span x-text="value" class="block font-normal truncate"></span>

                    <span x-show="isselected(key)"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-700">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>
    </div>
</div>

{{-- @foreach ($dataLists as $dt)
    <div>{{ $dt->name }}</div>
    <div>{{ $dt->id }}</div>
@endforeach --}}
@push('script')
    <script>
        function selectmenu(datalist) {
            return {
                state: false,
                filter: '',
                list: datalist,
                selectedkey: null,
                selectedlabel: null,
                toggle: function() {
                    this.state = !this.state;
                    this.filter = '';
                },
                close: function() {
                    this.state = false;
                },
                select: function(value, key) {
                    if (this.selectedkey == key) {
                        this.selectedlabel = null;
                        this.selectedkey = null;
                    } else {
                        this.selectedlabel = value;
                        this.selectedkey = key;
                        this.state = false;
                    }
                },
                isselected: function(key) {
                    return this.selectedkey == key;
                },
                getlist: function() {
                    if (this.filter == '') {
                        return this.list;
                    }
                    var filtered = Object.entries(this.list).filter(([key, value]) => value.toLowerCase().includes(this
                        .filter.toLowerCase()));

                    var result = Object.fromEntries(filtered);
                    return result;
                }
            };
        }

        function datalist() {
            return {
                AF: 'Afghanistan',
                AX: 'Aland Islands',
                AL: 'Albania',
                DZ: 'Algeria',
                AS: 'American Samoa',
                AD: 'Andorra',
                AO: 'Angola',
                AI: 'Anguilla',
                AQ: 'Antarctica',
                AG: 'Antigua And Barbuda',
                AR: 'Argentina',
                AM: 'Armenia',
                AW: 'Aruba',
                AU: 'Australia',
                AT: 'Austria',
                AZ: 'Azerbaijan',
                BS: 'Bahamas',
                BH: 'Bahrain',
                BD: 'Bangladesh',
                BB: 'Barbados',
                BY: 'Belarus',
                BE: 'Belgium',
                BZ: 'Belize',
                BJ: 'Benin',
                BM: 'Bermuda',
                BT: 'Bhutan',
                BO: 'Bolivia',
                BA: 'Bosnia And Herzegovina',
                BW: 'Botswana',
                BV: 'Bouvet Island',
                BR: 'Brazil',
                IO: 'British Indian Ocean Territory',
                BN: 'Brunei Darussalam',
                BG: 'Bulgaria',
                BF: 'Burkina Faso',
                BI: 'Burundi',
                KH: 'Cambodia',
                CM: 'Cameroon',
                CA: 'Canada',
                CV: 'Cape Verde',
                KY: 'Cayman Islands',
                CF: 'Central African Republic',
                TD: 'Chad',
                CL: 'Chile',
                CN: 'China',
                CX: 'Christmas Island',
                CC: 'Cocos (Keeling) Islands',
                CO: 'Colombia',
                KM: 'Comoros',
                CG: 'Congo',
                CD: 'Congo, Democratic Republic',
                CK: 'Cook Islands',
                CR: 'Costa Rica',
                CI: 'Cote D\'Ivoire',
                HR: 'Croatia',
                CU: 'Cuba',
                CY: 'Cyprus',
                CZ: 'Czech Republic',
                DK: 'Denmark',
                DJ: 'Djibouti',
                DM: 'Dominica',
                DO: 'Dominican Republic',
                EC: 'Ecuador',
                EG: 'Egypt',
                SV: 'El Salvador',
                GQ: 'Equatorial Guinea',
                ER: 'Eritrea',
                EE: 'Estonia',
                ET: 'Ethiopia',
                FK: 'Falkland Islands (Malvinas)',
                FO: 'Faroe Islands',
                FJ: 'Fiji',
                FI: 'Finland',
                FR: 'France',
                GF: 'French Guiana',
                PF: 'French Polynesia',
                TF: 'French Southern Territories',
                GA: 'Gabon',
                GM: 'Gambia',
                GE: 'Georgia',
                DE: 'Germany',
                GH: 'Ghana',
                GI: 'Gibraltar',
                GR: 'Greece',
                GL: 'Greenland',
                GD: 'Grenada',
                GP: 'Guadeloupe',
                GU: 'Guam',
                GT: 'Guatemala',
                GG: 'Guernsey',
                GN: 'Guinea',
                GW: 'Guinea-Bissau',
                GY: 'Guyana',
                HT: 'Haiti',
                HM: 'Heard Island & Mcdonald Islands',
                VA: 'Holy See (Vatican City State)',
                HN: 'Honduras',
                HK: 'Hong Kong',
                HU: 'Hungary',
                IS: 'Iceland',
                IN: 'India',
                ID: 'Indonesia',
                IR: 'Iran, Islamic Republic Of',
                IQ: 'Iraq',
                IE: 'Ireland',
                IM: 'Isle Of Man',
                IL: 'Israel',
                IT: 'Italy',
                JM: 'Jamaica',
                JP: 'Japan',
                JE: 'Jersey',
                JO: 'Jordan',
                KZ: 'Kazakhstan',
                KE: 'Kenya',
                KI: 'Kiribati',
                KR: 'Korea',
                KW: 'Kuwait',
                KG: 'Kyrgyzstan',
                LA: 'Lao People\'s Democratic Republic',
                LV: 'Latvia',
                LB: 'Lebanon',
                LS: 'Lesotho',
                LR: 'Liberia',
                LY: 'Libyan Arab Jamahiriya',
                LI: 'Liechtenstein',
                LT: 'Lithuania',
                LU: 'Luxembourg',
                MO: 'Macao',
                MK: 'Macedonia',
                MG: 'Madagascar',
                MW: 'Malawi',
                MY: 'Malaysia',
                MV: 'Maldives',
                ML: 'Mali',
                MT: 'Malta',
                MH: 'Marshall Islands',
                MQ: 'Martinique',
                MR: 'Mauritania',
                MU: 'Mauritius',
                YT: 'Mayotte',
                MX: 'Mexico',
                FM: 'Micronesia, Federated States Of',
                MD: 'Moldova',
                MC: 'Monaco',
                MN: 'Mongolia',
                ME: 'Montenegro',
                MS: 'Montserrat',
                MA: 'Morocco',
                MZ: 'Mozambique',
                MM: 'Myanmar',
                NA: 'Namibia',
                NR: 'Nauru',
                NP: 'Nepal',
                NL: 'Netherlands',
                AN: 'Netherlands Antilles',
                NC: 'New Caledonia',
                NZ: 'New Zealand',
                NI: 'Nicaragua',
                NE: 'Niger',
                NG: 'Nigeria',
                NU: 'Niue',
                NF: 'Norfolk Island',
                MP: 'Northern Mariana Islands',
                NO: 'Norway',
                OM: 'Oman',
                PK: 'Pakistan',
                PW: 'Palau',
                PS: 'Palestinian Territory, Occupied',
                PA: 'Panama',
                PG: 'Papua New Guinea',
                PY: 'Paraguay',
                PE: 'Peru',
                PH: 'Philippines',
                PN: 'Pitcairn',
                PL: 'Poland',
                PT: 'Portugal',
                PR: 'Puerto Rico',
                QA: 'Qatar',
                RE: 'Reunion',
                RO: 'Romania',
                RU: 'Russian Federation',
                RW: 'Rwanda',
                BL: 'Saint Barthelemy',
                SH: 'Saint Helena',
                KN: 'Saint Kitts And Nevis',
                LC: 'Saint Lucia',
                MF: 'Saint Martin',
                PM: 'Saint Pierre And Miquelon',
                VC: 'Saint Vincent And Grenadines',
                WS: 'Samoa',
                SM: 'San Marino',
                ST: 'Sao Tome And Principe',
                SA: 'Saudi Arabia',
                SN: 'Senegal',
                RS: 'Serbia',
                SC: 'Seychelles',
                SL: 'Sierra Leone',
                SG: 'Singapore',
                SK: 'Slovakia',
                SI: 'Slovenia',
                SB: 'Solomon Islands',
                SO: 'Somalia',
                ZA: 'South Africa',
                GS: 'South Georgia And Sandwich Isl.',
                ES: 'Spain',
                LK: 'Sri Lanka',
                SD: 'Sudan',
                SR: 'Suriname',
                SJ: 'Svalbard And Jan Mayen',
                SZ: 'Swaziland',
                SE: 'Sweden',
                CH: 'Switzerland',
                SY: 'Syrian Arab Republic',
                TW: 'Taiwan',
                TJ: 'Tajikistan',
                TZ: 'Tanzania',
                TH: 'Thailand',
                TL: 'Timor-Leste',
                TG: 'Togo',
                TK: 'Tokelau',
                TO: 'Tonga',
                TT: 'Trinidad And Tobago',
                TN: 'Tunisia',
                TR: 'Turkey',
                TM: 'Turkmenistan',
                TC: 'Turks And Caicos Islands',
                TV: 'Tuvalu',
                UG: 'Uganda',
                UA: 'Ukraine',
                AE: 'United Arab Emirates',
                GB: 'United Kingdom',
                US: 'United States',
                UM: 'United States Outlying Islands',
                UY: 'Uruguay',
                UZ: 'Uzbekistan',
                VU: 'Vanuatu',
                VE: 'Venezuela',
                VN: 'Viet Nam',
                VG: 'Virgin Islands, British',
                VI: 'Virgin Islands, U.S.',
                WF: 'Wallis And Futuna',
                EH: 'Western Sahara',
                YE: 'Yemen',
                ZM: 'Zambia',
                ZW: 'Zimbabwe'
            };
        }
    </script>
@endpush
