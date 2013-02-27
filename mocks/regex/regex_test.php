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
    '123C'
);

for($i = 0; $i < count($terms); $i++) {
    $matches = search_string($terms[$i]);
    echo '<br />';
    echo 'Matches for string: <strong>' . $terms[$i] . '</strong> are: ' . $matches['types'];
    echo '<br /><pre>';
    print_r($matches);
    echo '<br /></pre>';
}

function search_string($phrase) {
    
    $term_arr = explode(' ', $phrase);
    $output = array();
    $types = '';
    
    echo count($term_arr);
    
    if(count($term_arr) > 1) {
        foreach($term_arr as $term) {

            $phone_pattern = '#(([+]?[\(]?[0-9]{3}[\)]?)?.?([0-9]{3}.?[0-9]{4}))#';
            preg_match($phone_pattern, $term, $phone_matches);

            $seat_pattern = '#^[a-zA-Z0-9]?[-]?[0-9]{2,3}[a-zA-Z]?[^a-zA-Z0-9]?#';
            preg_match($seat_pattern, $term, $seat_matches);

            $username_pattern = '#^[a-zA-Z]+_[a-zA-Z]+$#';
            preg_match($username_pattern, $term, $username_matches);

            if($phone_matches) {
                $output['phone'] = $phone_matches;
                $types .= ' phone ';
            } else if($seat_matches) {
                $output['seat'] = $seat_matches;
                $types .= ' seat ';
            } else if($username_matches) {
                $output['username'] = $username_matches;
                $types .= ' username ';
            } else if (filter_var($term, FILTER_VALIDATE_EMAIL)) {
                $output['email'] =  $term;
                $types .= ' email ';
            } else {
                $output[] = array('no');
                $types .= ' multi-term '
            }

        }
    } else {
        $output['single-term'] = $term;
        $types .= ' single-term ';
    }
    
        
    
    $output['types'] = $types;
    
    return $output;
};

?>
