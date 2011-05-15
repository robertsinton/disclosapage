<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Disclosapage - Disclosure triangles for MojoMotor's page manipulation tree.
 *
 * @package		MojoMotor
 * @subpackage	Addons
 * @author		Robert Sinton
 * @license		Apache License v2.0
 * @copyright	2011 Robert Sinton / Digital Fusion
 *
 * js() and _load_vew() functions are from Dan Horrigan's "Equipment" addon for MojoMotor.
 * https://github.com/dhorrigan/mojo-equipment
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *		http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class Disclosapage
{
	public $addon_version = '1.0';
	public $display_name = 'Disclosapage';

	private $mojo;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		$this->mojo =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	 * Starts up the implementation of disclosure triangles for the page manipulation tree.
	 *
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	public function start($template_data = array())
	{
		if ($this->mojo->session->userdata('group_id') != 1)
		{
			return;
		}

		$return = '<script charset="utf-8" type="text/javascript" src="'.site_url('admin/addons/disclosapage/js/disclosapage.js').'"></script>';
		$return .= PHP_EOL.
			'<style type="text/css">' .
				'.disclosure_target { background: url('.site_url('admin/assets/img/arrow_down.png').') no-repeat center left; } '.
				'.disclosure_triangle_right { background: url('.site_url('admin/assets/img/arrow_right.png').') no-repeat center left; } '.
			'</style>';

		$this->mojo->cp->appended_output[] = $return;
		
		return '';
	}

	// --------------------------------------------------------------------

	
	/**
	 * This loads a javascript file and outputs it.
	 * You can specify an addional segment for the loader.js
	 * 
	 * Called like this: http://example.com/index.php/addons/disclosapage/js/disclosapage.js
	 *
	 * This function is from Dan Horrigan's Equipment MojoMotor addon.
	 *
	 * @access	public
	 * @return	string	Outputs the file
	 */
	public function js()
	{
		if ($this->mojo->session->userdata('group_id') != 1)
		{
			return;
		}

		$file_name = $this->mojo->uri->segment(5);
		header("Content-Type: text/javascript");
		exit($this->_load_view('javascript/'.$file_name));
	}

	/**
	 * Loads a view.
	 *
	 * This function is from Dan Horrigan's Equipment MojoMotor addon.
	 *
	 * @access	private
	 * @param	string	The view to load MUST include the folder (i.e. views/index)
	 * @param	array	The data for the view
	 * @param	bool	Where to return the results
	 * @return	string	The view contents
	 */
	private function _load_view($view, $data = array(), $return = TRUE)
	{
		$orig_view_path = $this->mojo->load->_ci_view_path;
		$this->mojo->load->_ci_view_path = APPPATH.'third_party/disclosapage/';

		$return = $this->mojo->load->view($view, $data, $return);

		$this->mojo->load->_ci_view_path = $orig_view_path;
		
		return $return;
	}
}


/* End of file disclosapage.php */
/* Location: system/mojomotor/third_party/disclosapage/libraries/disclosapage.php */