<?php
class ComparesController extends AppController{
	public $name = "Compares";
	public $uses = array('FunctionProblem','NormalProblem');

	public function index(){
		// $this->redirect('problem_show');
	}

	public function get_question(){
		$question_data['function'] = $this->FunctionProblem->find('all');
		$question_data['normal'] = $this->NormalProblem->find('all');
		$this->set('question_data',$question_data);
	}

}
?>
