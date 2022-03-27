<?php

namespace App\Enums;

final class OrderStatusCodeEnum extends AbstractEnum
{
    const DRAFT = '0';

    const SUBMITTED = '1';

    const DELIVERY = '2';

    const COMPLETED = '3';
}
