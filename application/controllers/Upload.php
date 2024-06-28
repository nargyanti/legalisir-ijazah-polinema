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
			$data['image_path'] = base_url('uploads/' . $data['file_name']);

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

			// Inisialisasi mPDF dengan konfigurasi yang telah ditentukan
			$pdf = new \Mpdf\Mpdf($pdf_config);

			// Menambahkan metadata
			$pdf->SetCreator('Akademik Polinema');
			$pdf->SetAuthor('Akademik Polinema');
			$pdf->SetTitle('Judul Dokumen PDF');
			$pdf->SetSubject('Deskripsi atau subjek dari dokumen PDF');
			$pdf->SetKeywords('kata, kunci, untuk, SEO, PDF');

			// Load view ke dalam variabel
			$html = $this->load->view('pdf_template', $data, true);

			// Menambahkan gambar ke dalam PDF
			// $pdf->WriteHTML('<img src="' . $image_path . '" style="width: 100%; height: auto;"><barcode code="https://alumni.polinema.ac.id/" type="QR" class="barcode" size="1.4" error="M" disableborder="1" />');
			$pdf->WriteHTML($html);

			// Menentukan lokasi dan nama file output PDF
			$pdf_output = './uploads/' . $data['raw_name'] . '.pdf';

			// Menyimpan PDF ke dalam file
			$pdf->Output($pdf_output, \Mpdf\Output\Destination::FILE);

			// Menampilkan pesan sukses dengan tautan untuk mengunduh PDF
			echo 'PDF generated successfully. <a href="' . base_url('uploads/' . $data['raw_name'] . '.pdf') . '">Download PDF</a>';
		}
	}
}
