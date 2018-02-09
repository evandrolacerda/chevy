<?php
namespace App\Services\Util;

/**
 * Description of Albums
 *
 * @author evandro
 */
class Albums {
    
    
    public static function getAlbums( array $usersId, int $mes, int $ano ) {
        $albums = [];
        
        
        
        foreach ($usersId as $user ) {
            $albums[] = new Album($user, $mes, $ano); 
        }
        
        return collect($albums);
    }
}
