<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//
		$this->load->view('welcome_message',array("admin" => $this->db->get("admin")->row()));
	}
	
	public function leaderboard(){
		$query = $players = $this->db->from("player")->order_by("points", "desc")->get();
		$this->load->view('leaderboard',array("players" => $query->result()));
	}
	
	public function weekPlayer(){
		$admin = $this->db->get("admin")->row();
		if($admin->admin_week > $_GET['week']){
			$this->weekResult();
			return;
		}else if($admin->admin_week == $_GET['week'] && $admin->admin_state != 'EDITION'){
			$week = $_GET['week'] - 1;
			$query = $this->db->query("SELECT a.id, a.winner as winner, a.local, a.visitor, b.nickname as visitorName, b.abr as visitorAbr, c.nickname as localName, c.abr as localAbr, d.team_id as picked FROM games a LEFT OUTER JOIN teams b ON a.visitor=b.id LEFT OUTER JOIN teams c ON a.local=c.id LEFT OUTER JOIN pool d ON a.id=d.game_id WHERE a.week=".$week." AND d.player_id=".$_GET['playerId']." ORDER BY a.id");
			$this->load->view('viewWeek',array('games' => $query->result(), 'week' => $week ));
		}else{
			$this->load->view('permissionDenied');
		}
	}
	
	public function weekResult(){
		$query = $this->db->query("SELECT a.id, a.winner as winner, a.local, a.visitor, b.nickname as visitorName, b.abr as visitorAbr, c.nickname as localName, c.abr as localAbr, d.team_id as picked FROM games a LEFT OUTER JOIN teams b ON a.visitor=b.id LEFT OUTER JOIN teams c ON a.local=c.id LEFT OUTER JOIN pool d ON a.id=d.game_id WHERE a.week=".$_GET['week']." AND d.player_id=".$_GET['playerId']." ORDER BY a.id");
		$this->load->view('viewWeek',array('games' => $query->result(), 'week' => $_GET['week'] ));
	}

	public function weekPool(){
		$admin = $this->db->get("admin")->row();
		
		if($admin->admin_week > $_GET['week'] || ($admin->admin_week == $_GET['week'] && $admin->admin_state != 'EDITION')){
			$this->weekResult();
			return;
		}
		$query = $this->db->query("SELECT a.id, a.local, a.visitor, b.nickname as visitorName, b.abr as visitorAbr, c.nickname as localName, c.abr as localAbr, d.team_id as picked FROM games a LEFT OUTER JOIN teams b ON a.visitor=b.id LEFT OUTER JOIN teams c ON a.local=c.id LEFT OUTER JOIN pool d ON a.id=d.game_id WHERE a.week=".$_GET['week']." AND d.player_id=".$_GET['playerId']." ORDER BY a.id");
		$this->load->view('editWeek',array('games' => $query->result(), 'week' => $_GET['week'] ));
	}
	
	public function savePool(){
		$forecast = explode(",", $_POST['forecast']);
		$response = '{"games": [<games>]}';
		$valuesResponse = "";
		foreach ($forecast as $key => $game) {
			$gameTeam = explode("-", $game);
			$this->db->where(array('player_id'=> $_POST['playerId'], 'game_id' => $gameTeam[0]));
			$this->db->update('pool', array('team_id' => $gameTeam[1])); 
			$valuesResponse .= '{"game_id": '.$gameTeam[0].', "player_id": '.$_POST['playerId'].'}'. ($key + 1 == count($forecast) ? "" : ",");
		}
		echo str_replace("<games>", $valuesResponse, $response);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */