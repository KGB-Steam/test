<?php

/*
* 
*/

class db_mysqli {

	private $_connect_id = null;
	private $_resource_id = null;
	private $_pfx = '';
	private $_sql = null;
	private $_order = '';
	public $debug = true;

	function connect ($config) {
		$this->_connect_id = mysqli_connect($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbname']);
		if (!$this->_connect_id) {
			$this->error();
			return false;
		}
		
		if (!isset($config['dbcharset'])) {
			$config['dbcharset'] = 'utf8';
		}
		$this->query("SET NAMES '".$config['dbcharset']."'")->
			query("SET CHARSET '".$config['dbcharset']."'")->
			query("SET CHARACTER SET '".$config['dbcharset']."'")->
			query("SET SESSION collation_connection = '".$config['dbcharset']."_general_ci'");
		
		if (isset($config['dbpref'])) {
			$this->_pfx = $config['dbpref'];
		}
	}

	function query($sql) {
		$this->_sql = $this->tbl($sql);
		$this->_resource_id = mysqli_query($this->_connect_id, $this->_sql);
		if ($this->debug and !$this->_resource_id) {
			$this->error();
		}
		return $this;
	}

	function real_string($string) {
		return mysqli_real_escape_string($this->_connect_id, $string);
	}

	function item($table, $where = '1', $fields = '*', $field = false){
		$item = $this->query('select '.$fields.' from '.$table.' where '.$where)->row($field);
		return $item; 
	}

	function items($table, $where = '1', $fields = '*', $field = false, $key = false){
		$items = $this->query('select ' . $fields . ' from ' . $table . ' where ' . $where . ' ' . $this->_order)->rows($field, $key);
		return $items; 
	}

	function rows($field = false, $key = false) {
		$rows = array();
		while($row = $this->row($field)) {
			if (!$key) {
				$rows[] = $row;
			} else {
				$rows[$row[$key]] = $row;
			}
		}
		return $rows;
	}

	function orderBy($col) {
		if(!empty($col)) {
			$this->_order = 'ORDER BY ' . $col;
		} else {
			$this->_order = '';
		}
		return $this;
	}

	function row($field = false){
		if ($this->_resource_id and $row = mysqli_fetch_assoc($this->_resource_id)) {
			return $field ? $row[$field] : $row;
		}
		return null;
	}

	// Последний SQL-запрос
	function last() {
		return $this->_sql;
	}

	function res() {
		return $this->_resource_id;
	}

	function id(){
		return mysqli_insert_id($this->_connect_id);
	}

	private function _arrayKeysToSet($values) {
		$ret='';
		if (is_array($values) or is_object($values)){
			foreach($values as $key=>$value){
			  if(!empty($ret))$ret.=',';
			  if (!is_numeric($key)) {
				$ret.="`$key`=".$this->__($value);
			  } else {
				$ret.=$value;
			  }
			}
		} else {
			$ret=$values;
		}
		return $ret;
	}

	function exists($table, $id, $field = 'id') {
		$pid = $this->query('select '.$field.' from '.$table.' where '.$field.'='.$this->__($id).' limit 1')->row($field);
		return $pid;
	}

	function cnt() {
		return mysqli_affected_rows($this->_connect_id);
	}

	function count($table, $where = '1') {
		$cnt = $this->item($this->tbl($table), $where, 'COUNT(*)');
		return $cnt["COUNT(*)"];
	}

	function _($value) {
		return mysqli_real_escape_string($this->_connect_id, $value);
	}

	function __($value) {
		return '"'.$this->_($value).'"';
	}

	function errno() {
		return mysqli_errno($this->_connect_id);
	}

	// Вставить запись
	function insert($table, $values){
		$ret = $this->_arrayKeysToSet($values);
		return $this->query('insert into '.$table.' set '.$ret);
	}

	// Обновить запись
	public function update( $table, $values, $where=1 ){
		$ret = $this->_arrayKeysToSet($values);
		return $this->query('update '.$table.' set '.$ret.' where '.$where);
	}

	function tbl($table) {
		return preg_replace('/#__/u', $this->_pfx, $table);
	}

	//Удалить запись
	public function delete($table, $where){
		return $this->query('delete from '.$table.' where '.$where);
	}

	public function error(){
		$langcharset = 'utf-8';
		echo "<HTML>\n";
		echo "<HEAD>\n";
		echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=".$langcharset."\">\n";
		echo "<TITLE>MySQL Debugging</TITLE>\n";
		echo "</HEAD>\n";
		echo "<div style=\"border:1px dotted #000000; font-size:11px; font-family:tahoma,verdana,arial; background-color:#f3f3f3; color:#A73C3C; margin:5px; padding:5px;\">";
		echo "<b><font style=\"color:#666666;\">MySQL Debugging</font></b><br /><br />";
		echo "<li><b>SQL.q :</b> <font style=\"color:#666666;\">".$this->_sql."</font></li>";
		echo "<li><b>MySQL.e :</b> <font style=\"color:#666666;\">".mysqli_error($this->_connect_id)."</font></li>";
		echo "<li><b>MySQL.e.№ :</b> <font style=\"color:#666666;\">".mysqli_errno($this->_connect_id)."</font></li>";
		echo "<li><b>PHP.v :</b> <font style=\"color:#666666;\">".phpversion()."\n</font></li>";
		echo "<li><b>Data :</b> <font style=\"color:#666666;\">".date("d.m.Y H:i")."\n</font></li>";
		echo "<li><b>Script :</b> <font style=\"color:#666666;\">".getenv("REQUEST_URI")."</font></li>";
		echo "<li><b>Refer :</b> <font style=\"color:#666666;\">".getenv("HTTP_REFERER")."</li></div>";
		echo "</BODY>\n";
		echo "</HTML>";
		exit();
	}
}