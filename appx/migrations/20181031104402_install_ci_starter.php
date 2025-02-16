<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_ci_starter extends CI_Migration {
	private $tables;

    public function __construct()
    {
		parent::__construct();
		$this->load->dbforge();
		$this->load->config('ion_auth', TRUE);
		$this->tables = $this->config->item('tables', 'ion_auth');
	}

	public function up() {
		// Drop table 'groups' if it exists
		$this->dbforge->drop_table($this->tables['groups'], TRUE);

		// Table structure for table 'groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '20',
			),
			'description' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['groups']);

		// Dumping data for table 'groups'
		$data = array(
			array(
				'name'        => 'admin',
				'description' => 'Administrator'
			),
			array(
				'name'        => 'members',
				'description' => 'General User'
			)
		);
		$this->db->insert_batch($this->tables['groups'], $data);

		// Drop table 'users' if it exists
		$this->dbforge->drop_table($this->tables['users'], TRUE);

		// Table structure for table 'users'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type'       => 'VARCHAR',
				'constraint' => '45'
			),
			'username' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type'       => 'VARCHAR',
				'constraint' => '80',
			),
			'salt' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'email' => array(
				'type'       => 'VARCHAR',
				'constraint' => '254'
			),
			'activation_code' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'forgotten_password_code' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'forgotten_password_time' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
				'null'       => TRUE
			),
			'remember_code' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'created_on' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
			),
			'last_login' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
				'null'       => TRUE
			),
			'active' => array(
				'type'       => 'TINYINT',
				'constraint' => '1',
				'unsigned'   => TRUE,
				'null'       => TRUE
			),
			'first_name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => TRUE
			),
			'last_name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => TRUE
			),
			'company' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => TRUE
			),
			'phone' => array(
				'type'       => 'VARCHAR',
				'constraint' => '20',
				'null'       => TRUE
			),
			'profile_image' => array(
				'type'       => 'VARCHAR',
				'constraint' => '500',
				'null'       => TRUE
			)

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['users']);

		// Dumping data for table 'users'
		$data = array(
			'ip_address'              => '127.0.0.1',
			'username'                => 'administrator',
			'password'                => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
			'salt'                    => '',
			'email'                   => 'admin@admin.com',
			'activation_code'         => '',
			'forgotten_password_code' => NULL,
			'created_on'              => '1268889823',
			'last_login'              => '1268889823',
			'active'                  => '1',
			'first_name'              => 'Kenean',
			'last_name'               => 'istrator',
			'company'                 => 'ADMIN',
			'phone'                   => '0',
			'profile_image'			  => 'avatar.png'
		);
		$this->db->insert($this->tables['users'], $data);


		// Drop table 'users_groups' if it exists
		$this->dbforge->drop_table($this->tables['users_groups'], TRUE);

		// Table structure for table 'users_groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => TRUE
			),
			'group_id' => array(
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['users_groups']);

		// Dumping data for table 'users_groups'
		$data = array(
			array(
				'user_id'  => '1',
				'group_id' => '1',
			),
			array(
				'user_id'  => '1',
				'group_id' => '2',
			)
		);
		$this->db->insert_batch($this->tables['users_groups'], $data);


		// Drop table 'login_attempts' if it exists
		$this->dbforge->drop_table($this->tables['login_attempts'], TRUE);

		// Table structure for table 'login_attempts'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type'       => 'VARCHAR',
				'constraint' => '45'
			),
			'login' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => TRUE
			),
			'time' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
				'null'       => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['login_attempts']);

		// Drop table 'settings' if it exists
		$this->dbforge->drop_table($this->tables['settings'], TRUE);

		// Table structure for table 'images'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '250'
			),
			'value' => array(
				'type'       => 'LONGTEXT',
			),
			'status' => array(
				'type'       => 'TINYINT',
				'constraint' => '1',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['settings']);

		// Dumping data for table 'images'
		$data = array(
			array(
				'id'  => '1',
				'name' => 'sidebar',
				'value' => 'sidebar-collapse',
				'status' => '1',
			),
			array(
				'id'  => '2',
				'name' => 'skin',
				'value' => 'skin-blue',
				'status' => '1',
			),
			array(
				'id'  => '3',
				'name' => 'box_headers',
				'value' => 'box-primary',
				'status' => '1',
			),
			array(
				'id'  => '4',
				'name' => 'buttons',
				'value' => 'btn-primary',
				'status' => '1',
			),
		);
		$this->db->insert_batch($this->tables['settings'], $data);


		// Drop table 'settings' if it exists
		$this->dbforge->drop_table($this->tables['images'], TRUE);

		// Table structure for table 'images'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'image_name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '250'
			),
			'placement' => array(
				'type'       => 'VARCHAR',
				'constraint' => '250'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['images']);

		// Dumping data for table 'images'
		$data = array(
			array(
				'id'  => '1',
				'image_name' => 'favicon.png',
				'placement' => 'favicon',
			)
		);
		$this->db->insert_batch($this->tables['images'], $data);

	}

	
	public function down() {
		$this->dbforge->drop_table($this->tables['users'], TRUE);
		$this->dbforge->drop_table($this->tables['groups'], TRUE);
		$this->dbforge->drop_table($this->tables['users_groups'], TRUE);
		$this->dbforge->drop_table($this->tables['login_attempts'], TRUE);
		$this->dbforge->drop_table($this->tables['settings'], TRUE);
		$this->dbforge->drop_table($this->tables['images'], TRUE);
	}
}
