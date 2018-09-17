<?php
namespace App\Core;

abstract class Model{

    protected $tableName;
    protected $primaryKey;

    protected static function db()
    {
        return DB::getInstance();
    }

    public function insert($values)
    {
      $this->db()->insert($this->tableName, $values);
    }

    public function save()
    {
      $this->insert( $this->toArray() );
    }

    public function toArray()
    {
      $fields = get_object_vars($this);
      unset($fields['primaryKey']);
      unset($fields['tableName']);
      return $fields;
   }

    // public function find($id)
    // {
    //    $result = $this->db()->select('*')->from($this->tableName)->where($this->primaryKey, '=', $id)->fetchAll();
    //
    //    if (! empty($result))
    //    {
    //       $this->fill($result[0]);
    //    }
    // }

    public function fill($modelData)
    {
       foreach ($modelData as $field => $data)
       {
          $this->{$field} = $data;
       }
    }

}
