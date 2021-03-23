<?php

class Master_UserLog extends CI_Model
{
    protected $table = 'msuserlog'; //nama tabel dari database
    public $columnSelect = array(
        'userlog.userlogid',
        'user.username',
        'userlog.firstlogin',
        'userlog.lastlogin',
        'userlog.lastactive',
        'userlog.activeduration',
        'userlog.lastlocation',
        'userlog.lastpasswordchange'
    );

    public $columnSearch = array(
        'userlog.userlogid',
        'userlog.userid',
        'userlog.lastlocation'
    );

    public function complete_query()
    {
        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' userlog');
        $this->db->join('msuser as user', 'userlog.userid = user.userid');
    }

    public function QueryDatatable()
    {
        $this->complete_query();
        return $this->db;
    }

    public function get_data($id)
    {
        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' userlog');
        $this->db->where('userlog.userlogid', $id);
        return $this->db->get()->row();
    }

    public function ChangePassDate($user)
    {
        $this->db->where('userid', $user['userid']);
        $this->db->set('lastpasswordchange', date('Y-m-d h:i:s'));
        $this->db->update('msuserlog');
    }
}
