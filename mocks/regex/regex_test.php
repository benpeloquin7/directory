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
    'mike newell mike_newell mike_newell@gspsf.com 3039290487'
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
    
    foreach($term_arr as $term) {
        
        $phone_pattern = '#(([+]?[\(]?[0-9]{3}[\)]?)?.?([0-9]{3}.?[0-9]{4}))#';
        preg_match($phone_pattern, $term, $phone_matches);
        
        if($phone_matches) {
            $output[] = $phone_matches;
            $types .= ' phone ';
        } elseif (filter_var($term, FILTER_VALIDATE_EMAIL)) {
            $output[] =  array('email' => $term);
            $types .= ' email ';
        } else {
            $output[] = array('no');
        }

    }
    
    $output['types'] = $types;
    
    return $output;
        
};

?>
