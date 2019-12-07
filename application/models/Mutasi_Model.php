<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Mutasi_Model extends MY_Model {
        protected $table = 'mutasi';
// =============================================================
        public function add($data) {
            $where = "  no_rek      = '" . $data['no_rek'] . "' AND
                        tgl_mutasi  = '" . $data['tgl_mutasi'] . "' AND
                        keterangan  = '" . $data['keterangan'] . "' AND
                        nominal     = '" . $data['nominal'] . "' AND
                        tipe_mutasi = '" . $data['tipe_mutasi'] . "'";
            $this->db->where($where);
            $row = $this->db->get($this->table)->num_rows();

            if ($row == 0) {
                return $this->add_data($this->table, $data);
            } else {
                return false;
            }
        }

        public function select($no_rek) {
            return $this->select_data($this->table, 'no_rek', $no_rek)->result_array();
        }
// =============================================================
        public function selectTipeByReq($no_rek, $tipe) {
            $this->db->select('sum(nominal) as total, tgl_mutasi');
            
            $where = "no_rek = '" . $no_rek . "' AND tipe_mutasi = '" . $tipe . "'";
            $this->db->where($where);
            $this->db->group_by('tgl_mutasi');
            return $this->db->get($this->table);
        }
// =============================================================
    }
?>