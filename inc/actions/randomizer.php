<?php 

namespace MimimiAdm;

class Randomizer {
    public static function init() {      
        add_action('admin_post_start_the_party', [__CLASS__, 'startTheParty']);    
        add_action('admin_post_email_party', [__CLASS__, 'emailParty']);                                 
    }

    public static function emailParty() {
        if (current_user_can('administrator')) {
            $santas = mimiadm_get_all_santas();
            foreach ($santas as $santa) {
                $kids = get_field('kids', 'user_' . $santa->ID);

                $message = '<h2>Привет! Вот имена счастливчиков:</h2>';

                foreach ($kids as $kid) {
                    $wishlist = get_field('wishlist', 'user_' . $kid['ID']);
                    $message .= '<h3>' . $kid['display_name'] . '</h3>';
                    $message .= '<p>' . $wishlist . '</p>';                
                }

                $to = $santa->user_email;
                $subject = 'Ваши Внучки На АДМ 2026';
                
                $headers = ['Content-Type: text/html; charset=UTF-8'];

                wp_mail($to, $subject, $message, $headers);
            }
        }
        wp_redirect(home_url());
    }

    public static function startTheParty() {

        if (current_user_can('administrator')) {
            $players = [];
            $exceptions = [];
            $santas = mimiadm_get_all_santas();
            foreach ($santas as $santa) {
                array_push($players, $santa->user_email);
                $not = get_field('forbidden', 'user_' . $santa->ID );
                $exceptions[$santa->user_email] = [$not['user_email']];   
                update_field('kids', [], 'user_' . $santa->ID);
            }

            $gifts_per_person = 3;
            $result = self::assignGifts($players, $exceptions, $gifts_per_person);
            if ($result === false) {
                echo "No valid assignment found.\n";
            } else {
                foreach ($result as [$giver, $receiver]) {
                    $user = get_user_by_email($giver);
                    $kids = get_field('kids', 'user_' . $user->ID);
                    $kid = get_user_by_email($receiver);
                    if (!is_array($kids)) {
                        $kids = [];
                    }
                    array_push($kids, $kid->ID);
                    update_field('kids', $kids, 'user_' . $user->ID);
                    wp_redirect(home_url());
                }
            }
            
        }
       
    }

    public static function assignGifts($players, $exceptions, $gifts_per_person = 3) {

        $receives = array_fill_keys($players, 0);
        $gives = array_fill_keys($players, 0);
        $assignments = [];

        if (self::backtrack($players, $exceptions, $gifts_per_person, $gives, $receives, $assignments)) {
            return $assignments;
        }

        return false;
    }

    public static function backtrack($players, $exceptions, $gifts_per_person, &$gives, &$receives, &$assignments, $i = 0) {
        if ($i >= count($players)) return true;

        $giver = $players[$i];

        // Possible receivers = all others except self
        $possibleReceivers = array_diff($players, [$giver]);

        // Remove exceptions
        if (isset($exceptions[$giver])) {
            $possibleReceivers = array_diff($possibleReceivers, $exceptions[$giver]);
        }

        // Shuffle to randomize
        $possibleReceivers = array_values($possibleReceivers);
        shuffle($possibleReceivers);

        foreach ($possibleReceivers as $receiver) {

            // Check: receiver has capacity & giver has capacity & no duplicate pair
            if (
                $gives[$giver] < $gifts_per_person &&
                $receives[$receiver] < $gifts_per_person &&
                !self::alreadyAssigned($assignments, $giver, $receiver)
            ) {
                // Assign
                $gives[$giver]++;
                $receives[$receiver]++;
                $assignments[] = [$giver, $receiver];

                // If giver done, move to next giver. Otherwise assign next gift from same giver.
                if ($gives[$giver] == $gifts_per_person) {
                    if (self::backtrack($players, $exceptions, $gifts_per_person, $gives, $receives, $assignments, $i+1)) {
                        return true;
                    }
                } else {
                    if (self::backtrack($players, $exceptions, $gifts_per_person, $gives, $receives, $assignments, $i)) {
                        return true;
                    }
                }

                // Undo
                $gives[$giver]--;
                $receives[$receiver]--;
                array_pop($assignments);
            }
        }

        return false;
    }

    public static function alreadyAssigned($assignments, $giver, $receiver) {
        foreach ($assignments as [$g, $r]) {
            if ($g === $giver && $r === $receiver) return true;
        }
        return false;
    }
}