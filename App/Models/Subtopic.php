<?php
namespace App\Models;

use App\Core\Model;

class Subtopic extends Model
{
   protected $tableName = 'subtopics';
   protected $primaryKey = 'id';

   public $id;
   public $topic_id;
   public $description;
}
