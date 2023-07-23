<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WorkModel extends Enum
{
    const Remote = 0;
    const Office = 1;
    const Hybrid = 2;
}
