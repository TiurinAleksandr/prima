<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Request extends Model
	{
		public function getById($id)
		{
			return $this->findOne("SELECT * FROM requests WHERE id=$id");
		}
		
		public function getAll()
		{
			return $this->findMany("SELECT * FROM requests");
		}
	}


