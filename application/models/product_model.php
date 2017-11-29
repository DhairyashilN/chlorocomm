<?php class product_model extends CI_Model{

	//function to add new product category
	public function add_category()
		{
			$data['category'] = $this->input->post('categoryname');
			$data['description'] = $this->input->post('description');
			$data['added_by'] = $this->session->userdata('name');
			$data['dateCreated'] = date("Y-m-d, h:i:s ");
			//print_r($data);die;
			$this->db->insert('category', $data);
			$this->session->set_flashdata('success','Product Category Added Successfully');
			
		}
		public function add_subcategory()
		{
			$data['cat_id'] = $this->input->post('categoryid');
			$data['subcategory'] = $this->input->post('subcategory');
			$data['description'] = $this->input->post('description');
			$data['added_by'] = $this->session->userdata('name');
			$data['dateCreated'] = date("Y-m-d, h:i:s ");
			//print_r($data);die;
			$this->db->insert('subcategory1', $data);
			$this->session->set_flashdata('success','Product Subcategory Added Successfully');
		}
		public function addSubSubcategory()
		{
			$data['cat_id'] = $this->input->post('categoryid');
			$data['subcat1_id'] = $this->input->post('subcategoryid');
			$data['subcategory2'] = $this->input->post('subsubcategory');
			$data['description'] = $this->input->post('description');
			$data['added_by'] = $this->session->userdata('name');
			$data['dateCreated'] = date("Y-m-d, h:i:s ");
			//print_r($data);die;
			$this->db->insert('subcategory2', $data);
			$this->session->set_flashdata('success','Product Sub Subcategory Added Successfully');
		}
		public function addProductDetails()
		{
			$owner_id=$this->session->userdata('admin_id');
			$data['cat_id'] = $this->input->post('categoryid');
			$data['product_owner_id'] =$owner_id;
			$data['subcat1_id'] = $this->input->post('subcategoryid');
			$data['subcat2_id'] = $this->input->post('Subsubcategoryid');
			$data['product_name'] = $this->input->post('product_name');
			$data['image'] = $_FILES['userfile']['name'];
			$data['description'] = $this->input->post('description');
			$data['amount'] = $this->input->post('amount');
			$data['coupon_applied'] = $this->input->post('coupon_apply');
			$data['coupon_code'] = $this->input->post('coupon_code');
			$data['publish'] = $this->input->post('product_publish');
			$data['delivery_pincodes'] = $this->input->post('product_delivery_pincodes');
			$data['added_by'] = $this->session->userdata('name');
			$data['dateCreated'] = date("Y-m-d, h:i:s ");
			
			if($data['image']!='')
			{
				$config['upload_path'] = './upload/product_images';
		        $config['allowed_types'] = 'gif|jpg|png';
		
		        $this->load->library('upload');
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				}
				else
				{
					$data1 = $this->upload->data();
					$fileimage = $data1['file_name'];
				}
			}
			//print_r($data);die;
			$this->db->insert('product', $data);
			$this->session->set_flashdata('success','Product data Added Successfully');
		}
		public function edit_category($id)
		{
			$data['category'] = $this->input->post('category');
			$data['description'] = $this->input->post('description');
			$this->db->where('cat_id',$id);
			$this->db->update('category', $data);
			$this->session->set_flashdata('success','Category Edited Successfully');
		}
	


}?>