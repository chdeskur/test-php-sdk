<?php

namespace NewDemo\Types;

enum Status: string
{
    case Queued = "queued";
    case MeetCompany = "meet company";
    case Paused = "paused";
    case GetData = "get data";
    case WorkingOnIt = "working on it";
    case Done = "done";
}
