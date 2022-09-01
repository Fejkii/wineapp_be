<?php

namespace App\Enums;

enum HttpStatusTitle: string{
    case OK = "ok";
    case ERROR = "error";
    case CONFLICT = "conflict";
}
