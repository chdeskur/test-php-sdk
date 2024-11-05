<?php

namespace NewDemo\Types;

enum UserType: string
{
    case Business = "business";
    case Consumer = "consumer";
    case Supplier = "supplier";
    case Asset = "asset";
    case Labor = "labor";
    case BusinessUser = "business_user";
}
