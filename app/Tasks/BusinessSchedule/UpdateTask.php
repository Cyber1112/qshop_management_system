<?php

namespace App\Tasks\BusinessSchedule;

use App\Repositories\BusinessScheduleRepositoryInterface;

class UpdateTask{

    private BusinessScheduleRepositoryInterface $scheduleRepository;

    public function __construct(BusinessScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return int
     */
    public function run(int $id, array $payload){
        return $this->scheduleRepository->update($id, $payload);
    }

}
