<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	function Member() {
		parent::__construct();
		
		$this->load->helper(array("form"));
		//$this->load->database();
	}

	public function index() {
		if($this->session->userdata('userid')) {
			$this->load->view('/');
		}
		
		$this->load->view('/member/mem_top');
		$this->load->view('/member/join_form');
		$this->load->view('/member/mem_footer');
	}
	
	public function join_form() {
		if($this->session->userdata('userid')) {
			$this->load->view('/');	
		}
		
		$this->load->view('/member/mem_top');
		$this->load->view('/member/join_form');
		$this->load->view('/member/mem_footer');
	}
	
	public function join_progress() {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		$this->form_validation->set_message('mem_id_check', '이미 가입된 이메일 주소입니다.');
		
		$this->load->model('Member_model');
		
		
		if($this->uri->segment(3) == 'r') {
			$this->form_validation->set_rules('mem_id', '아이디', 'required|valid_email|callback_mem_id_check');
			$this->form_validation->set_rules('mem_name', '이름', 'required');
			$this->form_validation->set_rules('mem_passwd', '비밀번호', 'required|min_length[4]|max_length[12]');
			$this->form_validation->set_rules('mem_repasswd', '비밀번호확인', 'required');
			
			$data['mode'] = "가입";
			
			if($this->form_validation->run() == FALSE) {
				$this->load->view('/member/join_form');
				return;
			}
			else {
				if($this->Member_model->member_insert()) { //DB입력이 완료된 경우
					$this->load->library('encrypt');
					
					$data['result'] = 1; 
					$enc_id = base64_encode($_POST['mem_id']); 
					
					$success_msg = "
						<p>회원가입을 완료 하시려면 인증확인을 클릭하세요</p>
							
						<p><a href='http://localhost/member/join_auth/?auth_key=".$enc_id."'>인증확인</a></p>
					";
					
					//메일발송
					$this->load->library('email');
					$this->email->to($_POST['mem_id']);
					$this->email->from('asd2354@gmail.com', 'cyller note');
					$this->email->subject('CYLLER NOTE 회원가입이 완료되었습니다.');
					$this->email->message($success_msg);
					$this->email->send();
				}
				else {
					$data['result'] = 0;
				}
			}
		}
		
		$data['mem_id'] = $_POST['mem_id'];
		
		$this->load->view('/member/mem_top');
		$this->load->view("/member/join_progress", $data);
		$this->load->view('/member/mem_footer');
	}
	
	//회원가입 메일 인증
	public function join_auth() {
		$this->load->model('Member_model');
		$this->load->library('encrypt');
		
		$auth_key = $this->input->get('auth_key');
		$mem_id = base64_decode($auth_key);
		
		$udata = array("mem_check"=>date("Y-m-d H:i:s", time()));
		$where = "mem_id='".$mem_id."'";
		
		if($this->Member_model->member_update($udata, $where)) {
			$data['result'] = 3;
		}
		else {
			$data['result'] = 4;
		}
		
		$data['mode'] = "가입인증";
		$data['mem_id'] = $mem_id;
	
		$this->load->view('/member/mem_top');
		$this->load->view("/member/join_progress", $data);
		$this->load->view('/member/mem_footer');
	}
	
	//아이디 중복 확인
	function mem_id_check($str) {
		$this->load->model('Member_model');
		
		$sql = " SELECT mem_id FROM member WHERE mem_id='$str'";
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	//회원정보수정 폼
	public function join_modify() {
		if($this->uri->segment(3) == 'y') {
			$data['result'] = "<div class='error_box'>회원정보가 수정되었습니다.</div>";
		}
		else if($this->uri->segment(3) == 'n'){
			$data['result'] = "<div class='error_box'>회원정보수정 실패</div>";
		}
		else $data['result'] = '';
		
		if($this->input->get('large_img_name')) $data['large_img_name'] = $this->input->get('large_img_name');
		else $data['large_img_name'] = '';
		
		$this->load->view('/member/mem_top');
		$this->load->view("/member/join_modify", $data);
		$this->load->view('/member/mem_footer');
	}
	
	//회원정보수정
	public function join_modi_progress() {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
		
		if($this->uri->segment(3) == 'n') {
			$this->form_validation->set_rules('mem_name', '이름', 'required');
			
			$mem_name = iconv('utf-8', 'euc-kr', $_POST['mem_name']);
			//$mem_name = $_POST['mem_name'];
			
			//DB수정
			$this->load->model('Member_model');
			$qry_data['mem_name'] = $mem_name;
			
			$qry_result = $this->Member_model->member_update($qry_data, 'mem_id='.$this->db->escape($this->session->userdata('userid')));
			
			if( ! $qry_result) $rst = 'n';
			else $rst = 'y';
			
			//세션만들기
			$sess_data = array(
					"user_name"=>$mem_name
			);
				
			$this->session->set_userdata($sess_data);
			
			echo "<script>location.replace('/member/join_modify/".$rst."');</script>";
		
		}
		else if($this->uri->segment(3) == 'p') {
			$filename = '';
			
			//사진 업로드 환경설정
			if($_FILES['mem_photo']['name'] != '') {
				$config['upload_path'] = './uploads/memphoto';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size'] = '100';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				
				$this->load->library('upload', $config);
				
				if( ! $this->upload->do_upload('mem_photo')) {
					$data['result'] = $this->upload->display_error('<div class="error_box">', '</div>');
					
					$this->load->view('/member/mem_top');
					$this->load->view('/member/join_modify', $data);
					$this->load->view('/member/mem_footer');
					
					return;
				}
				else {
					$fdata = $this->upload->data();
					$filename = $fdata['file_name'];
					$large_image = "D:\\phpwork\\SWNEW\\uploads\\memphoto\\".$filename;
					
					$this->load->helper('image_crop');
					$max_width = 380;					
										
					$width = getWidth($large_image);
					$height = getHeight($large_image);
					//Scale the image if it is greater than the width set above
					if ($width > $max_width){
						$scale = $max_width/$width;
						$uploaded = resizeImage($large_image,$width,$height,$scale);
					}else{
						$scale = 1;
						$uploaded = resizeImage($large_image,$width,$height,$scale);
					}
				}
			}
			
			echo "<script>location.replace('/member/join_modify/?large_img_name=".$filename."');</script>";
		}
		else if($this->uri->segment(3) == 't') {
			$this->load->helper('image_crop');
			
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			//Scale the image to the thumb_width set above
			$scale = 120/$w;
			$large_image = "D:\\phpwork\\SWNEW\\uploads\\memphoto\\".$_POST['img_name'];
			
			$thumb_name = "thumb_".$_POST['img_name'];
			$thumb_image = "D:\\phpwork\\SWNEW\\uploads\\memphoto\\thumb_".$_POST['img_name'];
			
			$cropped = resizeThumbnailImage($thumb_image, $large_image,$w,$h,$x1,$y1,$scale);
			
			//DB수정
			$this->load->model('Member_model');
			$qry_data['mem_photo'] = $thumb_name;
				
			$qry_result = $this->Member_model->member_update($qry_data, 'mem_id='.$this->db->escape($this->session->userdata('userid')));
				
			if( ! $qry_result) $rst = 'n';
			else $rst = 'y';
				
			//세션만들기
			$sess_data = array(
					"user_photo"=>$thumb_name
			);
			
			$this->session->set_userdata($sess_data);
			
			echo "<script>location.replace('/member/join_modify/".$rst."');</script>";
			
		}
		else {
			echo "<script>location.replace('/member/join_modify/".$rst."');</script>";
		}		
		
	}
	
	//로그인 폼
	public function login() {
		if($this->session->userdata('userid')) {
			$this->load->view('/');
		}
		
		$data['msg'] = "";
		
		$this->load->view('/member/mem_top');
		$this->load->view('/member/login', $data);
		$this->load->view('/member/mem_footer');
	}
	
	//로그인
	public function login_process() {

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
			
		$this->form_validation->set_rules('mem_id', '아이디', 'required|valid_email');
		$this->form_validation->set_rules('mem_passwd', '비밀번호', 'required|min_length[4]|max_length[12]');
			
		if($this->form_validation->run() == FALSE) {
			$this->load->view('/member/login');
			return;
		}
		else {
			$this->load->model('Member_model');
			$que = "SELECT * FROM member WHERE mem_id='".$_POST['mem_id']."'";
			$result = $this->Member_model->member_select($que);	
			
			$data['msg'] = "";
			
			if($result == "none") {
				$data['msg'] = "일지하는 회원정보가 없습니다.";
			}
			else if($result == "dup") {
				$data['msg'] = "중복된 아이디가 있습니다. 관리자에게 문의하세요.";
			}
			else {
				$_mem_passwd = $result->mem_passwd;
				
				if($_mem_passwd != md5($_POST['mem_passwd'])) {
					$data['msg'] = "비밀번호를 확인하세요.";
				}
				
				if($result->mem_check == 'N') {
					$data['msg'] = "이메일 인증을 하지 않으셨습니다.";
				}
			}
			
			if($data['msg'] != "") {
				$this->load->view('/member/mem_top');
				$this->load->view('/member/login', $data);
				$this->load->view('/member/mem_footer');
				return;
			}
			
			//최종로그인 기록
			$qry_data = array('mem_last_login'=>date('Y-m-d H:i:s', time()));
			$qry_result = $this->Member_model->member_update($qry_data, 'mem_id='.$this->db->escape($_POST['mem_id']));
			
			$mem_photo = $result->mem_photo;
			if($mem_photo == '') $mem_photo = "basic.png";
			
			//세션만들기
			$sess_data = array(
							"userid"=>$_POST['mem_id'],
							"user_name"=>$result->mem_name,
							"user_photo"=>$mem_photo
						 );
			
			$this->session->set_userdata($sess_data);
			
			echo "<script>location.replace('/');</script>";
		}
		
	}
	
	public function logout() {
		$this->session->sess_destroy();
		
		echo "<script>location.replace('/member/logout_chk');</script>";
	}
	
	public function logout_chk() {
		$this->load->view('/member/mem_top');
		$this->load->view('/member/logout_chk');
		$this->load->view('/member/mem_footer');
	}

}
