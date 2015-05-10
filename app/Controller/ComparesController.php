<?php
class ComparesController extends AppController{
	public $name = "Compares";
	public $uses = array('FunctionProblem','MakingProblem','CompareProblem');

	public function index(){
		// $this->redirect('problem_show');
	}

	// public function get_question(){
	// 	$question_data['function'] = $this->FunctionProblem->find('all');
	// 	// 機能を利用して作られた問題のみ抽出
	// 	$question_data['making'] = $this->MakingProblem->find('all',array(
	// 		'conditions' => array('function_flug' => 1)
	// 	));
	//
	// 	$this->set('question_data',$question_data);
	// }

	public function search_similar_question(){
		$question_data['function'] = $this->FunctionProblem->find('all');
		// 機能を利用して作られた問題のみ抽出
		$question_data['making'] = $this->MakingProblem->find('all',array(
			'conditions' => array('function_flug' => 1)
		));
		$search_result = $this->CompareProblem->similar_problem($question_data);
		$this->set('search_result_data',$search_result);
	}

	public function search_constant_question(){
		$question_data['function'] = $this->FunctionProblem->find('all',array(
			'fields' => array(
				'DISTINCT function_make_question', 'function_make_answer'
			),
			'order' => array('function_make_question' => 'asc'),
			));
		// 機能を利用して作られた問題のみ抽出
		$question_data['making'] = $this->MakingProblem->find('all',array(
			'conditions' => array('function_flug' => 1
			)
		));
		$search_result = $this->CompareProblem->constant_problem($question_data);
		$this->set('search_result_data',$search_result);
	}


}
?>
