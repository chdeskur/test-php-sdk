<?php

namespace NewDemo\Types;

enum Priority: string
{
    case Low = "low";
    case Normal = "normal";
    case High = "high";
    case Urgent = "urgent";
}
