THE STATE RIGHT NOW

////////////////////////////////////////////////
[Users]
    There are 3 types; admin, artists, listeners

//////////////////////////////////////////////
[Permissions]
    ADMIN 
        - gain full CRUD access to any songs

    ARTIST  
        - gain full CRUD access to any of their songs (identifiable by comparing $song->artist_name = $user->name)
        - implemented by SongPolicy and @can() blade directives

    LISTENER
        - There is a special Listener that still gains access to creating songs to demonstrate DIRECT PERMISSION
            $specialUser = User::firstWhere('email', 'listener@example.com');
                if ($specialUser) {
                    $specialUser->givePermissionTo('create songs');
                }
        - The rest of the listeners can only view the songs