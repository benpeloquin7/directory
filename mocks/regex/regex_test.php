<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$terms = array(
    '303-929-0487',
    '3039290487',
    '(303)929-0487',
    '(303) 929-0487',
    '(303)9290487',
    '(303)929 0487',
    '(303)-929-0487',
    '303.929.0487',
    '303*929*0487',
    '929-0487',
    '9290487',
    'Mike Newell',
    'mike',
    'mike 3039290487 newell',
    'mike (303) 929-0487 newell',
    'mike (303)-929-0487 newell',
    'mike_newell@gspsf.com',
    'mike newell mike_newell@gspsf.com',
    'mike_newell',
    'Mike Newell mike_newell mike_newell@gspsf.com',
    'mike newell mike_newell mike_newell@gspsf.com 3039290487',
    'mike newell mike_newell mike_newell@gspsf.com 3039290487 7_141',
    '7-141 mike newell mike_newell mike_newell@gspsf.com 3039290487',
    '141',
    'C45',
    'E45',
    '7-141',
    '124A',
    '123C',
    '653E mike_newell jeannine_caesar@gspdet.com rob canfield (303) 475-9613 creative account'
);

for($i = 0; $i < count($terms); $i++) {
    $matches = compile_query($terms[$i]);
    echo '<br />';
    echo 'Matches for string: <strong>' . $terms[$i] . '</strong> are: ';
    echo '<br /><pre>';
    print_r($matches);
    echo '<br /><br /></pre>';
}

function compile_query($phrase) {
    
    $term_arr = explode(' ', $phrase);
    $output = array();
    $types = array();
    $queries = array();
    
    foreach($term_arr as $term) {

        $phone_pattern = '#(([+]?[\(]?[0-9]{3}[\)]?)?.?([0-9]{3}.?[0-9]{4}))#';
        preg_match($phone_pattern, $term, $phone_matches);

        $seat_pattern = '#^[a-zA-Z0-9]?[-]?[0-9]{2,3}[a-zA-Z]?[^a-zA-Z0-9]?#';
        preg_match($seat_pattern, $term, $seat_matches);

        $username_pattern = '#^[a-zA-Z]+_[a-zA-Z]+$#';
        preg_match($username_pattern, $term, $username_matches);
        
        $word_patter = '#^[a-zA-Z]+$#';
        preg_match($word_patter, $term, $word_matches);

        if($phone_matches) {
            $no_symbols_phone = preg_replace('#[^0-9]#i', '', $phone_matches[0]);
            $no_symbols_phone = strval($no_symbols_phone);
            if(strlen($no_symbols_phone) > 7) {
                $formatted_phone = ''.substr($no_symbols_phone, 0, 3) . '-' . substr($no_symbols_phone, 3, 3) . '-' . substr($no_symbols_phone, 6, 4);
            } else {
                $formatted_phone = ''.substr($no_symbols_phone, 0, 3) . '-' . substr($no_symbols_phone, 3, 4);
            }
            $output['phone'][] = $formatted_phone;
            $types[] = 'phone';
            $queries[] = format_phone_query($formatted_phone);
        } else if($seat_matches) {
            $output['seat'] = $seat_matches;
            $types[] = 'seat';
            $queries[] = format_seat_query($seat_matches[0]);
        } else if($username_matches) {
            $output['username'] = $username_matches;
            $types[] = 'username';
            $queries[] = format_username_query($username_matches[0]);
        } else if (filter_var($term, FILTER_VALIDATE_EMAIL)) {
            $output['email'][] =  $term;
            $types[] = 'email';
            $queries[] = format_email_query($term);
        } else if($word_matches) {
            $output['word'][] = $term;
            $types[] = 'word';
            $queries[] = format_word_query($term);
        } else {
            $output[][] = $term;
            $types[] = 'mixed';
            $queries[] = format_mixed_query($term);
        }

    }
        
    $output['types'] = $types;
    $output['queries'] = $queries;
    
    $output['query'] = get_query($queries);
    
    return $output;
}

function format_phone_query($formatted_phone_number) {
    return '(ext LIKE \'%'.$formatted_phone_number.'%\') OR (mobile LIKE \'%'.$formatted_phone_number.'%\')';
}

function format_seat_query($seat) {
    return '(seat LIKE \'%'.$seat.'%\')';
}

function format_username_query($username) {
    return '(userName LIKE \'%'.$username.'%\')';
}

function format_email_query($email) {
    return '(email LIKE \'%'.$email.'%\')';
}

function format_word_query($word) {
    $output = '(firstName LIKE \'%'.$word.'%\') OR ';
    $output .= '(lastName LIKE \'%'.$word.'%\') OR ';
    $output .= '(title LIKE \'%'.$word.'%\') OR ';
    $output .= '(dept LIKE \'%'.$word.'%\') OR ';
    $output .= '(email LIKE \'%'.$word.'%\') OR ';
    $output .= '(seat LIKE \'%'.$word.'%\')';

    return $output;
}

function format_mixed_query($term) {
    $output = '(firstName LIKE \'%'.$term.'%\') OR ';
    $output .= '(lastName LIKE \'%'.$term.'%\') OR ';
    $output .= '(title LIKE \'%'.$term.'%\') OR ';
    $output .= '(dept LIKE \'%'.$term.'%\') OR ';
    $output .= '(email LIKE \'%'.$term.'%\') OR ';
    $output .= '(seat LIKE \'%'.$term.'%\')';

    return $output;
}

function get_query($clauses) {
    
    $append = '';
    
    foreach($clauses as $key => $clause) {
        if($key == 0) {
            $append .= ' ' . $clause . ' ';
        } else {
            $append .= ' OR ' . $clause . ' ';
        }
        
    }
    
    $query = 'SELECT * FROM people WHERE '.$append. ' LIMIT 0, 1000';
    
    return $query;
}

?>
