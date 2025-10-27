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