<?php

namespace NewDemo\Types;

enum FileType: string
{
    case Deck = "deck";
    case Financials = "financials";
    case RawData = "raw_data";
    case Snapshot = "snapshot";
    case Full = "full";
    case Mini = "mini";
    case Nano = "nano";
    case Other = "other";
}
