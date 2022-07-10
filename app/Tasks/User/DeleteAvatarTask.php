<?php

namespace App\Tasks\User;

use App\Models\Image;

class DeleteAvatarTask{

    public function run($id){
        Image::where('imageable_id', $id)->where('imageable_type', 'App\Models\User')->delete();
    }

}
