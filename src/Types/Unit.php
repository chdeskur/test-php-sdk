<?php

namespace NewDemo\Types;

enum Unit: string
{
    case String = "string";
    case Percent = "percent";
    case Ratio = "ratio";
    case Scalar = "scalar";
    case Dollar = "dollar";
}
