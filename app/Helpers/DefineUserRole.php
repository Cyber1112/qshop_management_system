<?php

namespace App\Helpers;

use App\Tasks;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DefineUserRole{

    public function defineRole($user){
        if ( $user->hasRole('employee') ){
            return $this->getBusinessIdByEmployee($user);
        }
        if ($user->hasRole('business')){
            return $this->getBusinessIdByBusiness($user);
        }
        if( $user->hasRole('client') ){
            return $this->getClientId($user);
        }

    }

    public function getBusinessIdByEmployee($user){
        return app(Tasks\BusinessEmployee\FindTask::class)->run(
            $user->id
        )->business_id;
    }

    public function getBusinessIdByBusiness($user){
        return app(Tasks\BusinessAccount\FindBusinessByUserIdTask::class)->run(
            $user->id
        )->id;
    }

    public function getClientId($user){
        return app(Tasks\ClientAccount\FindByClientIdTask::class)->run(
            $user->id
        )->id;
    }

}




