<?php

return [
    // The amount below is the amount paid by the student every month.
    'nominal' => 500000,

    // The discount below is the discount received if you have 2 or more children in this school.
    'family_discount' => 100000,

    // The discount below is the discount received if the child has orphan, widow, or orphan widow status.
    'orphan_discount' => 100000,

    // The date for monthly payment
    // Example: 1 (Payment will be made every month on the 1st)
    'payment_date' => 10,

    // The time for monthly payment
    // Example: 00:01 (Payment will be made every month at 00:01)
    'payment_time' => '00:01',
];
