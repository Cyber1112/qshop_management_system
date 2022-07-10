<?php

namespace App\Dto\Business\BusinessSchedule;

use Spatie\DataTransferObject\DataTransferObject;


class CreateDto extends DataTransferObject{
    public string $working_schedule_type;
    public string $work_start;
    public string $work_end;
}
