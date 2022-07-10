<?php

namespace App\Dto\Business\BusinessBonusOption;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject{
    public int $bonus_percent;
    public int $activation_bonus_period;
    public int|null $deactivation_bonus_period;

}
