<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		//$players = $this->db->get("player");
		$this->load->view('welcome_message',array("admin" => $this->db->get("admin")->row()));
	}
	
	public function login(){
		$player = $this->db->get_where("player", array("name" => $_POST['name']))->row();
		if(count($player) == 0){
			echo '{"id": 0, "message": "Please enter a valid name"}';
		}else{
			echo '{"id": '.$player->id.', "name": "'.$player->name.'", "points": '.$player->points.'}';
		}
	}
	
	public function loadGames(){
		$local = $this->db->get_where("teams", array("abr" => $_POST['local']))->row();
		$visitor = $this->db->get_where("teams", array("abr" => $_POST['visitor']))->row();
		$winner = NULL;
		if(isset($_POST['winner']) && $_POST['winner'] != "null"){
			$winner = $this->db->get_where("teams", array("abr" => $_POST['winner']))->row();
		}
		
		$data = array(
			'week' => $_POST['week'] ,
   			'local' => $local->id ,
   			'visitor' => $visitor->id ,
   			'winner' => isset($winner) ? $winner->id : null
		);
		$gameId = 0;
		
		/*$this->db->from('games')->where(array('week' => $data['week'],'local' => $data['local'],'visitor' => $data['visitor']));
		if($this->db->count_all_results() == 0){
			$this->db->insert('games', $data);
			$gameId = $this->db->insert_id(); 
		}else{*/
			$this->db->from('games')->where(array('week' => $data['week'],'local' => $data['local'],'visitor' => $data['visitor']));
			$game = $this->db->get()->row();
			$this->db->where('id', $game->id);
			$this->db->update('games', array('winner' => isset($winner) ? $winner->id : null)); 
			$gameId = $game->id; 
			
			
		//}
		
		/*$query = $players = $this->db->select("id")->from("player")->get();
		foreach($query->result() as $player){
			$this->db->insert('pool', array('player_id' => $player->id, 'game_id' => $gameId));
		}*/
		
		echo '{"id": '.$gameId.'}';
	}
		
	public function calculatePoints(){
		$query = $this->db->query("SELECT count(d.player_id) as points, d.player_id as player_id FROM games a LEFT OUTER JOIN pool d ON a.id=d.game_id WHERE a.week<=".$_POST['week']." AND a.winner=d.team_id GROUP BY d.player_id");
		foreach($query->result() as $points){
			$this->db->where('id', $points->player_id);
			$this->db->update('player', array('points' => $points->points ));
			echo "player ".$points->player_id." got ".$points->points." | ";
		}
	}
	
	public function setAdminWeek(){
		if($_POST['week'] >= 1 && $_POST['week'] <=17){
			$data = array('admin_week' => $_POST['week']);
			$this->db->update('admin', $data); 
		}
		echo '{"admin_week": "'.$data['admin_week'].'"}';
	}
	
	public function setAdminState(){
		
		$admin = $this->db->get("admin")->row();
		if($admin->admin_state == 'EDITION'){
			$data = array('admin_state' => 'READONLY');
		}else{
			$data = array('admin_state' => 'EDITION');
		}
		$this->db->update('admin', $data);
		echo '{"admin_state": "'.$data['admin_state'].'"}';
	}
}