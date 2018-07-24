<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    private $agama = array('Islam','Kristen','Budha','Hindu','Katolik') ;

	public function index() {
//		$this->load->view('exe1/index') ;
        $data['mhs'] = $this->cihuy->passData('mahasiswa','','') ;
        $this->load->view('exe1/reset', $data) ;
	}

	public function processData() {
	    $nama = $_POST['nama'] ;
	    $kota = $_POST['kota'] ;

	    echo "SELAMAT DATANG $nama\nSemoga Cerah Di $kota" ;
    }
    //------------------------------------------------------------------------------------------------

    public function indexData() {
	    $nim = $_POST['nim'] ;
        $sel = $this->cihuy->passData('mahasiswa', array('nim' => $nim), '') ;
        while ($x = current($this->agama)) {
            if ($x == $sel[0]->agama) {
                $agama = key($this->agama);
            }
            next($this->agama) ;
        }
        // echo $agm ;exit;
        $data = array('nim' => $sel[0]->nim,
            'nama' => $sel[0]->nama,
            'tgl_lahir' => $sel[0]->tgl_lahir,
            'tempat' => $sel[0]->tempat,
            'religion' => $agama,
            'jurusan' => $sel[0]->jurusan,
            'kelas' => $sel[0]->kelas,
            'foto' => $sel[0]->foto );

        echo json_encode($data) ;
    }

	//------------------------------------------------------------------------------------------------

	public function getData() {
        $data['mhs'] = $this->cihuy->passData('mahasiswa','', '') ;
        $this->load->view('exe1/show',$data) ;
    }

	public function newData() {
	    $this->load->view('exe1/inputData') ;
    }

    public function saveData() {
        $foto = $_FILES['fileFoto']['name'];
        
        if ($foto != "") {
            $x = $this->input->post('data');
            // $config = array(
            //     "upload_path" => './assets/images',
            //     "allowed_types" => "JPG|JPEG|PNG|BMP",
            //     "overwrite" => TRUE,
            //     "max_width" = 5000 ,
            //     "max_height" = 5000 ,
            //     "max_size" => "5120000"
            // ) ;

            // $this->upload->initialize($config);
            $dir = $_FILES['fileFoto']['tmp_name'];
            $type = strtoupper(substr($_FILES['fileFoto']['type'],6));
            $size = $_FILES['fileFoto']['size'];
            
            $filterExt = array("JPG", "PNG", "BMP", "JPEG") ;
            $foto = str_replace(" ", "_", $foto) ;
            $target = "./assets/images/".$foto;
            // var_dump($type); die();
            if (! in_array($type, $filterExt)) {
                // var_dump($type); die();
                $msg = "Hanya File (JPG, PNG, BMP, dan JPEG) Yang Diperbolehkan" ;
                $sts = "x" ;
                echo json_encode(["msg" => $msg, "sts" => $sts]) ;
            }
            else {
                if ($size > 5120000) {
                    $msg = "Upload Foto Anda Maksimal 5MB" ;
                    $sts = "x" ;
                    echo json_encode(["msg" => $msg, "sts" => $sts]) ;
                }
                else {
                    if (! move_uploaded_file($dir, $target)) {
                        $msg = "Foto Gagal Di Upload, Silahkan Coba Lagi" ;
                        $sts = "x" ;
                        echo json_encode(["msg" => $msg, "sts" => $sts]) ;
                    }
                    else {
                        $data['nim'] = $x['nim'] ;
                        
                        $row = $this->cihuy->passData("mahasiswa", $data, '') ;
                        $cek = count($row) ;
            
                        if ($cek > 0) {
                            $msg = "Data NIM ".$data['nim']." Sudah Terdaftar, Silahkan Coba Lagi" ;
                            $sts = "x" ;
                            echo json_encode(["msg" => $msg, "sts" => $sts]) ;
                        }
                        else {
                            $x['agama'] = $this->agama[$x['agama']] ;
                            $x['foto'] = $foto ;

                            $this->cihuy->commit('mahasiswa', $x) ;
                        }
                    }
                }
            }
        }
        else {
            $x = $this->input->post('data');
            $data['nim'] = $x['nim'] ;
            $row = $this->cihuy->passData("mahasiswa", $data, '') ;
            $cek = count($row) ;

            if ($cek > 0) {
                $msg = "Data NIM ".$data['nim']." Sudah Terdaftar\nSilahkan Coba Lagi" ;
                $sts = "x" ;
                echo json_encode(["msg" => $msg, "sts" => $sts]) ;
            }
            else {
                $x['agama'] = $this->agama[$x['agama']] ;

                $this->cihuy->commit('mahasiswa', $x) ;
            }
        }

        // $data['nim'] = $_POST['nim'] ;
        // $row = $this->cihuy->passData("mahasiswa", $data, '') ;
        // $cek = count($row) ;

        // if ($cek > 0) {
        //     $msg = "Data NIM ".$data['nim']." Sudah Terdaftar\nSilahkan Coba Lagi" ;
        //     $sts = "x" ;
        //     echo json_encode(["msg" => $msg, "sts" => $sts]) ;
        // }
        // else {
        //     $data['nama'] = $_POST['nama'] ;
        //     $data['tgl_lahir'] = $_POST['datePick'] ;
        //     $data['agama'] = $this->agama[$_POST['agama']] ;
        //     //$data['foto'] = $_POST['tempelFoto'] ;

        //     $this->cihuy->commit('mahasiswa', $data) ;
        // }
    }

    public function deleteData($unique) {
	    $this->cihuy->dropData('mahasiswa', array('nim' => $unique));
    }

    public function editData($data) {
	    $sel = $this->cihuy->passData('mahasiswa', array('nim' => $data), '') ;

        while ($x = current($this->agama)) {
            if ($x == $sel[0]->agama) {
                $agama = key($this->agama);
            }
            next($this->agama) ;
        }
        // echo $agm ;exit;
	    $data = array('nim' => $sel[0]->nim,
                        'nama' => $sel[0]->nama,
                        'tempat' => $sel[0]->tempat,
                        'tgl_lahir' => $sel[0]->tgl_lahir,
                        'religion' => $agama);

	    $this->load->view('exe1/editData', $data) ;
    }

    public function updateData() {
        $x = $this->input->post('data');
        $temp_foto = $_POST['tempelFoto'] ;
        $foto = $_FILES['fileFoto']['name'];

        if ($foto != "") {
            $x['foto'] = $foto ;
            
            $dir = $_FILES['fileFoto']['tmp_name'];
            $type = strtoupper(substr($_FILES['fileFoto']['type'],6));
            $size = $_FILES['fileFoto']['size'];
            
            $filterExt = array("JPG", "PNG", "BMP", "JPEG") ;
            $foto = str_replace(" ", "_", $foto) ;
            $target = "./assets/images/".$foto;
            // var_dump($type); die();
            if (! in_array($type, $filterExt)) {
                // var_dump($type); die();
                $msg = "Hanya File (JPG, PNG, BMP, dan JPEG) Yang Diperbolehkan" ;
                $sts = "x" ;
                echo json_encode(["msg" => $msg, "sts" => $sts]) ;
            }
            else {
                if ($size > 5120000) {
                    $msg = "Upload Foto Anda Maksimal 5MB" ;
                    $sts = "x" ;
                    echo json_encode(["msg" => $msg, "sts" => $sts]) ;
                }
                else {
                    if (! move_uploaded_file($dir, $target)) {
                        $msg = "Foto Gagal Di Upload, Silahkan Coba Lagi" ;
                        $sts = "x" ;
                        echo json_encode(["msg" => $msg, "sts" => $sts]) ;
                    }
                }
            }
        } else {
            $x['foto'] = $temp_foto ;
        }

        $x['agama'] = $this->agama[$x['agama']] ;
	    $this->cihuy->commitUpdate('mahasiswa', $x, ['nim' => $x['nim']]) ;
    }

}