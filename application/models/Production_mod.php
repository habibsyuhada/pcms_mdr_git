<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Production_mod extends CI_Model {

	public function __construct()
 	{
	  	parent::__construct();
	    $this->db2 = $this->load->database('db_portal', TRUE);
 	}

 	public function document_new_process_db($data){
    $data = convert2null($data);
		$this->db->insert('mdr_document', $data);

		//user history log
		$insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_document id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
	}
  
  public function document_import_process_db($data) {
    $data = convert2null($data);
    $this->db->insert_batch("mdr_document", $data);
  }

	public function document_edit_process_db($data, $where){
    $data = convert2null($data);
    $this->db->where($where);
    $this->db->update('mdr_document',$data);

    //user history log
    helper_log("update", "Update data table mdr_document data = ".json_encode($data)." where = ".json_encode($where));
  }

	function document_list($id = null, $where = null, $where_in = null){
		if(isset($where)){
			$this->db->where($where);
		}
		elseif(isset($id)){
			$this->db->where('id', $id);
		}
		elseif(isset($where_in)){
			$this->db->where_in('drawing_no', $where_in);
		}
		else{
			$this->db->where('status_delete', '1');
		}

		$query = $this->db->order_by('upload_date', 'DESC');
		$query = $this->db->get('mdr_document');
		return $query->result_array();
	}

  function document_list_new($where = null, $order = NULL, $limit = NULL){
		if(isset($where)){
			$this->db->where($where);
		}
    if(isset($order)){
			$this->db->order_by($order);
		}
    else{
      $query = $this->db->order_by('upload_date', 'DESC');
    }

    if(isset($limit)){
      $this->db->limit($limit);
		}
		
		$query = $this->db->get('mdr_document');
		return $query->result_array();
	}

	public function checking_data_doc(){
    $this->db->where('status_delete', '1');
		$query = $this->db->get('mdr_document');
		return $query->result_array();
	}

  function document_main_planned_list($where = null){
    if(isset($where)){
      $this->db->where($where);
    }
    // $query = $this->db->order_by('t1.transmittal_date', 'DESC');
    $query = $this->db->distinct();
    $query = $this->db->select('main.*');
    $query = $this->db->join('mdr_document_revision t1', 'main.id = t1.id_document');
    $query = $this->db->get('mdr_document main');
    return $query->result_array();
  }

  function document_main_revision_list($where = null){
    if(isset($where)){
      $this->db->where($where);
    }
    $query = $this->db->order_by('t1.revision_date', 'DESC');
    $query = $this->db->order_by('t1.transmittal_date', 'DESC');
    $query = $this->db->order_by('t1.timestamp', 'DESC');
    $query = $this->db->select('t1.*, main.cetegory');
    $query = $this->db->join('mdr_document_revision t1', 'main.id = t1.id_document');
    $query = $this->db->get('mdr_document main');
    return $query->result_array();
  }

	public function insert_data_pmt_document($data){
    $data = convert2null($data);
		$this->db->insert('mdr_document', $data);

		//user history log
		$insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_document id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
	}

  function document_revision_list($id = null, $where = null, $where_in = null){
    if(isset($where)){
      $this->db->where($where);
    }
    elseif(isset($id)){
      $this->db->where('id', $id);
    }
    elseif(isset($where_in)){
      // $this->db->where_in('drawing_no', $where_in);
    }
    else{
      $this->db->where('status_delete', '1');
    }
    $query = $this->db->order_by('revision_date', 'DESC');
    $query = $this->db->order_by('transmittal_date', 'DESC');
    $query = $this->db->order_by('timestamp', 'DESC');
    $query = $this->db->get('mdr_document_revision');
    return $query->result_array();
  }

  public function document_revision_edit_process_db($data, $where){
    $data = convert2null($data);
    $this->db->where($where);
    $this->db->update('mdr_document_revision',$data);

    //user history log
    helper_log("update", "Update data table mdr_document_revision data = ".json_encode($data)." where = ".json_encode($where));
  }

  public function insert_data_pmt_document_revision($data){
    $data = convert2null($data);
    $this->db->insert('mdr_document_revision', $data);
    //user history log
    $insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_document_revision id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
  }

	public function clean($string) {
   		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   		$string = preg_replace('/[^a-zA-Z0-9\/_|+ .-]/', '', $string); // Removes special chars.

   		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}

	public function design_list_datatables($cat, $where = NULL, $column_cat = ''){
    $table      		= 'mdr_document';
    $column     		= array('id', 'ref_no', 'description', 'project_id','discipline','module','upload_by','upload_date','attachment','remarks','id');
    if($column_cat == 'MDR'){
      $column     = array('id', 'ref_no', 'revision_no', 'code', 'revision_date', 'status_remark', 'class', 'description', 'project_id', 'discipline','module','document_type','system','upload_by','upload_date','attachment','transmittal_date','transmittal_no','forecast_date','remarks', 'id');
    }
    if($column_cat == 'Vendor'){
      $column     = array('id', 'ref_no', 'revision_no', 'code', 'revision_date', 'status_remark', 'class', 'description', 'project_id', 'discipline','module','upload_by','upload_date','attachment','transmittal_date','transmittal_no','transmittal_status','vendor_code','po_number', 'remarks', 'id');
    }
    foreach ($column as $key => $value) {
      $column[$key] = "CAST(".$value." AS varchar)";
    }

    if(isset($where)){
			$this->db->where($where);
		}

    if($cat == 'count_all'){
      $this->db->from($table);
      return $this->db->count_all_results();
    }

    $this->db->from($table);
    
    $i = 0;
    $_POST['search']['value'] = convert2utf8($_POST['search']['value']);
    foreach ($column as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {
        if ($i === 0) // first loop
        {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $_POST['search']['value'], false);
        }
        else
        {
            $this->db->or_like($item, $_POST['search']['value'], false);
        }
        
        if (count($column) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
      }
      $i++;
    }
    
    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if (isset($column))
    {
      $this->db->order_by('upload_date', 'desc');
    }

    if($cat == 'data'){
      if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);

      $query = $this->db->get();
      return $query->result();
    }
    elseif($cat == 'count_filter'){
      $query = $this->db->get();
      return $query->num_rows();
    }
        
  }

  public function mdr_status_new_process_db($data){
    $data = convert2null($data);
		$this->db->insert('mdr_document_status', $data);

		//user history log
		$insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_document_status id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
	}

	public function mdr_status_edit_process_db($data, $where){
    $data = convert2null($data);
    $this->db->where($where);
    $this->db->update('mdr_document_status',$data);

    //user history log
    helper_log("update", "Update data table mdr_document_status data = ".json_encode($data)." where = ".json_encode($where));
  }

	function mdr_status_list($id = null, $where = null, $where_in = null){
		if(isset($where)){
			$this->db->where($where);
		}
		elseif(isset($id)){
			$this->db->where('id', $id);
		}
		else{
			$this->db->where('status_delete', '1');
		}

		$query = $this->db->get('mdr_document_status');
		return $query->result_array();
  }

  public function find_document_id($doc) {
    return $this->db->get_where("mdr_document", ['ref_no' => $doc,'status_delete' => 1])->row_array();
  }

  public function find_document_pmt() {
    return $this->db->get_where("mdr_document", ['status_delete' => 1])->result_array();
  }
  
  public function process_submit_mws($data) {
    $data = convert2null($data);
    $this->db->insert_batch("mdr_mws_review", $data);
    helper_log("insert", "update data table mdr_mws_review data = ".json_encode($data));

  }
  public function process_submit_dnv($data) {
    $data = convert2null($data);
    $this->db->insert_batch("mdr_dnv_review", $data);
    helper_log("insert", "update data table mdr_dnv_review data = ".json_encode($data));

  }

  public function find_document_mws($id){
    $this->db->select("mdr_mws_review.*, mdr_document.ref_no as document_number");
    $this->db->from("mdr_mws_review");
    $this->db->join("mdr_document", "mdr_document.id = mdr_mws_review.ref_no");
    $this->db->where("mdr_mws_review.ref_no" , $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function check_duplicate_mws($data) {
    return $this->db->get_where("mdr_mws_review", $data)->row_array();
  }
  public function find_document_dnv($id){
    $this->db->select("mdr_dnv_review.*, mdr_document.ref_no as document_number");
    $this->db->from("mdr_dnv_review");
    $this->db->join("mdr_document", "mdr_document.id = mdr_dnv_review.ref_no");
    $this->db->where("mdr_dnv_review.ref_no" , $id);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function check_duplicate_dnv($data) {
    return $this->db->get_where("mdr_dnv_review", $data)->row_array();
  }


  public function update_planner($data, $id) {
    $this->db->update("mdr_document", $data, ['id' => $id]);
    helper_log("update", "update data table mdr_document data = ".json_encode($data)." id = ".json_encode($id));
  }

  public function find_mws(){
    return $this->db->get("mdr_mws_review")->result_array();
  }

  public function find_dnv(){
    return $this->db->get("mdr_dnv_review")->result_array();
  }

  public function get_doc_rev_all($where = NULL){
    if(isset($where)){
      $this->db->where($where);
    }
    $query = $this->db->order_by('t1.revision_date', 'DESC');
    $query = $this->db->order_by('t1.transmittal_date', 'DESC');
    $query = $this->db->order_by('t1.timestamp', 'DESC');
    $query = $this->db->select('t1.*, main.ref_no,main.description,main.country,main.project_id,main.discipline,main.module,main.document_type,main.system,main.subsystem,main.generator,main.vendor_code,main.po_number,main.cetegory');
    $query = $this->db->join('mdr_document_revision t1', 'main.id = t1.id_document');
    $query = $this->db->get('mdr_document main');
    return $query->result_array();
  }

  function vendor_master_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}

		$query = $this->db->get('master_vendor');
		return $query->result_array();
  }


  public function update_document_status_to_delete($data, $ref_no) {
    $data = convert2null($data);
    $this->db->update("mdr_document", $data, [
      'id' => $ref_no
    ]);
    helper_log("update", "update data table mdr_document data = ".json_encode($data)." id = ".json_encode($ref_no));

  }

  public function find_total_document_revision($document_id) {
    return $this->db->get_where("mdr_document_revision",[
      'id_document' => $document_id,
      'status_delete' => 1
    ])->num_rows();
  }

  public function update_revision_status_to_delete($data, $array_id) {
    $data = convert2null($data);
    $this->db->where_in('id',$array_id );
    $this->db->update("mdr_document_revision", $data);
    helper_log("update", "update data table mdr_document_revision data = ".json_encode($data)." id revision = ".json_encode($array_id));
  }

  public function reviewer_new_process_db($data){
    $data = convert2null($data);
		$this->db->insert('mdr_reviewer', $data);

		//user history log
		$insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_reviewer id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
  }
  
  function reviewer_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}

		$query = $this->db->order_by('created_date', 'ASC');
		$query = $this->db->get('mdr_reviewer');
		return $query->result_array();
  }
  
  public function reviewer_update_process_db($data, $where){
    $data = convert2null($data);
    $this->db->where($where);
		$this->db->update('mdr_reviewer', $data);
  }

  public function reviewer_delete_process_db($where){
    $this->db->where($where);
		$this->db->delete('mdr_reviewer');
  }

  public function reviewer_detail_new_process_db($data){
    $data = convert2null($data);
		$this->db->insert('mdr_reviewer_detail', $data);

		//user history log
		$insert_id = $this->db->insert_id();
    helper_log("add", "Insert data table mdr_reviewer_detail id = ".$insert_id." data = ".json_encode($data));
    return $insert_id;
  }
  
  function reviewer_detail_list($where = null){
		if(isset($where)){
			$this->db->where($where);
		}

		$query = $this->db->order_by('created_date', 'ASC');
		$query = $this->db->get('mdr_reviewer_detail');
		return $query->result_array();
  }

  public function reviewer_detail_update_process_db($data, $where){
    $data = convert2null($data);
    $this->db->where($where);
    $this->db->update('mdr_reviewer_detail', $data);
    helper_log("update", "update data table mdr_reviewer_detail data = ".json_encode($data)." where = ".json_encode($where));
  }
}


/*
	End Model Auth_mod
*/