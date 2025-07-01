<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $banks = [
            // Universal & Commercial Banks
            ['name' => 'Asia United Bank Corporation',     'short_name' => 'AUB',           'sort_code' => '011020011'],
            ['name' => 'Australia and New Zealand Banking Group', 'short_name'=>'ANZ',      'sort_code'=>'010700015'],
            ['name' => 'BDO Unibank, Inc.',                'short_name' => 'BDO',          'sort_code' => '010530667'],
            ['name' => 'Bangkok Bank (Philippine Branch)', 'short_name' => 'BKK',          'sort_code' => '010670019'],
            ['name' => 'Bank of America, N.A.',           'short_name' => 'BOA',           'sort_code' => '010120019'],
            ['name' => 'Bank of China',                   'short_name' => 'BOC-China',     'sort_code' => '011140014'],
            ['name' => 'Bank of Commerce',                'short_name' => 'BOC',           'sort_code' => '010440016'],
            ['name' => 'Bank of the Philippine Islands',  'short_name' => 'BPI',           'sort_code' => '010040018'],
            ['name' => 'Bank of Tokyo‑Mitsubishi',        'short_name' => 'BOT',           'sort_code' => '010460012'],
            ['name' => 'China Banking Corporation',       'short_name' => 'CHINABANK',     'sort_code' => '010100013'],
            ['name' => 'Citibank, N.A.',                  'short_name' => 'CITI',          'sort_code' => '010070017'],
            ['name' => 'CTBC Bank (Philippines) Corp.',   'short_name' => 'CTBC',          'sort_code' => '010690015'],
            ['name' => 'Deutsche Bank AG',                'short_name' => 'DEUTSCHE',      'sort_code' => '010650013'],
            ['name' => 'Development Bank of the Philippines','short_name'=>'DBP',           'sort_code'=>'010590018'],
            ['name' => 'East West Banking Corporation',   'short_name' => 'EASTWEST',      'sort_code' => '010620014'],
            ['name' => 'Hongkong and Shanghai Banking Corp.', 'short_name'=>'HSBC',        'sort_code'=>'010060014'],
            ['name' => 'Industrial Bank of Korea',        'short_name'=>'IBK',            'sort_code'=>'011310019'],
            ['name' => 'JP Morgan Chase Bank, N.A.',      'short_name' => 'CHASE',         'sort_code' => '010720011'],
            ['name' => 'KEB Hana Bank',                   'short_name' => 'HANA',          'sort_code' => '010710018'],
            ['name' => 'Land Bank of the Philippines',    'short_name' => 'LANDBANK',      'sort_code' => '010350025'],
            ['name' => 'Maybank Philippines, Inc.',       'short_name' => 'MAYBANK',       'sort_code' => '010220016'],
            ['name' => 'Mega International Commercial Bank','short_name'=>'MEGA',         'sort_code'=>'010560019'],
            ['name' => 'Metropolitan Bank & Trust Co.',   'short_name' => 'METROBANK',     'sort_code' => '010269996'],
            ['name' => 'Mizuho Bank, Ltd.',               'short_name' => 'MIZUHO',        'sort_code' => '010640010'],
            ['name' => 'MUFG Bank (ex‑B of Tokyo‑Mitsubishi)','short_name'=>'MUFG','sort_code'=>'010460012'],
            ['name' => 'Philippine Bank of Communications','short_name'=>'PBCOM',         'sort_code'=>'010110016'],
            ['name' => 'Philippine National Bank',        'short_name' => 'PNB',           'sort_code' => '010080010'],
            ['name' => 'Philippine Trust Company',        'short_name' => 'PHILTRUST',     'sort_code' => '010090039'],
            ['name' => 'Philippine Veterans Bank',        'short_name' => 'VETERANS',      'sort_code' => '010330016'],
            ['name' => 'Rizal Commercial Banking Corp.',  'short_name' => 'RCBC',          'sort_code' => '010280014'],
            ['name' => 'Robinsons Bank Corporation',     'short_name' => 'ROBINSONS',     'sort_code' => '011070016'],
            ['name' => 'Security Bank Corporation',      'short_name' => 'SECURITY',      'sort_code' => '010140015'],
            ['name' => 'Standard Chartered Bank',        'short_name' => 'STANCHART',     'sort_code' => '010050011'],
            ['name' => 'Sterling Bank of Asia, Inc.',     'short_name' => 'STERLING',      'sort_code' => '011190019'],
            ['name' => 'Sumitomo Mitsui Banking Corp.',  'short_name' => 'SMBC',          'sort_code' => '011280013'],
            ['name' => 'Tonik Digital Bank',              'short_name' => 'TONIK',         'sort_code' => '011570011'],
            ['name' => 'Union Bank of the Philippines',   'short_name' => 'UNION',         'sort_code' => '010419995'],
            ['name' => 'United Coconut Planters Bank',    'short_name' => 'UCPB',          'sort_code' => '010299995'],
            ['name' => 'United Overseas Bank Philippines','short_name' => 'UOB',           'sort_code' => '010270341'],
            // Thrift/Savings Banks
            ['name'=>'Allied Banking Corporation',       'short_name'=>'ALLIED',        'sort_code'=>'010320013'],
            ['name'=>'China Bank Savings, Inc.',         'short_name'=>'CHINABSAV',     'sort_code'=>'011129996'],
            ['name'=>'Equicom Savings Bank, Inc.',       'short_name'=>'EQUICOM',       'sort_code'=>'010960017'],
            ['name'=>'Yuanta Savings Bank',              'short_name'=>'YUANTA',        'sort_code'=>'011130011'],
            ['name'=>'Philippine Savings Bank',          'short_name'=>'PSBANK',        'sort_code'=>'010470992'],
            ];

        DB::table('banks')->insert($banks);

        
    }
}
