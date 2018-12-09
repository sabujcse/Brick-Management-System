 <?php
class Sardar_type extends CI_Model {
   
    public function __construct() {
        parent::__construct();
    }
    public function get_sardar_types()
    {
        return $this->db->get('tbl_sardar_type')->result_array();
    }
    public function add_sardar_type($data)
    {
        return $this->db->insert('tbl_sardar_type', $data);
    }
    public function sardar_type_name($name){
           return $this->db->where('name', $name)->get('tbl_sardar_type')->result_array(); 
    }
    public function sardar_type_check($name){
        return $this->db->where('name', $name)->get('tbl_sardar_type')->result_array();
    }
    public function sardar_type_update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_sardar_type', $data);
    }
    public function get_sardar_type_info_by_id($id)
    {
         return $this->db->where('id', $id)->get('tbl_sardar_type')->result_array();
    }
    public function delete_sardar_types_by_id($id)
    {
        return $this->db->delete('tbl_sardar_type', array('id' => $id));
    }
}
