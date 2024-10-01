<?php

declare(strict_types=1); 

namespace App\enum; 

enum UserAccountStatusEnum : string {

    case ACTIVE = 'active' ;
    case PENDING = 'pending' ;
    case BLOCKED = 'blocked' ;
    case BANNED = 'banned' ;
    case DELETED = 'deleted' ;
}