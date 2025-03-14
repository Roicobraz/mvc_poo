<?php

namespace mvc_poo\Core\ORM;

class QueryBuilder {
    private static $allowedVerbs = ["SELECT", "DELETE", "UPDATE", "INSERT"];
    private string $verb = '';
    private array $fieldNames = [];
    private string $tableName = '';
    private array $whereClauses = [];
    private string $limit = '';
    private array $orderBy = [];

    public function select(string $tableName = ''): self
    {
        $this->verb = "SELECT";
        $this->from($tableName);
        return $this;
    }
    public function delete(): self
    {
        $this->verb = "DELETE";
        return $this;
    }
    public function insert(): self
    {
        $this->verb = "INSERT";
        return $this;
    }
    public function update(): self
    {
        $this->verb = "UPDATE";
        return $this;
    }
    public function from($tableName): self
    {
        $this->tableName = "`$tableName`";
        return $this;
    }

    public function setFields(Array $fieldNames): self
    {
        $this->fieldNames = $fieldNames;
        return $this;
    }

    public function addField(string $fieldName): self
    {
        if(!in_array($fieldName, $this->fieldNames, true)){
            $this->fieldNames[] = $fieldName;
        }
        return $this;
    }

    public function addWhere(string $clause): self{
        $this->whereClauses[] = $clause;
        return $this;
    }

    public function limit(int $limit, ?int $offset = null): self{
        $this->limit = "LIMIT $limit";
        if($offset){
            $this->limit .= " OFFSET $offset";
        }
        return $this;
    }

    public function addOrderBy(string $fieldName, string $direction = "ASC"): self{
        $this->orderBy[] = "`$fieldName` $direction";
        return $this;
    }

    private function getFieldList(): string
    {
        $fields = array_map(fn($fieldName) => "`$fieldName`", $this->fieldNames);
        return implode(", ", $fields);
    }

    private function getWHEREClause(){
        if(empty($this->whereClauses)){
            return "";
        }
        return " WHERE ". implode(" AND ", $this->whereClauses);
    }

    private function getORDERBYClause(){
        if(empty($this->orderBy)){
            return "";
        }

        return " ORDER BY ". implode(" AND ", $this->orderBy);
    }

    private function getSELECTQuery()
    {
        $fields = $this->getFieldList();
        if(empty($fields))
        {
            $fields = "*";
        }
        return "$this->verb {$fields} FROM $this->tableName {$this->getWHEREClause()} {$this->getORDERBYClause()} {$this->limit}";
    }

    private function getDELETEQuery(){
        return "$this->verb FROM $this->tableName {$this->getWHEREClause()}";
    }

    private function getUPDATEQuery(){
        $placeholders = implode(", ", array_map(fn($fieldName) => "`$fieldName` = ?", $this->fieldNames));
        return "$this->verb $this->tableName SET $placeholders {$this->getWHEREClause()}";
    }

    private function getINSERTQuery(){
        $placeholders = implode(", ", array_fill(0, count($this->fieldNames), "?"));
        return "$this->verb INTO $this->tableName ({$this->getFieldList()}) VALUES ($placeholders)";
    }

    public function getQuery()
    {
        if(!in_array($this->verb, self::$allowedVerbs, true)){
            throw new \RuntimeException("Invalid verb");
        }
        if(empty($this->tableName)){
            throw new \RuntimeException("No table name");
        }

        $method = "get" . ucfirst($this->verb). "Query";
        return $this->$method();
    }
}