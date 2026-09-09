<?php
/**
 * FixFlip Dynamic Destination Sales Tax Engine
 * Computes exact state, city, and local sales tax based upon the delivery jobsite ZIP code.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Determine US State 2-Letter Code from 5-Digit ZIP Code
 */
function fixflip_zip_to_state( $zip ) {
    $zip = (int) substr( preg_replace( '/[^0-9]/', '', (string) $zip ), 0, 5 );
    if ( $zip <= 0 ) return '';

    if ( ( $zip >= 1000 && $zip <= 2799 ) || ( $zip >= 5501 && $zip <= 5544 ) ) return 'MA';
    if ( $zip >= 2800 && $zip <= 2999 ) return 'RI';
    if ( $zip >= 3000 && $zip <= 3899 ) return 'NH';
    if ( $zip >= 3900 && $zip <= 4999 ) return 'ME';
    if ( $zip >= 5000 && $zip <= 5999 ) return 'VT';
    if ( $zip >= 6000 && $zip <= 6999 ) return 'CT';
    if ( $zip >= 7000 && $zip <= 8999 ) return 'NJ';
    if ( ( $zip >= 10000 && $zip <= 14999 ) || ( $zip >= 6390 && $zip <= 6390 ) ) return 'NY';
    if ( $zip >= 15000 && $zip <= 19699 ) return 'PA';
    if ( $zip >= 19700 && $zip <= 19999 ) return 'DE';
    if ( ( $zip >= 20000 && $zip <= 20599 ) || ( $zip >= 56901 && $zip <= 56999 ) ) return 'DC';
    if ( $zip >= 20600 && $zip <= 21999 ) return 'MD';
    if ( $zip >= 22000 && $zip <= 24699 ) return 'VA';
    if ( $zip >= 24700 && $zip <= 26999 ) return 'WV';
    if ( $zip >= 27000 && $zip <= 28999 ) return 'NC';
    if ( $zip >= 29000 && $zip <= 29999 ) return 'SC';
    if ( ( $zip >= 30000 && $zip <= 31999 ) || ( $zip >= 39800 && $zip <= 39999 ) ) return 'GA';
    if ( $zip >= 32000 && $zip <= 34999 ) return 'FL';
    if ( $zip >= 35000 && $zip <= 36999 ) return 'AL';
    if ( $zip >= 37000 && $zip <= 38599 ) return 'TN';
    if ( $zip >= 38600 && $zip <= 39799 ) return 'MS';
    if ( $zip >= 40000 && $zip <= 42799 ) return 'KY';
    if ( $zip >= 43000 && $zip <= 45999 ) return 'OH';
    if ( $zip >= 46000 && $zip <= 47999 ) return 'IN';
    if ( $zip >= 48000 && $zip <= 49999 ) return 'MI';
    if ( $zip >= 50000 && $zip <= 52899 ) return 'IA';
    if ( $zip >= 53000 && $zip <= 54999 ) return 'WI';
    if ( $zip >= 55000 && $zip <= 56799 ) return 'MN';
    if ( $zip >= 57000 && $zip <= 57799 ) return 'SD';
    if ( $zip >= 58000 && $zip <= 58899 ) return 'ND';
    if ( $zip >= 59000 && $zip <= 59999 ) return 'MT';
    if ( $zip >= 60000 && $zip <= 62999 ) return 'IL';
    if ( $zip >= 63000 && $zip <= 65999 ) return 'MO';
    if ( $zip >= 66000 && $zip <= 67999 ) return 'KS';
    if ( $zip >= 68000 && $zip <= 69399 ) return 'NE';
    if ( $zip >= 70000 && $zip <= 71499 ) return 'LA';
    if ( $zip >= 71600 && $zip <= 72999 ) return 'AR';
    if ( $zip >= 73000 && $zip <= 74999 ) return 'OK';
    if ( ( $zip >= 75000 && $zip <= 79999 ) || ( $zip >= 88500 && $zip <= 88599 ) ) return 'TX';
    if ( $zip >= 80000 && $zip <= 81699 ) return 'CO';
    if ( $zip >= 82000 && $zip <= 83199 ) return 'WY';
    if ( $zip >= 83200 && $zip <= 83899 ) return 'ID';
    if ( $zip >= 84000 && $zip <= 84799 ) return 'UT';
    if ( $zip >= 85000 && $zip <= 86599 ) return 'AZ';
    if ( $zip >= 87000 && $zip <= 88499 ) return 'NM';
    if ( $zip >= 89000 && $zip <= 89899 ) return 'NV';
    if ( $zip >= 90000 && $zip <= 96199 ) return 'CA';
    if ( $zip >= 96700 && $zip <= 96899 ) return 'HI';
    if ( $zip >= 97000 && $zip <= 97999 ) return 'OR';
    if ( $zip >= 98000 && $zip <= 99499 ) return 'WA';
    if ( $zip >= 99500 && $zip <= 99999 ) return 'AK';

    return '';
}

/**
 * Authoritative Sales Tax Lookup by 5-Digit ZIP Code, 3-Digit Prefix, or State
 */
function fixflip_lookup_zip_tax_rate( $postcode, $state = '', $city = '' ) {
    $clean_zip = substr( preg_replace( '/[^0-9]/', '', (string) $postcode ), 0, 5 );
    $state_upper = strtoupper( trim( (string) $state ) );
    $city_clean = ucwords( strtolower( trim( (string) $city ) ) );

    $zip_state = ! empty( $clean_zip ) ? fixflip_zip_to_state( $clean_zip ) : '';
    if ( ! empty( $zip_state ) ) {
        if ( empty( $state_upper ) || $state_upper !== $zip_state ) {
            $state_upper = $zip_state;
            $city_clean  = ''; // Prevent stale mismatched city from previous session/keystrokes
        }
    }

    // 1. SPECIFIC 5-DIGIT LOCAL & MUNICIPAL TAX RATES (High-Volume Renovation Markets)
    $specific_zips = array(
        // California - Los Angeles County Cities with District Add-ons
        '90401' => array( 'rate' => 10.25, 'city' => 'Santa Monica', 'state' => 'CA' ),
        '90402' => array( 'rate' => 10.25, 'city' => 'Santa Monica', 'state' => 'CA' ),
        '90403' => array( 'rate' => 10.25, 'city' => 'Santa Monica', 'state' => 'CA' ),
        '90404' => array( 'rate' => 10.25, 'city' => 'Santa Monica', 'state' => 'CA' ),
        '90405' => array( 'rate' => 10.25, 'city' => 'Santa Monica', 'state' => 'CA' ),
        '90230' => array( 'rate' => 10.20, 'city' => 'Culver City', 'state' => 'CA' ),
        '90232' => array( 'rate' => 10.20, 'city' => 'Culver City', 'state' => 'CA' ),
        '90802' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90803' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90804' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90805' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90806' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90807' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90808' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90813' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '90815' => array( 'rate' => 10.25, 'city' => 'Long Beach', 'state' => 'CA' ),
        '91101' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91103' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91104' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91105' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91106' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91107' => array( 'rate' => 10.25, 'city' => 'Pasadena', 'state' => 'CA' ),
        '91201' => array( 'rate' => 10.25, 'city' => 'Glendale', 'state' => 'CA' ),
        '91202' => array( 'rate' => 10.25, 'city' => 'Glendale', 'state' => 'CA' ),
        '91203' => array( 'rate' => 10.25, 'city' => 'Glendale', 'state' => 'CA' ),
        '91204' => array( 'rate' => 10.25, 'city' => 'Glendale', 'state' => 'CA' ),
        '91205' => array( 'rate' => 10.25, 'city' => 'Glendale', 'state' => 'CA' ),
        '91501' => array( 'rate' => 10.25, 'city' => 'Burbank', 'state' => 'CA' ),
        '91502' => array( 'rate' => 10.25, 'city' => 'Burbank', 'state' => 'CA' ),
        '91504' => array( 'rate' => 10.25, 'city' => 'Burbank', 'state' => 'CA' ),
        '91505' => array( 'rate' => 10.25, 'city' => 'Burbank', 'state' => 'CA' ),
        '91506' => array( 'rate' => 10.25, 'city' => 'Burbank', 'state' => 'CA' ),
        
        // California - Orange County Cities
        '92618' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92602' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92603' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92604' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92606' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92612' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92614' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92620' => array( 'rate' => 7.75, 'city' => 'Irvine', 'state' => 'CA' ),
        '92683' => array( 'rate' => 8.75, 'city' => 'Westminster', 'state' => 'CA' ),
        '92840' => array( 'rate' => 8.75, 'city' => 'Garden Grove', 'state' => 'CA' ),
        '92841' => array( 'rate' => 8.75, 'city' => 'Garden Grove', 'state' => 'CA' ),
        '92843' => array( 'rate' => 8.75, 'city' => 'Garden Grove', 'state' => 'CA' ),
        '92844' => array( 'rate' => 8.75, 'city' => 'Garden Grove', 'state' => 'CA' ),
        '92845' => array( 'rate' => 8.75, 'city' => 'Garden Grove', 'state' => 'CA' ),
        '90631' => array( 'rate' => 8.25, 'city' => 'La Habra', 'state' => 'CA' ),
        '90680' => array( 'rate' => 8.75, 'city' => 'Stanton', 'state' => 'CA' ),
        '92870' => array( 'rate' => 8.75, 'city' => 'Placentia', 'state' => 'CA' ),
        
        // California - Riverside & Desert Cities
        '92262' => array( 'rate' => 9.25, 'city' => 'Palm Springs', 'state' => 'CA' ),
        '92264' => array( 'rate' => 9.25, 'city' => 'Palm Springs', 'state' => 'CA' ),
        '92234' => array( 'rate' => 8.75, 'city' => 'Cathedral City', 'state' => 'CA' ),
        '92201' => array( 'rate' => 8.75, 'city' => 'Indio', 'state' => 'CA' ),
        '92203' => array( 'rate' => 8.75, 'city' => 'Indio', 'state' => 'CA' ),
        '92236' => array( 'rate' => 8.75, 'city' => 'Coachella', 'state' => 'CA' ),
        
        // California - Bay Area Cities
        '94102' => array( 'rate' => 8.625, 'city' => 'San Francisco', 'state' => 'CA' ),
        '94103' => array( 'rate' => 8.625, 'city' => 'San Francisco', 'state' => 'CA' ),
        '94107' => array( 'rate' => 8.625, 'city' => 'San Francisco', 'state' => 'CA' ),
        '94110' => array( 'rate' => 8.625, 'city' => 'San Francisco', 'state' => 'CA' ),
        '94601' => array( 'rate' => 10.25, 'city' => 'Oakland', 'state' => 'CA' ),
        '94607' => array( 'rate' => 10.25, 'city' => 'Oakland', 'state' => 'CA' ),
        '94611' => array( 'rate' => 10.25, 'city' => 'Oakland', 'state' => 'CA' ),
        '94612' => array( 'rate' => 10.25, 'city' => 'Oakland', 'state' => 'CA' ),
        '94702' => array( 'rate' => 9.75, 'city' => 'Berkeley', 'state' => 'CA' ),
        '94703' => array( 'rate' => 9.75, 'city' => 'Berkeley', 'state' => 'CA' ),
        '94704' => array( 'rate' => 9.75, 'city' => 'Berkeley', 'state' => 'CA' ),
        '95110' => array( 'rate' => 9.375, 'city' => 'San Jose', 'state' => 'CA' ),
        '95112' => array( 'rate' => 9.375, 'city' => 'San Jose', 'state' => 'CA' ),
        '95123' => array( 'rate' => 9.375, 'city' => 'San Jose', 'state' => 'CA' ),
        '95125' => array( 'rate' => 9.375, 'city' => 'San Jose', 'state' => 'CA' ),
        
        // Out of State Major Renovation Metros
        '75001' => array( 'rate' => 8.25, 'city' => 'Dallas', 'state' => 'TX' ),
        '77002' => array( 'rate' => 8.25, 'city' => 'Houston', 'state' => 'TX' ),
        '78701' => array( 'rate' => 8.25, 'city' => 'Austin', 'state' => 'TX' ),
        '78201' => array( 'rate' => 8.25, 'city' => 'San Antonio', 'state' => 'TX' ),
        '33101' => array( 'rate' => 7.00, 'city' => 'Miami', 'state' => 'FL' ),
        '32801' => array( 'rate' => 6.50, 'city' => 'Orlando', 'state' => 'FL' ),
        '33601' => array( 'rate' => 7.50, 'city' => 'Tampa', 'state' => 'FL' ),
        '85001' => array( 'rate' => 8.60, 'city' => 'Phoenix', 'state' => 'AZ' ),
        '85251' => array( 'rate' => 8.05, 'city' => 'Scottsdale', 'state' => 'AZ' ),
        '85701' => array( 'rate' => 8.70, 'city' => 'Tucson', 'state' => 'AZ' ),
        '89101' => array( 'rate' => 8.375, 'city' => 'Las Vegas', 'state' => 'NV' ),
        '89501' => array( 'rate' => 8.265, 'city' => 'Reno', 'state' => 'NV' ),
        '98101' => array( 'rate' => 10.35, 'city' => 'Seattle', 'state' => 'WA' ),
        '80202' => array( 'rate' => 8.81, 'city' => 'Denver', 'state' => 'CO' ),
        '30301' => array( 'rate' => 8.90, 'city' => 'Atlanta', 'state' => 'GA' ),
        '28202' => array( 'rate' => 7.25, 'city' => 'Charlotte', 'state' => 'NC' ),
        '60601' => array( 'rate' => 10.25, 'city' => 'Chicago', 'state' => 'IL' ),
        '43215' => array( 'rate' => 7.50, 'city' => 'Columbus', 'state' => 'OH' ),
        '10001' => array( 'rate' => 8.875, 'city' => 'New York', 'state' => 'NY' ),
        '97201' => array( 'rate' => 0.00, 'city' => 'Portland', 'state' => 'OR' ),
    );

    if ( ! empty( $clean_zip ) && isset( $specific_zips[ $clean_zip ] ) ) {
        $m = $specific_zips[ $clean_zip ];
        $loc_name = ! empty( $city_clean ) ? $city_clean : $m['city'];
        return array(
            'rate'  => (float) $m['rate'],
            'city'  => $m['city'],
            'state' => $m['state'],
            'zip'   => $clean_zip,
            'label' => sprintf( 'Sales Tax (%s, %s %s - %s%%)', $loc_name, $m['state'], $clean_zip, number_format( $m['rate'], $m['rate'] == (int)$m['rate'] ? 1 : 2 ) ),
        );
    }

    // 2. 3-DIGIT ZIP PREFIX JURISDICTIONS (County & Regional Rates)
    $prefix3 = substr( $clean_zip, 0, 3 );
    $prefix_rates = array(
        // California Counties
        '900' => array( 'rate' => 9.50, 'county' => 'Los Angeles County', 'state' => 'CA' ),
        '901' => array( 'rate' => 9.50, 'county' => 'Los Angeles County', 'state' => 'CA' ),
        '902' => array( 'rate' => 9.50, 'county' => 'Los Angeles County', 'state' => 'CA' ),
        '903' => array( 'rate' => 9.50, 'county' => 'Inglewood / LA', 'state' => 'CA' ),
        '904' => array( 'rate' => 10.25, 'county' => 'Santa Monica / LA', 'state' => 'CA' ),
        '905' => array( 'rate' => 9.50, 'county' => 'Torrance / LA', 'state' => 'CA' ),
        '906' => array( 'rate' => 8.75, 'county' => 'Orange / LA Border', 'state' => 'CA' ),
        '907' => array( 'rate' => 9.50, 'county' => 'South Bay / LA', 'state' => 'CA' ),
        '908' => array( 'rate' => 10.25, 'county' => 'Long Beach / LA', 'state' => 'CA' ),
        '910' => array( 'rate' => 9.50, 'county' => 'Pasadena / LA', 'state' => 'CA' ),
        '911' => array( 'rate' => 10.25, 'county' => 'Pasadena / LA', 'state' => 'CA' ),
        '912' => array( 'rate' => 10.25, 'county' => 'Glendale / LA', 'state' => 'CA' ),
        '913' => array( 'rate' => 9.50, 'county' => 'San Fernando Valley', 'state' => 'CA' ),
        '914' => array( 'rate' => 9.50, 'county' => 'Van Nuys / LA', 'state' => 'CA' ),
        '915' => array( 'rate' => 10.25, 'county' => 'Burbank / LA', 'state' => 'CA' ),
        '916' => array( 'rate' => 9.50, 'county' => 'North Hollywood / LA', 'state' => 'CA' ),
        '917' => array( 'rate' => 9.50, 'county' => 'San Gabriel Valley', 'state' => 'CA' ),
        '918' => array( 'rate' => 9.50, 'county' => 'Alhambra / LA', 'state' => 'CA' ),
        '919' => array( 'rate' => 7.75, 'county' => 'San Diego County', 'state' => 'CA' ),
        '920' => array( 'rate' => 7.75, 'county' => 'North San Diego County', 'state' => 'CA' ),
        '921' => array( 'rate' => 7.75, 'county' => 'San Diego City / Metro', 'state' => 'CA' ),
        '922' => array( 'rate' => 8.75, 'county' => 'Riverside Desert', 'state' => 'CA' ),
        '923' => array( 'rate' => 7.75, 'county' => 'San Bernardino County', 'state' => 'CA' ),
        '924' => array( 'rate' => 8.75, 'county' => 'San Bernardino City', 'state' => 'CA' ),
        '925' => array( 'rate' => 7.75, 'county' => 'Riverside County', 'state' => 'CA' ),
        '926' => array( 'rate' => 7.75, 'county' => 'Orange County (South/Central)', 'state' => 'CA' ),
        '927' => array( 'rate' => 9.25, 'county' => 'Santa Ana / Orange County', 'state' => 'CA' ),
        '928' => array( 'rate' => 7.75, 'county' => 'Orange County (North)', 'state' => 'CA' ),
        '930' => array( 'rate' => 7.25, 'county' => 'Ventura County', 'state' => 'CA' ),
        '931' => array( 'rate' => 8.75, 'county' => 'Santa Barbara County', 'state' => 'CA' ),
        '932' => array( 'rate' => 7.75, 'county' => 'Tulare / Kings County', 'state' => 'CA' ),
        '933' => array( 'rate' => 8.25, 'county' => 'Bakersfield / Kern', 'state' => 'CA' ),
        '934' => array( 'rate' => 7.75, 'county' => 'San Luis Obispo County', 'state' => 'CA' ),
        '935' => array( 'rate' => 7.75, 'county' => 'Antelope Valley / Mojave', 'state' => 'CA' ),
        '936' => array( 'rate' => 7.975, 'county' => 'Fresno County', 'state' => 'CA' ),
        '937' => array( 'rate' => 8.35, 'county' => 'Fresno City', 'state' => 'CA' ),
        '939' => array( 'rate' => 8.75, 'county' => 'Monterey County', 'state' => 'CA' ),
        '940' => array( 'rate' => 9.375, 'county' => 'San Mateo County', 'state' => 'CA' ),
        '941' => array( 'rate' => 8.625, 'county' => 'San Francisco', 'state' => 'CA' ),
        '942' => array( 'rate' => 8.75, 'county' => 'Sacramento', 'state' => 'CA' ),
        '943' => array( 'rate' => 9.125, 'county' => 'Palo Alto / Santa Clara', 'state' => 'CA' ),
        '944' => array( 'rate' => 9.625, 'county' => 'San Mateo City', 'state' => 'CA' ),
        '945' => array( 'rate' => 8.75, 'county' => 'East Bay / Contra Costa', 'state' => 'CA' ),
        '946' => array( 'rate' => 10.25, 'county' => 'Oakland / Alameda', 'state' => 'CA' ),
        '947' => array( 'rate' => 9.75, 'county' => 'Berkeley / Alameda', 'state' => 'CA' ),
        '948' => array( 'rate' => 9.75, 'county' => 'Richmond / Contra Costa', 'state' => 'CA' ),
        '949' => array( 'rate' => 8.50, 'county' => 'Marin County', 'state' => 'CA' ),
        '950' => array( 'rate' => 9.125, 'county' => 'Silicon Valley / Santa Cruz', 'state' => 'CA' ),
        '951' => array( 'rate' => 9.375, 'county' => 'San Jose / Santa Clara', 'state' => 'CA' ),
        '952' => array( 'rate' => 9.00, 'county' => 'Stockton / San Joaquin', 'state' => 'CA' ),
        '953' => array( 'rate' => 7.875, 'county' => 'Modesto / Stanislaus', 'state' => 'CA' ),
        '954' => array( 'rate' => 8.50, 'county' => 'Santa Rosa / Sonoma', 'state' => 'CA' ),
        '955' => array( 'rate' => 7.75, 'county' => 'Eureka / Humboldt', 'state' => 'CA' ),
        '956' => array( 'rate' => 7.75, 'county' => 'Sacramento Suburbs / Yolo', 'state' => 'CA' ),
        '957' => array( 'rate' => 7.75, 'county' => 'Elk Grove / Placer', 'state' => 'CA' ),
        '958' => array( 'rate' => 8.75, 'county' => 'Sacramento City', 'state' => 'CA' ),
        '959' => array( 'rate' => 7.75, 'county' => 'Chico / Butte', 'state' => 'CA' ),
        '960' => array( 'rate' => 7.25, 'county' => 'Redding / Shasta', 'state' => 'CA' ),
        
        // Texas Regional Prefixes
        '750' => array( 'rate' => 8.25, 'county' => 'Dallas Metro', 'state' => 'TX' ),
        '751' => array( 'rate' => 8.25, 'county' => 'Dallas East', 'state' => 'TX' ),
        '752' => array( 'rate' => 8.25, 'county' => 'Dallas City', 'state' => 'TX' ),
        '753' => array( 'rate' => 8.25, 'county' => 'Dallas Central', 'state' => 'TX' ),
        '760' => array( 'rate' => 8.25, 'county' => 'Arlington / Tarrant', 'state' => 'TX' ),
        '761' => array( 'rate' => 8.25, 'county' => 'Fort Worth', 'state' => 'TX' ),
        '770' => array( 'rate' => 8.25, 'county' => 'Houston / Harris', 'state' => 'TX' ),
        '772' => array( 'rate' => 8.25, 'county' => 'Houston Central', 'state' => 'TX' ),
        '773' => array( 'rate' => 8.25, 'county' => 'North Houston', 'state' => 'TX' ),
        '774' => array( 'rate' => 8.25, 'county' => 'Southwest Houston', 'state' => 'TX' ),
        '775' => array( 'rate' => 8.25, 'county' => 'Southeast Houston', 'state' => 'TX' ),
        '782' => array( 'rate' => 8.25, 'county' => 'San Antonio / Bexar', 'state' => 'TX' ),
        '786' => array( 'rate' => 8.25, 'county' => 'Austin Suburbs', 'state' => 'TX' ),
        '787' => array( 'rate' => 8.25, 'county' => 'Austin / Travis', 'state' => 'TX' ),
        '799' => array( 'rate' => 8.25, 'county' => 'El Paso', 'state' => 'TX' ),
        
        // Florida Regional Prefixes
        '330' => array( 'rate' => 7.00, 'county' => 'Miami-Dade / Keys', 'state' => 'FL' ),
        '331' => array( 'rate' => 7.00, 'county' => 'Miami-Dade', 'state' => 'FL' ),
        '332' => array( 'rate' => 7.00, 'county' => 'Miami Metro', 'state' => 'FL' ),
        '333' => array( 'rate' => 7.00, 'county' => 'Fort Lauderdale / Broward', 'state' => 'FL' ),
        '334' => array( 'rate' => 7.00, 'county' => 'Palm Beach County', 'state' => 'FL' ),
        '328' => array( 'rate' => 6.50, 'county' => 'Orlando / Orange County', 'state' => 'FL' ),
        '347' => array( 'rate' => 7.00, 'county' => 'Kissimmee / Osceola', 'state' => 'FL' ),
        '336' => array( 'rate' => 7.50, 'county' => 'Tampa / Hillsborough', 'state' => 'FL' ),
        '337' => array( 'rate' => 7.00, 'county' => 'St. Petersburg / Pinellas', 'state' => 'FL' ),
        '320' => array( 'rate' => 7.50, 'county' => 'Jacksonville Suburbs', 'state' => 'FL' ),
        '322' => array( 'rate' => 7.50, 'county' => 'Jacksonville / Duval', 'state' => 'FL' ),
        '339' => array( 'rate' => 6.50, 'county' => 'Fort Myers / Lee', 'state' => 'FL' ),
        '341' => array( 'rate' => 7.00, 'county' => 'Naples / Collier', 'state' => 'FL' ),
        '342' => array( 'rate' => 7.00, 'county' => 'Sarasota County', 'state' => 'FL' ),
        
        // Arizona Regional Prefixes
        '850' => array( 'rate' => 8.60, 'county' => 'Phoenix City', 'state' => 'AZ' ),
        '852' => array( 'rate' => 8.05, 'county' => 'Scottsdale / Mesa / Gilbert', 'state' => 'AZ' ),
        '853' => array( 'rate' => 8.60, 'county' => 'Glendale / West Valley', 'state' => 'AZ' ),
        '857' => array( 'rate' => 8.70, 'county' => 'Tucson / Pima', 'state' => 'AZ' ),
        '860' => array( 'rate' => 9.18, 'county' => 'Flagstaff / Coconino', 'state' => 'AZ' ),
        
        // Nevada Regional Prefixes
        '890' => array( 'rate' => 8.375, 'county' => 'Henderson / Clark', 'state' => 'NV' ),
        '891' => array( 'rate' => 8.375, 'county' => 'Las Vegas / Clark', 'state' => 'NV' ),
        '894' => array( 'rate' => 8.265, 'county' => 'Sparks / Washoe', 'state' => 'NV' ),
        '895' => array( 'rate' => 8.265, 'county' => 'Reno / Washoe', 'state' => 'NV' ),
        '897' => array( 'rate' => 7.60, 'county' => 'Carson City', 'state' => 'NV' ),
        
        // Washington State
        '980' => array( 'rate' => 10.20, 'county' => 'Bellevue / Eastside', 'state' => 'WA' ),
        '981' => array( 'rate' => 10.35, 'county' => 'Seattle / King', 'state' => 'WA' ),
        '984' => array( 'rate' => 10.30, 'county' => 'Tacoma / Pierce', 'state' => 'WA' ),
        '992' => array( 'rate' => 9.00, 'county' => 'Spokane', 'state' => 'WA' ),
        
        // Colorado
        '800' => array( 'rate' => 8.50, 'county' => 'Aurora / Denver Suburbs', 'state' => 'CO' ),
        '801' => array( 'rate' => 7.75, 'county' => 'Littleton / Arapahoe', 'state' => 'CO' ),
        '802' => array( 'rate' => 8.81, 'county' => 'Denver City & County', 'state' => 'CO' ),
        '803' => array( 'rate' => 9.05, 'county' => 'Boulder', 'state' => 'CO' ),
        '809' => array( 'rate' => 8.20, 'county' => 'Colorado Springs', 'state' => 'CO' ),
        
        // Georgia
        '300' => array( 'rate' => 6.00, 'county' => 'Marietta / Gwinnett', 'state' => 'GA' ),
        '303' => array( 'rate' => 8.90, 'county' => 'Atlanta / Fulton', 'state' => 'GA' ),
        
        // North Carolina
        '282' => array( 'rate' => 7.25, 'county' => 'Charlotte / Mecklenburg', 'state' => 'NC' ),
        '276' => array( 'rate' => 7.25, 'county' => 'Raleigh / Wake', 'state' => 'NC' ),
        '277' => array( 'rate' => 7.50, 'county' => 'Durham', 'state' => 'NC' ),
        
        // Illinois
        '606' => array( 'rate' => 10.25, 'county' => 'Chicago / Cook', 'state' => 'IL' ),
        '601' => array( 'rate' => 8.25, 'county' => 'DuPage / Kane', 'state' => 'IL' ),
        
        // New York
        '100' => array( 'rate' => 8.875, 'county' => 'New York City (Manhattan)', 'state' => 'NY' ),
        '104' => array( 'rate' => 8.875, 'county' => 'New York City (Bronx)', 'state' => 'NY' ),
        '111' => array( 'rate' => 8.875, 'county' => 'New York City (Queens)', 'state' => 'NY' ),
        '112' => array( 'rate' => 8.875, 'county' => 'New York City (Brooklyn)', 'state' => 'NY' ),
        '103' => array( 'rate' => 8.875, 'county' => 'New York City (Staten Island)', 'state' => 'NY' ),
        '115' => array( 'rate' => 8.625, 'county' => 'Nassau County', 'state' => 'NY' ),
        '117' => array( 'rate' => 8.625, 'county' => 'Suffolk County', 'state' => 'NY' ),
        '105' => array( 'rate' => 8.375, 'county' => 'Westchester', 'state' => 'NY' ),
    );

    if ( ! empty( $prefix3 ) && isset( $prefix_rates[ $prefix3 ] ) ) {
        $p = $prefix_rates[ $prefix3 ];
        $loc_desc = ! empty( $city_clean ) ? $city_clean : $p['county'];
        return array(
            'rate'  => (float) $p['rate'],
            'city'  => $p['county'],
            'state' => $p['state'],
            'zip'   => $clean_zip,
            'label' => sprintf( 'Sales Tax (%s, %s %s - %s%%)', $loc_desc, $p['state'], $clean_zip, number_format( $p['rate'], $p['rate'] == (int)$p['rate'] ? 1 : 2 ) ),
        );
    }

    // 3. 50-STATE BASELINE WITH AVERAGE LOCAL MUNICIPAL TAXES
    $state_baselines = array(
        'AL' => array( 'rate' => 9.25, 'name' => 'Alabama' ),
        'AK' => array( 'rate' => 0.00, 'name' => 'Alaska' ),
        'AZ' => array( 'rate' => 8.40, 'name' => 'Arizona' ),
        'AR' => array( 'rate' => 9.50, 'name' => 'Arkansas' ),
        'CA' => array( 'rate' => 7.75, 'name' => 'California' ),
        'CO' => array( 'rate' => 7.80, 'name' => 'Colorado' ),
        'CT' => array( 'rate' => 6.35, 'name' => 'Connecticut' ),
        'DE' => array( 'rate' => 0.00, 'name' => 'Delaware' ),
        'DC' => array( 'rate' => 6.00, 'name' => 'District of Columbia' ),
        'FL' => array( 'rate' => 7.00, 'name' => 'Florida' ),
        'GA' => array( 'rate' => 7.35, 'name' => 'Georgia' ),
        'HI' => array( 'rate' => 4.50, 'name' => 'Hawaii' ),
        'ID' => array( 'rate' => 6.00, 'name' => 'Idaho' ),
        'IL' => array( 'rate' => 8.85, 'name' => 'Illinois' ),
        'IN' => array( 'rate' => 7.00, 'name' => 'Indiana' ),
        'IA' => array( 'rate' => 7.00, 'name' => 'Iowa' ),
        'KS' => array( 'rate' => 8.70, 'name' => 'Kansas' ),
        'KY' => array( 'rate' => 6.00, 'name' => 'Kentucky' ),
        'LA' => array( 'rate' => 9.55, 'name' => 'Louisiana' ),
        'ME' => array( 'rate' => 5.50, 'name' => 'Maine' ),
        'MD' => array( 'rate' => 6.00, 'name' => 'Maryland' ),
        'MA' => array( 'rate' => 6.25, 'name' => 'Massachusetts' ),
        'MI' => array( 'rate' => 6.00, 'name' => 'Michigan' ),
        'MN' => array( 'rate' => 7.50, 'name' => 'Minnesota' ),
        'MS' => array( 'rate' => 7.00, 'name' => 'Mississippi' ),
        'MO' => array( 'rate' => 8.35, 'name' => 'Missouri' ),
        'MT' => array( 'rate' => 0.00, 'name' => 'Montana' ),
        'NE' => array( 'rate' => 6.95, 'name' => 'Nebraska' ),
        'NV' => array( 'rate' => 8.23, 'name' => 'Nevada' ),
        'NH' => array( 'rate' => 0.00, 'name' => 'New Hampshire' ),
        'NJ' => array( 'rate' => 6.625, 'name' => 'New Jersey' ),
        'NM' => array( 'rate' => 7.75, 'name' => 'New Mexico' ),
        'NY' => array( 'rate' => 8.52, 'name' => 'New York' ),
        'NC' => array( 'rate' => 7.00, 'name' => 'North Carolina' ),
        'ND' => array( 'rate' => 6.95, 'name' => 'North Dakota' ),
        'OH' => array( 'rate' => 7.25, 'name' => 'Ohio' ),
        'OK' => array( 'rate' => 8.95, 'name' => 'Oklahoma' ),
        'OR' => array( 'rate' => 0.00, 'name' => 'Oregon' ),
        'PA' => array( 'rate' => 6.34, 'name' => 'Pennsylvania' ),
        'RI' => array( 'rate' => 7.00, 'name' => 'Rhode Island' ),
        'SC' => array( 'rate' => 7.45, 'name' => 'South Carolina' ),
        'SD' => array( 'rate' => 6.40, 'name' => 'South Dakota' ),
        'TN' => array( 'rate' => 9.55, 'name' => 'Tennessee' ),
        'TX' => array( 'rate' => 8.20, 'name' => 'Texas' ),
        'UT' => array( 'rate' => 7.20, 'name' => 'Utah' ),
        'VT' => array( 'rate' => 6.25, 'name' => 'Vermont' ),
        'VA' => array( 'rate' => 5.75, 'name' => 'Virginia' ),
        'WA' => array( 'rate' => 9.30, 'name' => 'Washington' ),
        'WV' => array( 'rate' => 6.55, 'name' => 'West Virginia' ),
        'WI' => array( 'rate' => 5.45, 'name' => 'Wisconsin' ),
        'WY' => array( 'rate' => 5.35, 'name' => 'Wyoming' ),
    );

    if ( ! empty( $state_upper ) && isset( $state_baselines[ $state_upper ] ) ) {
        $sb = $state_baselines[ $state_upper ];
        $loc_desc = ! empty( $clean_zip ) ? ( ! empty( $city_clean ) ? $city_clean . ', ' . $state_upper . ' ' . $clean_zip : $state_upper . ' ' . $clean_zip ) : ( ! empty( $city_clean ) ? $city_clean . ', ' . $state_upper : $sb['name'] );
        return array(
            'rate'  => (float) $sb['rate'],
            'city'  => ! empty( $city_clean ) ? $city_clean : $sb['name'],
            'state' => $state_upper,
            'zip'   => $clean_zip,
            'label' => sprintf( 'Sales Tax (%s - %s%%)', $loc_desc, number_format( $sb['rate'], $sb['rate'] == (int)$sb['rate'] ? 1 : 2 ) ),
        );
    }

    // Default Fallback: FixFlip Default CA Sales Tax
    return array(
        'rate'  => 7.75,
        'city'  => 'Irvine',
        'state' => 'CA',
        'zip'   => '92618',
        'label' => 'Sales Tax (Irvine, CA 92618 - 7.75%)',
    );
}

/**
 * Synchronize destination address fields during checkout AJAX review updates
 */
add_action( 'woocommerce_checkout_update_order_review', 'fixflip_sync_checkout_tax_address', 1 );
function fixflip_sync_checkout_tax_address( $post_data ) {
    if ( empty( $post_data ) ) return;
    wp_parse_str( $post_data, $data );
    if ( empty( $data ) || ! is_array( $data ) ) return;

    $ship_diff = ! empty( $data['ship_to_different_address'] );
    $postcode = '';
    $state    = '';
    $city     = '';

    if ( $ship_diff && ! empty( $data['shipping_postcode'] ) ) {
        $postcode = sanitize_text_field( $data['shipping_postcode'] );
        $state    = ! empty( $data['shipping_state'] ) ? sanitize_text_field( $data['shipping_state'] ) : '';
        $city     = ! empty( $data['shipping_city'] ) ? sanitize_text_field( $data['shipping_city'] ) : '';
    } elseif ( ! empty( $data['billing_postcode'] ) ) {
        $postcode = sanitize_text_field( $data['billing_postcode'] );
        $state    = ! empty( $data['billing_state'] ) ? sanitize_text_field( $data['billing_state'] ) : '';
        $city     = ! empty( $data['billing_city'] ) ? sanitize_text_field( $data['billing_city'] ) : '';
    } elseif ( ! empty( $data['shipping_postcode'] ) ) {
        $postcode = sanitize_text_field( $data['shipping_postcode'] );
        $state    = ! empty( $data['shipping_state'] ) ? sanitize_text_field( $data['shipping_state'] ) : '';
        $city     = ! empty( $data['shipping_city'] ) ? sanitize_text_field( $data['shipping_city'] ) : '';
    }

    if ( ! empty( $postcode ) ) {
        if ( empty( $state ) ) {
            $state = fixflip_zip_to_state( $postcode );
        }

        if ( function_exists( 'WC' ) && WC()->customer ) {
            WC()->customer->set_shipping_postcode( $postcode );
            WC()->customer->set_billing_postcode( $postcode );
            if ( ! empty( $state ) ) {
                WC()->customer->set_shipping_state( $state );
                WC()->customer->set_billing_state( $state );
            }
            if ( ! empty( $city ) ) {
                WC()->customer->set_shipping_city( $city );
                WC()->customer->set_billing_city( $city );
            }
            WC()->customer->set_shipping_country( 'US' );
            WC()->customer->set_billing_country( 'US' );
        }

        $rate_info = fixflip_lookup_zip_tax_rate( $postcode, $state, $city );
        if ( $rate_info ) {
            $GLOBALS['fixflip_active_tax_label'] = $rate_info['label'];
            $GLOBALS['fixflip_active_tax_rate']  = $rate_info['rate'];
        }
    }
}

/**
 * Hook into WooCommerce find_rates to calculate destination tax dynamically
 */
add_filter( 'woocommerce_find_rates', 'fixflip_dynamic_destination_tax_rates', 99, 2 );
function fixflip_dynamic_destination_tax_rates( $matched_tax_rates, $args ) {
    // If Stripe Tax for WooCommerce plugin is active and enabled, let Stripe Tax calculate authoritative rates
    if ( class_exists( '\Stripe\StripeTaxForWooCommerce\WordPress\Options' ) && \Stripe\StripeTaxForWooCommerce\WordPress\Options::is_live_mode_enabled() ) {
        return $matched_tax_rates;
    }

    $country  = strtoupper( trim( isset( $args['country'] ) ? $args['country'] : 'US' ) );
    $state    = strtoupper( trim( isset( $args['state'] ) ? $args['state'] : '' ) );
    $postcode = trim( isset( $args['postcode'] ) ? $args['postcode'] : '' );
    $city     = trim( isset( $args['city'] ) ? $args['city'] : '' );

    // If $_POST['post_data'] exists (AJAX update_order_review), extract destination ZIP immediately
    if ( ! empty( $_POST['post_data'] ) ) {
        wp_parse_str( $_POST['post_data'], $checkout_post );
        $ship_diff = ! empty( $checkout_post['ship_to_different_address'] );
        if ( $ship_diff && ! empty( $checkout_post['shipping_postcode'] ) ) {
            $postcode = sanitize_text_field( $checkout_post['shipping_postcode'] );
            $state    = ! empty( $checkout_post['shipping_state'] ) ? sanitize_text_field( $checkout_post['shipping_state'] ) : $state;
            $city     = ! empty( $checkout_post['shipping_city'] ) ? sanitize_text_field( $checkout_post['shipping_city'] ) : $city;
        } elseif ( ! empty( $checkout_post['billing_postcode'] ) ) {
            $postcode = sanitize_text_field( $checkout_post['billing_postcode'] );
            $state    = ! empty( $checkout_post['billing_state'] ) ? sanitize_text_field( $checkout_post['billing_state'] ) : $state;
            $city     = ! empty( $checkout_post['billing_city'] ) ? sanitize_text_field( $checkout_post['billing_city'] ) : $city;
        } elseif ( ! empty( $checkout_post['shipping_postcode'] ) ) {
            $postcode = sanitize_text_field( $checkout_post['shipping_postcode'] );
            $state    = ! empty( $checkout_post['shipping_state'] ) ? sanitize_text_field( $checkout_post['shipping_state'] ) : $state;
            $city     = ! empty( $checkout_post['shipping_city'] ) ? sanitize_text_field( $checkout_post['shipping_city'] ) : $city;
        }
    }

    // If args are blank, check session or customer address
    if ( empty( $postcode ) && function_exists( 'WC' ) && WC()->customer ) {
        $postcode = WC()->customer->get_shipping_postcode() ?: WC()->customer->get_billing_postcode();
        $state    = WC()->customer->get_shipping_state() ?: WC()->customer->get_billing_state();
        $city     = WC()->customer->get_shipping_city() ?: WC()->customer->get_billing_city();
        $country  = WC()->customer->get_shipping_country() ?: ( WC()->customer->get_billing_country() ?: 'US' );
    }

    if ( ! empty( $country ) && $country !== 'US' ) {
        return $matched_tax_rates;
    }

    $rate_info = fixflip_lookup_zip_tax_rate( $postcode, $state, $city );
    if ( $rate_info ) {
        // Cache dynamic label in request static for woocommerce_rate_label hook
        $GLOBALS['fixflip_active_tax_label'] = $rate_info['label'];
        $GLOBALS['fixflip_active_tax_rate']  = $rate_info['rate'];

        if ( $rate_info['rate'] <= 0 ) {
            return array();
        }

        return array(
            1 => array(
                'rate'     => (float) $rate_info['rate'],
                'label'    => $rate_info['label'],
                'shipping' => 'no', // Sales tax applies to materials; freight has transparent dedicated line
                'compound' => 'no',
            )
        );
    }

    return $matched_tax_rates;
}

/**
 * Dynamically filter the displayed tax rate label and code in Order Review & Cart
 */
add_filter( 'woocommerce_rate_label', 'fixflip_dynamic_tax_rate_label_output', 99, 2 );
add_filter( 'woocommerce_rate_code', 'fixflip_dynamic_tax_rate_label_output', 99, 2 );
function fixflip_dynamic_tax_rate_label_output( $label, $rate_id ) {
    // If Stripe Tax for WooCommerce plugin is active, preserve its exact jurisdictional labels
    if ( class_exists( '\Stripe\StripeTaxForWooCommerce\WordPress\Options' ) && \Stripe\StripeTaxForWooCommerce\WordPress\Options::is_live_mode_enabled() ) {
        return $label;
    }

    if ( ! empty( $GLOBALS['fixflip_active_tax_label'] ) ) {
        return $GLOBALS['fixflip_active_tax_label'];
    }

    // Lookup based on current customer location
    if ( function_exists( 'WC' ) && WC()->customer ) {
        $postcode = WC()->customer->get_shipping_postcode() ?: WC()->customer->get_billing_postcode();
        $state    = WC()->customer->get_shipping_state() ?: WC()->customer->get_billing_state();
        $city     = WC()->customer->get_shipping_city() ?: WC()->customer->get_billing_city();
        $rate_info = fixflip_lookup_zip_tax_rate( $postcode, $state, $city );
        if ( $rate_info ) {
            return $rate_info['label'];
        }
    }

    return $label;
}

/**
 * Client-Side JavaScript: Auto-trigger update_checkout as soon as ZIP code or address changes
 */
add_action( 'wp_footer', 'fixflip_auto_recalculate_tax_on_zip_change', 999 );
function fixflip_auto_recalculate_tax_on_zip_change() {
    if ( is_checkout() ) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            function triggerCheckoutUpdate() {
                if (typeof jQuery !== 'undefined' && typeof jQuery(document.body).trigger === 'function') {
                    jQuery(document.body).trigger('update_checkout');
                }
            }

            // Trigger when 5 digits are entered into ZIP code field
            document.body.addEventListener('input', function(e) {
                if (e.target && (e.target.id === 'billing_postcode' || e.target.id === 'shipping_postcode')) {
                    const clean = e.target.value.replace(/\D/g, '');
                    if (clean.length === 5) {
                        triggerCheckoutUpdate();
                    }
                }
            });

            // Trigger on change or blur of city, state, or ZIP
            document.body.addEventListener('change', function(e) {
                if (e.target && /^(billing|shipping)_(postcode|state|city|address_1)$/.test(e.target.id)) {
                    triggerCheckoutUpdate();
                }
            });

            document.body.addEventListener('blur', function(e) {
                if (e.target && (e.target.id === 'billing_postcode' || e.target.id === 'shipping_postcode')) {
                    triggerCheckoutUpdate();
                }
            }, true);
        });
        </script>
        <?php
    }
}
