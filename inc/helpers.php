<?php 

function mimiadm_assign_random_avatar($uid) {
    $avatars = mimiadm_get_available_avatars(0);
    shuffle($avatars);
   
    foreach ($avatars as $item) {
        $id = $item['image'];        
        break;
    }

    $avas = get_field('avatars', 'options');    
    
    foreach ($avas as $key => $ava) {
        if ($ava['image'] == $id) {            
            $avas[$key]['uid'] = $uid;
        }
    }   

    update_field('avatars', $avas, 'options');
}

function mimiadm_assign_user_avatar($uid, $image) {
    $avas = get_field('avatars', 'options');    

    foreach ($avas as $key => $ava) {
        if ($ava['image'] == $image) {            
            $avas[$key]['uid'] = $uid;
        } else {
            if ($avas[$key]['uid'] == $uid) {
                $avas[$key]['uid'] = "";
            }
        }
    }   

    update_field('avatars', $avas, 'options');
}

function mimiadm_get_user_avatar_id($uid) {

    $id = false;
    $avas = get_field('avatars', 'options');

    foreach ($avas as $ava) {
        if ($ava['uid'] == $uid) {
            $id = $ava['image'];
        }
    }

    return $id;
}

function mimiadm_get_user_avatar_url($uid = false, $size = 'medium') {   
    if (!$uid) {
        $uid = get_current_user_id();
    }

    $id = mimiadm_get_user_avatar_id($uid);

    $url = "";
    $avas = get_field('avatars', 'options');
    foreach ($avas as $ava) {
        if ($ava['uid'] == $uid) {
            $id = $ava['image'];
        }
    }

    if ($id) {
        $url = wp_get_attachment_image_url( $id, $size );    
    }
    
    return $url;
}

function mimiadm_get_available_avatars($uid) {
    
    $avas = get_field('avatars', 'options');
    $arr = array();

    foreach ($avas as $ava) {
        if (!$ava['uid'] || ($ava['uid'] == $uid)) {
            $url = wp_get_attachment_image_url( $ava['image'], 'thumbnail');  
            array_push($arr, array(
                'url' => $url,
                'image' => $ava['image'],
            ));
        }
    }    

    return $arr;
}

function mimiadm_get_all_santas() {
    $users = get_users([
        'role' => 'santa'
    ]);

    return $users;
}


function sanitize_username_cyrillic($username) {
    // Check if username contains Cyrillic letters
    if (preg_match('/[А-Яа-яЁё]/u', $username)) {
        // Transliterate Cyrillic to Latin
        $transliteration = [
            'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'E','Ж'=>'Zh','З'=>'Z','И'=>'I','Й'=>'Y',
            'К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F',
            'Х'=>'Kh','Ц'=>'Ts','Ч'=>'Ch','Ш'=>'Sh','Щ'=>'Shch','Ъ'=>'','Ы'=>'Y','Ь'=>'','Э'=>'E','Ю'=>'Yu','Я'=>'Ya',
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y',
            'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f',
            'х'=>'kh','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'shch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya'
        ];
        $username = strtr($username, $transliteration);
        // Optional: remove any non-alphanumeric characters
        $username = preg_replace('/[^A-Za-z0-9\-_]/', '', $username);
    }
    return $username;
}