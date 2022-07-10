<?php

namespace App\Tasks\BusinessSchedule;

use App\Repositories\BusinessScheduleRepositoryInterface;

class CreateTask{

    private BusinessScheduleRepositoryInterface $scheduleRepository;

    public function __construct(BusinessScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param array $payload
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function run(array $payload){
        return $this->scheduleRepository->create($payload);
    }

}
