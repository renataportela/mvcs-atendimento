<?php
namespace App\Services;

use App\Models\Topic;

class TopicsListService
{
   public static function lista()
   {
      return Topic::lista();
   }
}
