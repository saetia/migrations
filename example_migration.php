<?php
class AddCmsUsersTable extends Ruckusing_BaseMigration {

	public function up(){
		$t = $this->create_table("cms_users", array('id' => true, 'options' => 'Engine=InnoDB'));
		$t->column("shortname", "string", array("limit" => 32));
		$t->column("pw", "string", array("limit" => 32));
		$t->column("name", "string", array("limit" => 64));
		$t->column("email", "string", array("limit" => 255));
		$t->column("super", "boolean", array("limit" => 1,'default' => 0, 'null' => false));
		$t->column("template", "boolean", array("limit" => 1,'default' => 0, 'null' => false));
		$t->column("help", "boolean", array("limit" => 1,'default' => 0, 'null' => false));
		$t->column("created_at", "timestamp", array('null' => false));
		
		$t->finish();
		
		$this->add_index("cms_users", array('email', 'pw'));
	}

	public function down(){
		$this->drop_table("cms_users");
	}
	
}
?>