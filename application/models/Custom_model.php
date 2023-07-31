<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    /* function generate_string_character(){
      $randomString = rand(1000, 9999);
      return $randomString;
      }
     */
    /* function user_exist(){
      $uid				=	$this->input->post('userid');
      $upass				=	$this->input->post('password');
      } */    
   
    function get_institute_id(){
        $institute_details = $this->fetch_data(INSTITUTE_DETAILS,
                 array(INSTITUTE_DETAILS.'.id'),
                 array(INSTITUTE_DETAILS.'.domain_name'=>$_SERVER['SERVER_NAME']),
                 array()
                 );       
        if(!empty($institute_details)){
            return $institute_details[0]->id;
        }else{
            return "";
        }
    }    
     
    function reward_point_calculation($user_no, $invite_code) {
        $this->get_multiple_result("call referral_reward(" . $invite_code . "," . $user_no . ")");
    }
    function set_point_to_normal_user($user_no) {
        $this->get_multiple_result("call referral_reward_user(" . $user_no . ")");
    }
    function order_reward_point($order, $user_no, $order_total, $paid_by, $bid) {
        $this->get_multiple_result("call order_reward_point(" . $order . "," . $user_no . "," . $order_total . "," . $paid_by . "," . $bid . ")");
    }
    function get_boutique_details($bid, $user_no) {
        $query = $this->get_multiple_result("call get_booutique_details(" . $bid . "," . $user_no . ",'" . date('D') . "')");
        echo "<pre>";
        print_r($query);
        exit;
        //$query->result();
    }
    //********** new added  *************//
    function getSearchInfo() {
        return $this->get_multiple_result("call getSearchInfo()");
    }
    function getApplicationDetails($app_id) {
        return $this->get_multiple_result("call getApplicationDetails(" . $app_id . ")");
    }
    //******* end new added function  **********//
    function get_user_item_list($user_no) {
        $query = $this->get_multiple_result("call get_user_item_list(" . $user_no . ")");
        return $query;
    }
    function item_details($item_no, $user_no) {
        $query = $this->get_multiple_result("call item_details(" . $item_no . "," . $user_no . ")");
        return $query;
    }
    function insert_data($data, $table_name) {
        $this->db->insert($table_name, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function get_multiple_result($query) {
        $k = 0;
        $arr_results_sets = array();
        if (mysqli_multi_query($this->db->conn_id, $query)) {
            do {
                $result = mysqli_store_result($this->db->conn_id);
                //print_r($result);
                if ($result) {
                    $l = 0;
                    while ($row = $result->fetch_object()) {
                        //print_r($row);
                        $arr_results_sets[$k][$l] = $row;
                        $l++;
                    }
                }
                $k++;
            } while (mysqli_more_results($this->db->conn_id) && mysqli_next_result($this->db->conn_id));
        }
        return $arr_results_sets;
    }
    function insert_data2($data, $table_name) {
        $res = $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
/**************************************save credit***********************************************/  
 public function save_credit($data){
   
    $val= $this->uri->segment(3); 
    for($i=0;$i<count($data['max_credit']);$i++){
        $datad = array(
            "credit" => $data['max_credit'][$i],
            "remark" => $data['remark'][$i],
            "user_id" => $val,
            "credit_role_id" => $data['credit_role_id'][$i],
            "credit_id" => $data['credit_id'][$i],
        );
        $this->db->insert("users_credits_roles",$datad);
    }
  }
  /**************************************save appraisal***********************************************/  
 public function save_appraisal($appraisal){
    // echo "<pre>";print_r($appraisal);die;
    $user_id= $this->uri->segment(3);
    $data = array(
        'percentage' => $appraisal['appraisal_percentage'],
        'amount' => $appraisal['appraisal_amount'],
        'from_date' => $appraisal['from_date'],
        'to_date' => $appraisal['to_date'],
        'final_salary' => $appraisal['final_salary'],
        'remarks' => $appraisal['remarks'],
        'user_id' => $user_id
    );
    $this->db->insert("fx_user_appraisal",$data);
  }
  /**************************************list appraisal***********************************************/  
 public function get_user_appraisal($userid){
  $this->db->select("*");
  $this->db->where("user_id",$userid);
  $query = $this->db->get("fx_user_appraisal");
  return $query->result_array();
  }

/***********************************************************************************************/  
    public function confirm_check($order_id) {
        $query = $this->db->query("SELECT 
				order.total_booked_facility,
				order.total_price,
				order.order_date,
				order.order_time,
			  	FROM order
			  	JOIN order_details ON order_details.order_id = order.id
			  	WHERE order_details.order_id = order.id");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    public function query_to_object($saved_query) {
        $query = $this->db->query($saved_query);
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    public function row_present_check($table_name, $where,$joining = '') {
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                $this->db->where($key, $where_list);
            }
        }
		 if (!empty($joining) || !empty($joining) ) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        $query = $this->db->get($table_name);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function query_generate($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '') {
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
        $query = $this->db->get($table_name);
        return $this->db->last_query();
    }
    public function fetch_data($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '',$where_string='') {
        
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
					$this->db->like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
        $query = $this->db->get($table_name);
        
        // exit;
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $arr;
        }
    }

    public function fetch_data_migration($field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '',$where_string='') {
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    //$this->db->or_like($key, $search_list);
                    $this->db->like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
        $query = $this->db->get($table_name);
        // echo $this->db->last_query();
        // exit;
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $arr;
        }
    }
    public function fetch_data_join($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = 0, $end = 20) {
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                $this->db->join($key, $join_list, 'inner');
            }
        }
        if ($page_number != "" && $item_per_page != "") {
            $this->db->order_by($order, $by);
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            $this->db->having($having);
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
        $query = $this->db->get($table_name);
        //echo $this->db->last_query();exit;
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $arr;
        }
    }
    public function fetch_datas($tblarray, $fieldarray, $conds = '') {
        /* print_r($conds);
          exit; */
        if (empty($tblarray) || empty($fieldarray)) {
            return false;
        }
        $tblnames = implode(' left join ', $tblarray);
        $fieldnames = implode(',', $fieldarray);
        if (!empty($conds)) {
            $conds = implode(' and ', $conds);
        }
        /* echo "select ".$fieldnames." from ".$tblnames." where ".$conds." ";
          exit; */
        $query = $this->db->query("select " . $fieldnames . " from " . $tblnames . " where " . $conds . " ");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return false;
        }
    }
    function fetch_updates($user_no) {
        $query = $this->db->query("SELECT 
										notification.update_text,
										notification.posting_date_time,
										register_user.first_name,
										register_user.last_name,
										register_user.user_no,
										register_user.user_profile_pic										 
								 FROM notification 
								 JOIN register_user ON register_user.user_no=notification.update_from_user
								 WHERE update_from_user IN
								 						(SELECT main_user 
														 FROM follow_user 
														 WHERE status=2 
														 AND follower_user_no=$user_no)");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    public function fetch_passenger_order_details($table_name, $field, $where, $joining, $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '') {
        $this->db->select($field);
        if (!empty($where) && is_array($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                $this->db->join($key, $join_list);
            }
        }
        if ($group_by != "") {
            $this->db->group_by($group_by);
        }
        if ($page_number != "" && $item_per_page != "") {
            $this->db->order_by($order, $by);
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        $query = $this->db->get($table_name);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    public function fetch_message($chat_id) {
        $query = $this->db->query("SELECT 
										chat_content,
										user_no									 
								 FROM chat_text WHERE chat_id= '$chat_id' ORDER BY row_num DESC LIMIT 0,10");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
     


    public function row_count($table_name, $field, $where, $joining = '', $having = '', $search = '', $group_by = '', $where_string='') {
        $this->db->select($field);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                // if (strpos($where_list, ",") == true) {
                //     $wh_list = explode(",", $where_list);
                //     $this->db->where_in($key, $wh_list);
                // } else {
                //     $this->db->where($key, $where_list);
                // }
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                }else {
                    $this->db->where($key, $where_list);
                }
            }
        }
         if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($joining) || !empty($joining) && is_array($joining)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->like($key, $search_list);
                }
            }
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table_name);
         //echo $this->db->last_query();//exit;
        return $query->num_rows();
    }
    public function boutique_item_count($table_name, $field, $where, $joining = '', $having = '', $search = '', $group_by = '') {
        $fld = "COUNT(" . $field[0] . ") AS TOTAL_ROW," . $field[1];
        $this->db->select($fld);
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($joining)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table_name);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $result = $query->result_object();
            return $result[0]->TOTAL_ROW;
        } else {
            return 0;
        }
    }
    public function delete_row($table_name, $field = array(), $wherein = array()) {
        if ($table_name != "" && !empty($field) && !empty($wherein)) {
            $number_of_field = count($wherein);
            for ($i = 0; $i < count($field); $i++) {
                $this->db->where_in($field[$i], $wherein[$i]);
            }
            $this->db->delete($table_name);
            $effected_row = $this->db->affected_rows();
            if ($number_of_field == $effected_row) {
                return 1; //all row inserted
            } else {
                return 2; //some rows are not inserted
            }
        } else {
            return false;
        }
    }
    function edit_data_where($data, $where, $table_name) {
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        $rs = $this->db->update($table_name, $data);
        return $rs;
    }
    function edit_data($data, $where, $table_name) {
        if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                    $wh_list = explode(",", $where_list);
                    $this->db->where_in($key, $wh_list);
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        $rs = $this->db->update($table_name, $data);
        //echo $this->db->last_query();
        //exit;
        /* if($this->db->affected_rows()>0){ */
        // return $this->db->insert_id();
        /* }else{
          return false;
          } */
        return $rs;
    }
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    function send_notification($registatoin_ids, $message) {
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
    function ios_push($deviceToken, $message) {
        // This this a fake device id:
//$deviceToken = 'a029c089a3ee89aef417996adb92a76863bd263f1417f07b26a269e56f5c7438';
// fake password:
        $passphrase = '';
// Put your alert message here:
//$message = 'New Message';
        ////////////////////////////////////////////////////////////////////////////////
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'taxiplus.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        echo 'Connected to APNS' . PHP_EOL;
// Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default',
            'badge' => '1'
        );
// Encode the payload as JSON
        $payload = json_encode($body);
// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
        fclose($fp);
    }
    function delete_row_by_conditions($table_name, $where) {
        if ($table_name != "" && !empty($where)) {
            //$this->db->where_in($field,$wherein);
            foreach ($where as $key => $list) {
                $this->db->where($key, $list);
            }
            $this->db->delete($table_name);
            $effected_row = $this->db->affected_rows();
            return $effected_row;
        } else {
            return false;
        }
    }
    function createThumbs($cType = 'resize', $srcfolder, $srcname, $dstfolder, $dstname = false, $newWidth = false, $newHeight = false, $quality = 75) {
        $srcimg = $srcfolder . "/" . $srcname;
        list($oldWidth, $oldHeight, $type) = getimagesize($srcimg);
        //echo $oldWidth;
        $ext = $this->image_type_to_extension($type);
        if (is_writeable($dstfolder)) {
            $dstimg = $dstfolder . "/" . $dstname;
        } else {
            //debug("You must allow proper permissions for image processing. And the folder has to be writable.");
            //debug("Run \"chmod 777 on '$dstfolder' folder\"");
            //exit();
        }
        if ($newWidth || $newHeight) {
            if (file_exists($dstimg)) {
                unlink($dstimg);
            }
            switch ($cType) {
                default:
                case 'resize':
                    $widthScale = 2;
                    $heightScale = 2;
                    if ($newWidth) {
                        if ($newWidth > $oldWidth)
                            $newWidth = $oldWidth;
                        $widthScale = $newWidth / $oldWidth;
                    }
                    if ($newHeight) {
                        if ($newHeight > $oldHeight)
                            $newHeight = $oldHeight;
                        $heightScale = $newHeight / $oldHeight;
                    }
                    if ($widthScale < $heightScale) {
                        $maxWidth = $newWidth;
                        $maxHeight = false;
                    } elseif ($widthScale > $heightScale) {
                        $maxHeight = $newHeight;
                        $maxWidth = false;
                    } else {
                        $maxHeight = $newHeight;
                        $maxWidth = $newWidth;
                    }
                    if ($maxWidth > $maxHeight) {
                        $applyWidth = $maxWidth;
                        $applyHeight = ($oldHeight * $applyWidth) / $oldWidth;
                    } elseif ($maxHeight > $maxWidth) {
                        $applyHeight = $maxHeight;
                        $applyWidth = ($applyHeight * $oldWidth) / $oldHeight;
                    } else {
                        $applyWidth = $maxWidth;
                        $applyHeight = $maxHeight;
                    }
                    $startX = 0;
                    $startY = 0;
                    break;
                case 'resizeCrop':
                    if ($newWidth > $oldWidth)
                        $newWidth = $oldWidth;
                    $ratioX = $newWidth / $oldWidth;
                    if ($newHeight > $oldHeight)
                        $newHeight = $oldHeight;
                    $ratioY = $newHeight / $oldHeight;
                    if ($ratioX < $ratioY) {
                        $startX = round(($oldWidth - ($newWidth / $ratioY)) / 2);
                        $startY = 0;
                        $oldWidth = round($newWidth / $ratioY);
                        $oldHeight = $oldHeight;
                    } else {
                        $startX = 0;
                        $startY = round(($oldHeight - ($newHeight / $ratioX)) / 2);
                        $oldWidth = $oldWidth;
                        $oldHeight = round($newHeight / $ratioX);
                    }
                    $applyWidth = $newWidth;
                    $applyHeight = $newHeight;
                    break;
                case 'crop':
                    $startY = ($oldHeight - $newHeight) / 2;
                    $startX = ($oldWidth - $newWidth) / 2;
                    $oldHeight = $newHeight;
                    $applyHeight = $newHeight;
                    $oldWidth = $newWidth;
                    $applyWidth = $newWidth;
                    break;
                case 'forceCrop':
                    $startY = 0;
                    $startX = 0;
                    $oldHeight = $oldHeight;
                    $applyHeight = $newHeight;
                    $oldWidth = $oldWidth;
                    $applyWidth = $newWidth;
                    break;
            }
            switch ($ext) {
                case 'gif' :
                    $oldImage = imagecreatefromgif($srcimg);
                    break;
                case 'png' :
                    $oldImage = imagecreatefrompng($srcimg);
                    break;
                case 'jpg' :
                case 'jpeg' :
                    $oldImage = imagecreatefromjpeg($srcimg);
                    break;
                default :
                    return false;
                    break;
            }
            $newImage = imagecreatetruecolor($applyWidth, $applyHeight);
            imagecopyresampled($newImage, $oldImage, 0, 0, $startX, $startY, $applyWidth, $applyHeight, $oldWidth, $oldHeight);
            switch ($ext) {
                case 'gif' :
                    imagegif($newImage, $dstimg, $quality);
                    break;
                case 'png' :
                    imagepng($newImage, $dstimg, $quality);
                    break;
                case 'jpg' :
                case 'jpeg' :
                    imagejpeg($newImage, $dstimg, $quality);
                    break;
                default :
                    return false;
                    break;
            }
            imagedestroy($newImage);
            imagedestroy($oldImage);
            return true;
        } else {
            return false;
        }
    }
    function image_type_to_extension($imagetype) {
        if (empty($imagetype))
            return false;
        switch ($imagetype) {
            case IMAGETYPE_GIF : return 'gif';
            case IMAGETYPE_JPEG : return 'jpg';
            case IMAGETYPE_PNG : return 'png';
            case IMAGETYPE_SWF : return 'swf';
            case IMAGETYPE_PSD : return 'psd';
            case IMAGETYPE_BMP : return 'bmp';
            case IMAGETYPE_TIFF_II : return 'tiff';
            case IMAGETYPE_TIFF_MM : return 'tiff';
            case IMAGETYPE_JPC : return 'jpc';
            case IMAGETYPE_JP2 : return 'jp2';
            case IMAGETYPE_JPX : return 'jpf';
            case IMAGETYPE_JB2 : return 'jb2';
            case IMAGETYPE_SWC : return 'swc';
            case IMAGETYPE_IFF : return 'aiff';
            case IMAGETYPE_WBMP : return 'wbmp';
            case IMAGETYPE_XBM : return 'xbm';
            default : return false;
        }
    }
    function get_lat_long($address) {
        //echo $address;
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false');
        $output = json_decode($geocode);
        if (!empty($output->results[0])) {
            $data['lat'] = $output->results[0]->geometry->location->lat;
            $data['long'] = $output->results[0]->geometry->location->lng;
        } else {
            $data['lat'] = "";
            $data['long'] = "";
        }
        return $data;
    }
    function search_event_list($latitude, $longitude, $distance, $ins_sql) {
        $distance = 1000000;
        $query = $this->db->query("SELECT 
		event_details.event_name,
		event_details.event_date,
		event_details.event_from_time,
		event_details.event_to_time,
		event_details.event_no,
		event_details.event_main_pic,
		club_location.club_no,
		club_location.club_name,
		club_location.street,
		club_location.city,
		club_location.state,
		club_location.country,
		club_location.club_main_pic, ( 3959 * acos( cos( radians(" . $latitude . ") ) * cos( radians( club_location.latitude ) ) * cos( radians( club_location.longitude ) - radians(" . $longitude . ") ) + sin( radians(" . $latitude . ") ) * sin( radians( club_location.latitude ) ) ) ) AS distance 
		 FROM event_details 
		 	JOIN club_location ON club_location.club_no=event_details.club_no 
			" . $ins_sql . " 
		  HAVING distance < " . $distance . " ORDER BY event_date,event_from_time,distance DESC");
        if ($query->num_rows() > 0) {
            // echo $this->db->last_query();exit;
            return $query->result_object();
        } else {
            return "";
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //$characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function generateRandomVerificationCode($length = 10) {
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function sms_send_to_student($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
    }
    function __send_sms($message,$mobile) {
        $request = ""; //initialise the request variable
        $param['authkey'] = "111581AKBFtgaQZ2xW5721f975";
        $param['mobiles'] = $mobile; //"9220592205";
        $param['message'] = $message;
        $param['sender'] = "PMELEC";
        $param['route'] = "4";
        
        //Have to URL encode the values
        foreach ($param as $key => $val) {
            $request.= $key . "=" . urlencode($val);
            //we have to urlencode the values
            $request.= "&";
            //append the ampersand (&) sign after each parameter/value pair
        }
        $request = substr($request, 0, strlen($request) - 1);
        //remove final (&) sign from the request
       
        $url = "http://sms.nisbusiness.com/api/sendhttp.php?" . $request;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        //echo $curl_scraped_page; 
    }
    function fetch_message_list($user_no) {
        $query = $this->db->query("SELECT 
										DISTINCT(register_user.user_no),										
										register_user.user_no,
										register_user.first_name,
										register_user.last_name,
										register_user.sex,
										register_user.age,
										user_images.image_url as user_profile_pic,
										follow_user.status										 
								 FROM follow_user 
								 LEFT JOIN register_user 
								 	ON (register_user.user_no=follow_user.follower_user_no OR register_user.user_no=follow_user.main_user )
								 LEFT JOIN user_images ON user_images.user_no=register_user.user_no AND user_images.cover_pic=1
								 WHERE (follower_user_no=$user_no OR main_user=$user_no)
								 AND follow_user.status=2 
								 AND follow_user.type=1
								
								 ");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    function fetch_user_push($user_no) {
        $query = $this->db->query("SELECT register_user.user_no,
	   								   push_id,
									   os_type,
									   register_user.first_name
	   							FROM user_settings 
										JOIN register_user ON register_user.user_no=user_settings.user_no
										WHERE (user_settings.user_no IN 
										(SELECT follower_user_no FROM follow_user 
											JOIN user_settings ON user_settings.user_no=follow_user.follower_user_no 
											WHERE main_user=$user_no AND user_settings.update_notification =2) OR 
											register_user.user_type=0)");
        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return "";
        }
    }
    function search_saloon_list($latitude, $longitude, $distance, $ins_sql) {
        $query = $this->db->query("SELECT DISTINCT `saloon_details`. * , `sallon_facility`. * , `sallon_uploads`.`upload_url`
		FROM `sallon_facility`
		INNER JOIN `sallon_uploads` ON `sallon_uploads`.`saloon_id` = `sallon_facility`.`saloon_id`
		INNER JOIN `saloon_details` ON `saloon_details`.`saloon_id` = `sallon_facility`.`saloon_id` 
		INNER JOIN `saloon_time_slot` ON `saloon_time_slot`.`saloon_id` = `sallon_facility`.`saloon_id`
		WHERE `sallon_facility`.`is_deal` =0
		AND `sallon_facility`.`percent_discount` >0
		AND `sallon_facility`.`percent_discount` >0
		AND `sallon_facility`.`deal_price` >0
		AND `sallon_facility`.`facility_id` >0 " . $ins_sql . " ORDER BY `sallon_facility`.`saloon_id` DESC");
        // GROUP_CONCAT(sallon_uploads.upload_url) as saloon_images,
        // , ( 3959 * acos( cos( radians(".$latitude.") ) * cos( radians( saloon_details.latitude ) ) * cos( radians( saloon_details.longitude ) - radians(".$longitude.") ) + sin( radians(".$latitude.") ) * sin( radians( saloon_details.latitude ) ) ) ) AS distance   HAVING distance < ".$distance."  ".$ins_sql."
        if ($query->num_rows() > 0) {
            // echo $this->db->last_query();exit;
            return $query->result_object();
        } else {
            return "";
        }
    }
    
    
    
    function update_application($application_id,$max) {
      
       // $update_ins['payment_status'] = 2;
        //$where['application_id'] = (string)$application_id;
       // $rs = $this->db->update('application_details', $update_ins, $where);
        //echo $rs;
        //$query = $this->db->query("UPDATE `application_details` SET `merit_list`=".$max." WHERE `application_id`='".$application_id."'");
      $sql = "UPDATE `application_details` SET `merit_list`=".$max." WHERE `application_id`='".$application_id."'";
        $query = $this->db->simple_query($sql);  
       
        
//        $this->db->where('application_id',  $application_id); 
//        $this->db->set('merit_list',$max);
//        $this->db->update('application_details');
       // echo $this->db->last_query();
       
    }
    
    function success_payment() {
        if (!empty($_REQUEST['txnid'])) {
            $order_id = str_replace('ORD', '', $_REQUEST['txnid']);
            $data1 = array(
                'payment_status' => 1
            );
            $this->db->where('order_no', $order_id);
            if ($this->db->update('order', $data1)) {
                return $order_id;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    }
    
   
     function fetch_inspector($latitude,$longitude,$distance,$category_id){
         
         $query=$this->db->query("SELECT 
						DISTINCT(fd_inspector_details.id),
						fd_inspector_details.*,						
						 ROUND(( 6371 * acos( cos( radians(".$latitude.") ) * cos( radians( latitude ) ) * cos( radians( longtitude ) - radians(".$longitude.") ) + sin( radians(".$latitude.") ) * sin( radians( latitude ) ) ) ),2) AS distance 
		 FROM fd_inspector_details 
                 LEFT JOIN fd_inspector_category ON fd_inspector_category.inspector_id=fd_inspector_details.user_id 
		 WHERE fd_inspector_category.floor_category_id=".$category_id." AND fd_inspector_details.is_deleted=0 HAVING distance < ".$distance." ORDER BY distance ");
         
		//echo $this->db->last_query();
		 if($query->num_rows()>0){
            return $query->result_object();
         }else{
            return "";
         }
	}
        function fetch_inspector_by_category($category_id){
         
         $query=$this->db->query("SELECT 
						DISTINCT(fd_inspector_details.id),
						fd_inspector_details.*
                                            FROM fd_inspector_details 
                 LEFT JOIN fd_inspector_category ON fd_inspector_category.inspector_id=fd_inspector_details.user_id 
		 WHERE fd_inspector_category.floor_category_id=".$category_id."  AND fd_inspector_details.is_deleted=0" );
         
		// echo $this->db->last_query();
		 if($query->num_rows()>0){
            return $query->result_object();
         }else{
            return "";
         }
	}
	
	 public function fetch_data_array($table_name, $field = array('*'), $where = '', $joining = '', $search = '', $order = '', $by = '', $page_number = '', $item_per_page = '', $group_by = '', $having = '', $start = '', $end = '',$where_string='') {
        $this->db->select($field);
         if (!empty($where)) {
            foreach ($where as $key => $where_list) {
                if (strpos($where_list, ",") == true) {
                     $wh_list = explode(",", $where_list);
                    if(strpos($key,'NOT IN') !== false){
                        $key = str_replace("NOT IN","",$key);
                        $this->db->where_not_in($key, $wh_list);
                    }else{
                        $this->db->where_in($key, $wh_list);
                    }                    
                } else {
                    $this->db->where($key, $where_list);
                }
            }
        }
        if($where_string!=""){
            $this->db->where($where_string);
        }
        if (!empty($search) && is_array($search)) {
            foreach ($search as $key => $search_list) {
                if ($search_list != "") {
                    $this->db->or_like($key, $search_list);
                }
            }
        }
        if (!empty($joining) || !empty($joining) && is_array($search)) {
            foreach ($joining as $key => $join_list) {
                if (strpos($join_list, "|") == true) {
                    $join = explode("|", $join_list);
                    $this->db->join($key, $join[0], $join[1]);
                } else {
                    $this->db->join($key, $join_list, 'left');
                }
            }
        }
        if ($page_number !== "" && $item_per_page != "") {
            //$this->db->order_by($order,$by); 
            $start_point = $item_per_page * $page_number;
            $this->db->limit($item_per_page, $start_point);
        }
        if ($order != "" && $by != "") {
            $this->db->order_by($order, $by);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        if (!empty($having)) {
            foreach ($having as $key => $having_list) {
                $this->db->having($key, $having_list);
            }
        }
        if (!empty($end)) {
            $this->db->limit($end, $start);
        }
       $query = $this->db->get($table_name);
        
        $arr = array();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $arr;
        }
    }
     function get_inspecto_carpet_report($id){
         
         $query=$this->db->query("SELECT fd_carpet_report.* FROM fd_carpet_report WHERE customer_hire_inspector_id IN(
             SELECT 
						fd_customer_hire_inspector.id
                                            FROM fd_customer_hire_inspector                  
		 WHERE inspector_id in(SELECT fd_customer_hire_inspector.inspector_id FROM fd_customer_hire_inspector WHERE fd_customer_hire_inspector.id='".$id."')) ORDER BY id DESC LIMIT 0,40" );
         
		
		 if($query->num_rows()>0){
            return $query->result_object();
         }else{
            return "";
         }
	}    
        
        
        function get_issue_solutions($id){
         
         $query=$this->db->query("SELECT fd_carpet_claims_solutions.* FROM fd_carpet_claims_solutions WHERE customer_hire_inspector_id IN(
             SELECT 
						fd_customer_hire_inspector.id
                                            FROM fd_customer_hire_inspector                  
		 WHERE inspector_id in(SELECT fd_customer_hire_inspector.inspector_id FROM fd_customer_hire_inspector WHERE fd_customer_hire_inspector.id='".$id."')) ORDER BY id DESC LIMIT 0,40" );
         
		
		 if($query->num_rows()>0){
            return $query->result_object();
         }else{
            return "";
         }
	}   
        
        
       public function total_sales() {

             $query=$this->db->query("SELECT SUM(products.price) as total FROM sales
                                      INNER JOIN products ON sales.product=products.id 
                                      GROUP BY MONTH(sales.period)");
             
          if($query->num_rows()>0){

             return $query->result_array();
          }
          else{

            return "";

         }
          
       }
	   
	          public function current_response() {
				  
				  $today = date("Y-m-d");
				  $today_time = date("Y-m-d H:i:s");
				 //echo $today;
				 //exit;

             $query=$this->db->query("SELECT client_name , mobile_number ,follow_on FROM demo WHERE DATE(follow_on) = '$today' && follow_on > '$today_time'");
             
          if($query->num_rows()>0){
			  
			  //echo $this->db->last_query();

             return $query->result_object();
          }
          else{

            return false;

         }
          
       }



       function check_forgot_pass($phone_no,$user_name,$full_name,$user_id,$branch){
         $full_n = explode(" ",$full_name);

         
         $query=$this->db->query("SELECT fx_user.*,fx_user_details.center_id FROM fx_user left join fx_user_details on fx_user.id=fx_user_details.user_id 
            WHERE
            fx_user.phone_no ='$phone_no' 
            AND fx_user.emp_id='$user_id' 
            AND fx_user_details.center_id ='$branch' 
            AND (fx_user.email = '$user_name' 
            OR fx_user.f_name = '".$full_n[0]."'
            OR fx_user.l_name = '".$full_n[1]."')");
         
        
         if($query->num_rows()>0){
            return $query->result_object();
         }else{
            return "";
         }
    } 

     public function pending_status() {
        $admin_sessions = $this->session->userdata('admin_session');

                  $today = date('Y-m-d');

                  //$time =  date('H:i:s');

                   $tt =  date('H:i:s', strtotime('-5 hours'));

                  // echo   $tt;

     $query=$this->db->query("SELECT * FROM fx_leads WHERE appoint_date = '$today' &&  appoint_time_start < '$tt' && substatus != 3");
             
          //if($query->num_rows()>0){
              
             // echo $this->db->last_query();

             return $query->result_object();
          //}
         //  else{

         //    return false;

         // }

     }

     

}


?>