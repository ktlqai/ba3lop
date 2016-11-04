<?php
Class Dathang extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load ra file model
        $this->load->model('dathang_model');
		
		$this->load->model('dathang_dong_model');
        
        // Tai cac file thanh phan
        $this->load->helper('language');
        $this->lang->load('admin/dathang');
		$this->lang->load('admin/user');
        $this->lang->load('admin/user_refer');
        $this->lang->load('admin/common');
        
    }
	
	function nhaplieu()
	{
		//load thu vien validation
	   $this->load->library('form_validation');
	   $this->load->helper('form');

	   //tao cac tap luat
	   /*$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
	   $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[8]');
	   $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[8]|numeric');
	   $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|numeric');
	   $this->form_validation->set_rules('password_repeat', 'Nhập lại mật khẩu', 'required|matches[password]');
	   $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
*/
	   /*if($this->form_validation->run())
	   {
	       //lay du lieu tu form
	       $name     = $this->input->post('name');
	       $email    = $this->input->post('email');
	       $password = $this->input->post('password');
	       $password = md5($password);
	       $phone    = $this->input->post('phone');
	       $address  = $this->input->post('address');
				 $cmnd  = $this->input->post('cmnd');
				 $address_giaohang  = $this->input->post('address_giaohang');
				 $dob  = $this->input->post('dob');
	       //du lieu them vao bang thanh vien
	       $data = array(
	           'name'     => $name,
	           'email'    => $email,
	           'password' => $password,
	           'phone'    => $phone,
	           'address'  => $address,
						 'ID_CMND' => $cmnd,
	           'address_giaohang'    => $address_giaohang,
	           'dob'  => $dob
 	       );
	       //them thanh vien vao trong csdl
	       if($this->user_model->create($data))
	       {
	       	  $this->session->set_flashdata('flash_message', 'Thêm thành viên thành công');
			  redirect(base_url('admin/user'));//chuyen toi trang danh sách thành viên
	       }
	    }*/
		
		if ($this->input->post('dathang_nhaplieu')) {
			//lay du lieu tu form
			$user_name     = $this->input->post('user_name');
			$ngay_dat_hang    = $this->input->post('ngay_dat_hang');
			$user_refer = $this->input->post('user_refer');
			
			$user_name_and_user_id = explode('-', $user_name);
			$user_id = $user_name_and_user_id[1];
			
			$user_refer_and_user_refer_id = explode('-', $user_refer);
			$user_refer_id = $user_refer_and_user_refer_id[1];
			
			//du lieu them vao bang thanh vien
			$data = array(
				'user_id'     => $user_id,
				'notkeyword_date'    => $ngay_dat_hang,
				'user_refer_id' => $user_refer_id,
				'created'  => now()
			);
			
			$str_flash = '';
			//them thanh vien vao trong csdl
			if($this->dathang_model->create($data))
			{
				//$this->session->set_flashdata('flash_message', 'Thêm thành viên thành công');
				//$str_flash .= 'Tạo đơn hàng thành công';
				//redirect(base_url('admin/user'));//chuyen toi trang danh sách thành viên
			
				$dathang_id = $this->db->insert_id();
				
				$dathang_n     = $this->input->post('bao_nhieu_mat_hang'); //echo $dathang_n; die();
				
					//$this->load->helper('log4php');
					//log_error('hogehoge');
					//log_info('hogehoge');
					//log_debug('hogehoge' . $dathang_n);
				
				$product_name_s = $this->input->post('product_name');
				$so_luong_s    = $this->input->post('so_luong');
				$gia_don_vi_s = $this->input->post('gia_don_vi');
				
				for ($i = 0; $i < $dathang_n; $i++) {
					$product_name     = $product_name_s[$i];
					$so_luong     = $so_luong_s[$i];
					$gia_don_vi     = $gia_don_vi_s[$i];
					
					//du lieu them vao bang thanh vien
					$data = array(
						'dathang_id'     => $dathang_id,
						'tensanpham'    => $product_name,
						'soluong' => $so_luong,
						'giadonvi'  => $gia_don_vi
					);
					
					$this->dathang_dong_model->create($data);
					
				}
				
				redirect(base_url('admin/dathang'));
				
			}
			
		}
			
		$this->data['action'] = current_url();

		// Hien thi view
		$this->data['temp'] = 'admin/dathang/nhaplieu';
		$this->load->view('admin/main', $this->data);
	}
    
    /*
     * Hien thi danh sach giao dịch
     */
    function index()
    {
        //lay tong so luong ta ca cac giao dich trong websit
        $total_rows = $this->dathang_model->get_total();
        $this->data['total_rows'] = $total_rows;
        
        //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac giao dich tren website
        $config['base_url']   = admin_url('dathang/index'); //link hien thi ra danh sach giao dich
        $config['per_page']   = 10;//so luong giao dich hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        
        $input = array();
        $input['limit'] = array($config['per_page'], $segment);
        
        //kiem tra co thuc hien loc du lieu hay khong
        $id = $this->input->get('id');
        $id = intval($id);
        $where = array();
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        //lọc theo thành viên
        $user = $this->input->get('user');
        if($user)
        {
            $where['user_id'] = $user;
        }
        
        //lọc theo cổng thanh toán
        $payment = $this->input->get('payment');
        if($payment)
        {
            $where['payment'] = $payment;
        }
        
        //lọc theo trạng thái thanh toán
        $status = $this->input->get('status');
        if($status != '')
        {
            $where['status'] = $status;
        }
        //lọc theo thời gian
   	    $created_to = $this->input->get('created_to');
   	    $created    = $this->input->get('created');
   	    if($created && $created_to)
   	    {
   	    	//tiem kiem tu ngay A -> B
   	    	$time = get_time_between_day($created,$created_to);
   	        //nếu dữ liệu trả về hợp lệ
	   	    if(is_array($time))
	   	    {	
		   	    $where['created >='] = $time['start'];
		   	    $where['created <='] = $time['end'];
	   	    }
   	    }
        //gắn các điệu điện lọc
        $input['where'] = $where;
        
        
        //lay danh sach san pha
        $list = $this->dathang_model->get_list($input);
		
		// tinh toan ra 3 tham so nua : tongthanhtien , payment , va status
		foreach ($list as $row) {
			
			$dathang_id = $row->id;
			
			$query = $this->db->query('SELECT SUM(soluong * giadonvi) as tongthanhtien FROM dathang_dong WHERE dathang_id = ' . $dathang_id);
			
			$tongthanhtien = $query->row()->tongthanhtien;
			
			$row->amount = $tongthanhtien;
			
			$row->payment = 'dont care';
			
			$row->status = 'why to care';
			
		}
		
        $this->data['list'] = $list;
    
        $this->data['filter'] = $input['where'];
        $this->data['created_to'] = $created_to;
        $this->data['created']    = $created;
        
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        //load view
        $this->data['temp'] = 'admin/dathang/index';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Xuất dữ liệu ra file excel
     */
    public function export()
    {
        //lay toan bo giao dịch
        $list = array();
        $list = $this->dathang_model->get_list();
        foreach ($list as $row)
        {
            $row->_amount = number_format($row->amount);
            if($row->status == 0)
            {
                $row->_status = 'pending';
            }
            elseif($row->status == 1)
            {
                $row->_status = 'completed';
            }
            elseif($row->status == 2)
            {
                $row->_status = 'cancel';
            }
    
        }
        $this->data['list'] = $list;
        // Hien thi view
        $this->load->view('admin/dathang/export', $this->data);
    }
    
    /*
     * ------------------------------------------------------
     *  Action handle
     * ------------------------------------------------------
     */
    /**
     * Xem chi tiet giao dich
     */
    function view()
    {
        //lay id cua giao dịch ma ta muon xoa
        $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dịch
        $info = $this->dathang_model->get_info($id);
        if(!$info)
        {
            return false;
        }

            // lay thong tin user tu bang user , roi gan vao bien $info
            $this->load->model('user_model');
            $user_info = $this->user_model->get_info($info->user_id);

            $info->user_name = $user_info->name;
            $info->user_email = $user_info->email;
            $info->user_phone = $user_info->phone;

            $info->message = "Nhap lieu vao thi co msg gi";

            	$this->load->model('user_refer_model');
	            $user_refer_info = $this->user_refer_model->get_info($info->user_refer_id);

	            $info->user_refer_name = $user_refer_info->name;

		
					// tu thong tin id cua bang dathang -> ta chuyen sang bang dathang_dong de lay amount .
					$dathang_id = $info->id;
					
					$query = $this->db->query('SELECT SUM(soluong * giadonvi) as tongthanhtien FROM dathang_dong WHERE dathang_id = ' . $dathang_id);
					
					$tongthanhtien = $query->row()->tongthanhtien;
					
					$info->amount = $tongthanhtien;
					
					$info->payment = 'dont care';
					
					$info->status = 'why to care';
		
        $info->_amount = number_format($info->amount);
        if($info->status == 0)
        {
            $info->_status = 'pending';//đợi xử lý
        }
        elseif($info->status == 1)
        {
            $info->_status = 'completed';//hoàn thành
        }
        elseif($info->status == 2)
        {
            $info->_status = 'cancel';//hủy bỏ
        }
        //lấy danh sách đơn hàng  của giao dịch này
        $this->load->model('dathang_dong_model');
        $input = array();
        $input['where'] = array('dathang_id' => $id);
        $orders = $this->dathang_dong_model->get_list($input);
        if(!$orders)
        {
            return false;
        }
        //load model sản phẩm product_model
        //$this->load->model('product_model');
        foreach ($orders as $row)
        {
            //thông tin sản phẩm
            //$product = $this->product_model->get_info($row->product_id);
            //$product->image = base_url('upload/product/'.$product->image_link);
            //$product->_url_view = site_url('product/view/'.$product->id);
            	
            //$row->_price = number_format($product->price);

                // thong tin san pham , viet code sua lai . chu lam gi co bang product ma get
                $product = new stdClass();
                $product->image = base_url('upload/product/'.'shit.jpg');
                $product->_url_view = site_url('product/view/'.'shit');
                            // fake infos for product since datahang_dong is simple (not a table product)
                            $product->name = $row->tensanpham;

            // fake qty since there is no qty in dathang_dong , but instead it is soluong
            $row->qty = $row->soluong;                
                    
                $row->_price = number_format($row->giadonvi);
			
						// make amount for dathang_dong by row , one by one .
						$row->amount = $row->soluong * $row->giadonvi;
            $row->_amount = number_format($row->amount);
            $row->product = $product;  // assign the product back to orders
            $row->_can_active = true;//có thể thực hiện kích hoạt đơn hàng này hay không
            $row->_can_cancel = TRUE;//có thể hủy đơn hàng hay không
            
						// fake the status (as in dathang_dong , there is no status column)
						$row->status = 1;
            if($row->status == 0)
            {
                $row->_status     = 'pending';//đợi xử lý
            }
            elseif($row->status == 1)
            {
                $row->_status = 'completed';//Đã giao hàng
                $row->_can_active = false;//không thể kích hoạt
            }
            elseif($row->status == 2)
            {
                $row->_status = 'cancel';//hủy bỏ
                $row->_can_cancel = false;//không thể kích hoạt
            }
            //link hủy bỏ đơn hàng
            $row->_url_cancel = admin_url('dathang/cancel/'.$row->id);
            $row->_url_active = admin_url('dathang/active/'.$row->id);//link kích hoạt đơn hàng
        }
    
        $this->data['info']   = $info;
        $this->data['orders'] = $orders;
        // Tai file thanh phan
        $this->load->view('admin/dathang/view', $this->data);
    }
    
    /**
     * Xac nhan giao dich
     */
    function active()
    {
        $this->load->model('order_model');
        //lay id cua đơn hàng ma ta muon kích hoạt
        $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dịch
        $info = $this->order_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại đơn hàng này');
            redirect(admin_url('dathang'));
        }
    
        //Cập nhật trạng thái giao hàng
        $data = array();
        $data['status'] = 1;//đã gửi hàng
        $this->order_model->update($id, $data);
    
        //tru di so luong san pham da chuyen cho khach
        //va cong so luong san pham da ban
        $this->load->model('product_model');
        //lay thong san pham trong cai don hang nay
        $product = $this->product_model->get_info($info->product_id);
        $data = array();
        $data['buyed'] = $product->buyed + $info->qty; //cap nhat so luong da mua
        $this->product_model->update($product->id, $data);
        	
        //gui thong bao
        $this->session->set_flashdata('message', 'Đã cập nhật trạng thái đơn hàng thành công');
        redirect(admin_url('order'));
    }
    
    /**
     * Huy bo giao dich
     */
    function cancel()
    {
        $this->load->model('order_model');
        //lay id cua đơn hàng ma ta muon hủy
        $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dịch
        $info = $this->order_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại đơn hàng này');
            redirect(admin_url('order'));
        }
    
        $data = array();
        $data['status'] = 2;//Hủy giao dịch
        $this->dathang_model->update($info->dathang_id, $data);
    
        //Cập nhật trạng thái hủy đơn hàng
        $data = array();
        $data['status'] = 2;//Hủy đơn hàng
        $this->order_model->update($id, $data);
    
        //gui thong bao
        $this->session->set_flashdata('message', 'Đã hủy đơn hàng thành công');
        redirect(admin_url('order'));
    }
    
    /*
     * Xoa du lieu
     */
    function del()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
    
        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'không tồn tại giao dịch này');
        redirect(admin_url('dathang'));
    }
    
    /*
     * Xóa nhiều sản phẩm
     */
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }
    
    /*
     *Xoa san pham
     */
    private function _del($id)
    {
        $dathang = $this->dathang_model->get_info($id);
        if(!$dathang)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại giao dịch này');
            redirect(admin_url('dathang'));
        }
        //thuc hien xoa san pham
        $this->dathang_model->delete($id);
        
    }
}
