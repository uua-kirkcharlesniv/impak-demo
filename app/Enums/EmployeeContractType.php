<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EmployeeContractType extends Enum
{
    const FullTime = 0;
    const PartTime = 1;
    const ProjectBased = 2;
}
