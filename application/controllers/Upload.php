<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
	}

	public function index()
	{
		$this->load->view('upload');
	}

	public function convert()
	{
		// Confirm upload file
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 2048; // 2MB
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload', $error);
		} else {
			$data = $this->upload->data();

			// Prepare data
			$data['image_path'] = base_url('uploads/' . $data['file_name']); // output image path
			$data['qr_code_url'] = 'https://alumni.polinema.ac.id/'; // set QR code URL here

			// Configure mPDF
			$pdf_config = [
				'mode' => 'utf-8',
				'format' => 'A4-L',
				'margin_left' => 0,
				'margin_right' => 0,
				'margin_top' => 0,
				'margin_bottom' => 0,
				'margin_header' => 0,
				'margin_footer' => 0,
			];

			// Initialize mPDF
			$pdf = new \Mpdf\Mpdf($pdf_config);

			// Set metadata
			$pdf->SetCreator('Akademik Polinema');
			$pdf->SetAuthor('Akademik Polinema');
			$pdf->SetTitle('Ijazah Digital Polinema - Nama');
			$pdf->SetSubject('Insert subject here');
			$pdf->SetKeywords('Insert keywords here');

			// Load template
			$html = $this->load->view('pdf_template', $data, true);
			$pdf->WriteHTML($html);

			// Output PDF
			$pdf_output = './uploads/' . $data['raw_name'] . '.pdf';
			$pdf->Output($pdf_output, \Mpdf\Output\Destination::FILE);

			// Display success message
			echo 'PDF generated successfully. <a href="' . base_url('uploads/' . $data['raw_name'] . '.pdf') . '">Download PDF</a>';
		}
	}
}
